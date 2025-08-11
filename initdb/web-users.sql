CREATE DATABASE IF NOT EXISTS `web-users`;
USE `web-users`;

DROP TABLE IF EXISTS `users`;

-- Table for usernames and passwords
CREATE TABLE    `users`
    (
        `id` INT(15) NOT NULL UNIQUE PRIMARY KEY AUTO_INCREMENT,
        `username` VARCHAR(25) NOT NULL UNIQUE,
        `password` VARCHAR(100) NOT NULL,
        `preferences` VARCHAR(18) NOT NULL,
        `admin` BOOLEAN NOT NULL
    );
