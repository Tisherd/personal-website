// Login as administrator (if authorization is enabled)
const adminDB = db.getSiblingDB('admin');
const isAuthenticated = adminDB.auth(process.env.MONGO_INITDB_ROOT_USERNAME, process.env.MONGO_INITDB_ROOT_PASSWORD);

if (!isAuthenticated) {
    print('Error: Authentication failed. Check your username and password.');
    quit(1);
}

// Create main database
createDatabase(process.env.MONGO_DB_NAME);

// Create test database
if (process.env.APP_ENV && process.env.APP_ENV !== 'production') {
    createDatabase(process.env.MONGO_TEST_DB_NAME);
}

function createDatabase(databaseName) {
    if (databaseName) {
        const appDB = db.getSiblingDB(databaseName);
        appDB.createCollection('example_collection');
        appDB.example_collection.insertOne({ exampleField: 'exampleValue' });  // create explicitly
        print('Created database:', appDB.getName());
    } else {
        print(`Error: Database name is not set.`);
        quit(1);
    }
}
