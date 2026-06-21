-- Run this against your MySQL server before using the site.
-- From the MySQL command line:
--   mysql -u root -p < database.sql
-- Or, if you're already in the mysql client:
--   SOURCE database.sql;

CREATE DATABASE IF NOT EXISTS sports_meet;
USE sports_meet;

CREATE TABLE IF NOT EXISTS registrations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  bib VARCHAR(20) NOT NULL UNIQUE,
  full_name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  phone VARCHAR(20),
  age INT,
  gender VARCHAR(20),
  ec_name VARCHAR(150),
  ec_phone VARCHAR(20),
  institution VARCHAR(200),
  sport VARCHAR(100),
  participation VARCHAR(20),
  team_name VARCHAR(150),
  tshirt VARCHAR(10),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contact / general inquiry messages submitted from contact.php
-- This is the single database-connected page for this part of the project.
CREATE TABLE IF NOT EXISTS inquiries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  subject VARCHAR(100) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
