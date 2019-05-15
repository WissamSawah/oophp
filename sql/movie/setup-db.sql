--
-- Setup for the article:
-- https://dbwebb.se/kunskap/kom-igang-med-php-pdo-och-mysql
--

--
-- Create the database with a test user
--
CREATE DATABASE IF NOT EXISTS oophp;
GRANT ALL privileges ON oophp.* TO 'user'@'localhost';
USE oophp;
