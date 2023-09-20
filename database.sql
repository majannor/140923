DROP TABLE IF EXISTS users;

CREATE TABLE users(
    user_id             INTEGER PRIMARY KEY,
    user_name           TEXT,
    user_last_name      TEXT,
    user_phone_number   CHAR
);

SELECT * FROM users;

-- INSERT INTO users (id, name) VALUES (null, 'A');

-- DELETE FROM users;

-- DELETE FROM users WHERE user_id = 2;

-- UPDATE users SET user_name = 'x' WHERE user_id = 1;




