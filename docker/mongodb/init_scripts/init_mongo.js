// Login as administrator (if authorization is enabled)
const adminDB = db.getSiblingDB('admin');
adminDB.auth(process.env.MONGO_INITDB_ROOT_USERNAME, process.env.MONGO_INITDB_ROOT_PASSWORD);

const dbName = process.env.MONGO_DB_NAME || 'app_database';

if (!process.env.MONGO_DB_NAME) {
    print('Warning: MONGO_DB_NAME is not set. Using default name:', dbName);
}

// Create app database
const appDB = db.getSiblingDB(dbName);
appDB.createCollection('example_collection'); // create explicitly
appDB.example_collection.insertOne({ exampleField: 'exampleValue' });
print('Created app database:', appDB.getName());

// Check if APP_ENV is not production
if (process.env.APP_ENV !== 'production') {

    const testDbName = process.env.MONGO_TEST_DB_NAME || 'test_database';

    if (!process.env.MONGO_TEST_DB_NAME) {
        print('Warning: MONGO_TEST_DB_NAME is not set. Using default name:', testDbName);
    }

    // Create test database
    const testDB = db.getSiblingDB(testDbName);
    testDB.createCollection('example_collection'); // create explicitly
    testDB.example_collection.insertOne({ exampleField: 'exampleValue' });
    print('Created test database:', testDB.getName());
} else {
    print('APP_ENV is production, skipping test DB creation');
}
