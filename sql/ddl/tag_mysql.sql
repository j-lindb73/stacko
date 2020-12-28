--
-- Creating a User table and inserting example users.
-- Create a database and a user having access to this database,
-- this must be done by hand, se commented rows on how to do it.
--



--
-- Create a database for test
--
-- DROP DATABASE anaxdb;
-- CREATE DATABASE IF NOT EXISTS anaxdb;
USE stacko;



--
-- Create a database user for the test database
--
-- GRANT ALL ON anaxdb.* TO anax@localhost IDENTIFIED BY 'anax';



-- Ensure UTF8 on the database connection
SET NAMES utf8mb4;

--
-- Table Tags
--
DROP TABLE IF EXISTS Tags;
CREATE TABLE Tags (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `tag` VARCHAR(128)
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;



-- Table PostTags
--
DROP TABLE IF EXISTS PostTags;
CREATE TABLE PostTags (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `post_id` INTEGER NOT NULL,
    `tag_id` INTEGER NOT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;