-- Run this in phpMyAdmin (or the MySQL command line) before using the site.
-- In XAMPP: open http://localhost/phpmyadmin -> SQL tab -> paste this -> Go

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
