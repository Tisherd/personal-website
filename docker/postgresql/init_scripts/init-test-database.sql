DO $$ BEGIN
    IF current_setting('app.env', true) IS DISTINCT FROM 'production' THEN
        EXECUTE format('CREATE DATABASE %I', current_setting('app.test_db', true));
    END IF;
END $$;
