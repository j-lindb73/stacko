CREATE DATABASE IF NOT EXISTS stacko;
-- CREATE USER IF NOT EXISTS 'user'@'localhost';
-- SET PASSWORD FOR 'user'@'localhost' = 'pass';

DROP USER IF EXISTS 'user'@'localhost';

CREATE USER 'user'@'localhost'
IDENTIFIED
WITH mysql_native_password -- Only MySQL > 8.0.4
BY 'pass'
;

GRANT ALL PRIVILEGES
ON stacko.*
TO 'user'@'localhost';