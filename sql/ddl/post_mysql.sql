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
-- Table Posts
--
DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `postTypeId` INTEGER NOT NULL,
    `parentId` INTEGER,
    `userId` INTEGER NOT NULL,
    `title` VARCHAR(128) NOT NULL,
    `text` VARCHAR(2048),
    `tags` VARCHAR(256),
    `created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `deleted` DATETIME,
    `active` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;



-- Table PostTypes
--
DROP TABLE IF EXISTS posttypes;
CREATE TABLE posttypes (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `name` VARCHAR(32) NOT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;