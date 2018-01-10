CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(254),
    username_canonical VARCHAR(254), 
    email VARCHAR(254),
    email_canonical VARCHAR(254),
    enabled bool,
    salt CHAR(31),
    password VARCHAR(1024),
    locked bool,
    expired bool,
    roles VARCHAR(1024),
    credentials_expired bool,
    register_date date,
    INDEX index_on_username_password (username_canonical, email_canonical)
)

