-- noinspection SqlNoDataSourceInspectionForFile
-- noinspection SqlDialectInspectionForFile


-- Drop database if exists
DROP DATABASE IF EXISTS minimal_php_db;
-- Create database if not exists
CREATE DATABASE minimal_php_db;
-- Use the created database
USE minimal_php_db;
-- Create 'users' table
CREATE TABLE IF NOT EXISTS users (
    user_id VARCHAR(250) PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    status INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
-- Create unique constraints on 'users' table for username and email
ALTER TABLE
    users
    ADD
        CONSTRAINT unique_username UNIQUE (username),
ADD
  CONSTRAINT unique_email UNIQUE (email);
-- Create 'contacts' table
CREATE TABLE IF NOT EXISTS contacts (
    contact_id VARCHAR(250) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(255) NOT NULL,
    email VARCHAR(255)
    );
-- Create 'roles' table
CREATE TABLE IF NOT EXISTS roles (
    role_id VARCHAR(250) PRIMARY KEY,
    role_name VARCHAR(255) NOT NULL,
    description VARCHAR(255)
    );
-- Insert roles "admin", "editor", and "user"
INSERT INTO roles (role_id, role_name, description)
VALUES
    (
        UUID(),
        'admin',
        'Administrator'
    ),
    (
        UUID(),
        'editor',
        'Editor'
    ),
    (
        UUID(),
        'user',
        'Regular User'
    );
-- Create 'user_roles' table with foreign key constraints
CREATE TABLE IF NOT EXISTS user_roles (
    user_role_id VARCHAR(250) PRIMARY KEY,
    role_id VARCHAR(36) NOT NULL,
    user_id VARCHAR(36) NOT NULL,
    CONSTRAINT unique_user_role UNIQUE (role_id, user_id)
    );
-- Insert default user record and assign the "admin" role
INSERT INTO users (
    user_id, full_name, username, email, password, status
)
VALUES
    (
        UUID(),
        'Lai Man',
        'laiman',
        'laiman@yahoo.com',
        '$2y$10$3KLRq4CdKu2ko4wYNkvtgegTZHHhMcftG02nsFSBAtC/FxZyoeh9.',
        1
    );
INSERT INTO user_roles (user_role_id, role_id, user_id)
VALUES
    (
        UUID(),
        (
            SELECT
                role_id
            FROM
                roles
            WHERE
                    role_name = 'admin'
        ),
        (
            SELECT
                user_id
            FROM
                users
            WHERE
                    username = 'laiman'
        )
    );
