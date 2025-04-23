-- Create the database
CREATE DATABASE loginchiper;

-- Use the newly created database
USE loginchiper;

-- Create the users table with encryption_type column
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    encryption_type VARCHAR(50) NOT NULL
);
