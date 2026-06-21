# 🏆 Annual Sports Meet 2026 – Registration System

## 📌 Project Overview

The Annual Sports Meet 2026 Registration System is a web-based application developed to manage sports event registrations and participant inquiries. The website provides information about the sports meet, event schedules, galleries, participant registration, and a contact inquiry system connected to a MySQL database.

The project is developed using HTML, CSS, JavaScript, PHP, and MySQL.

---

## 🎯 Objectives

* Provide information about the Annual Sports Meet 2026.
* Allow participants to register for different sports events.
* Generate unique participant bib numbers.
* Store participant details in a MySQL database.
* Allow users to submit inquiries through a contact form.
* Store inquiries in the database for future reference.

---

## 🛠️ Technologies Used

### Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap (optional components)

### Backend

* PHP

### Database

* MySQL

### Development Tools

* Visual Studio Code
* Git & GitHub
* PHP Built-in Server

---

## 📂 Project Structure

```
sports-meet/
│
├── index.html              # Home Page
├── about.html              # About Sports Meet
├── events.html             # Sports and Schedule Information
├── gallery.html            # Gallery Page
├── register.html           # Registration Form
├── register.php            # Stores Registration Data
├── success.php             # Registration Success Page
├── contact.php             # Inquiry Form Connected to Database
├── view_records.php        # View Registered Participants
├── view_inquiries.php      # View Contact Inquiries
├── config.php              # Database Connection File
├── database.sql            # Database Script
│
├── css/
│   └── style.css           # Website Styling
│
└── README.md
```

---

## 🌟 Website Features

### Home Page

* Introduction to Annual Sports Meet 2026
* Event highlights and statistics

### About Page

* Information about the sports meet
* Mission and organizing committee details

### Events Page

* Sports categories
* Day-wise event schedule

### Gallery Page

* Previous sports meet highlights and images

### Registration System

* Participant registration form
* Personal details and sport selection
* Team and individual participation options
* Automatic Bib Number generation
* Registration confirmation page

### Contact Inquiry System

* Collects:

  * Name
  * Email
  * Phone Number
  * Subject
  * Message
* Stores inquiries in MySQL database

### Admin Pages

* View all registered participants
* View all contact inquiries

---

## 🗄️ Database Tables

### registrations

Stores:

* Participant Name
* Email
* Phone Number
* Age
* Gender
* Emergency Contact Details
* Institution Name
* Sport
* Participation Type
* Team Name
* T-Shirt Size
* Bib Number

### inquiries

Stores:

* Name
* Email
* Phone Number
* Subject
* Message
* Date and Time

---

## ⚙️ Installation Steps

### Step 1: Clone Repository

```bash
git clone https://github.com/your-username/sports-meet-registration.git
```

### Step 2: Import Database

Create database:

```sql
CREATE DATABASE sports_meet;
```

Import:

```bash
database.sql
```

### Step 3: Configure Database

Update `config.php`:

```php
$host = "127.0.0.1";
$user = "root";
$pass = "your_mysql_password";
$db   = "sports_meet";
```

### Step 4: Start PHP Server

```bash
php -S localhost:8000
```

### Step 5: Open Website

```
http://localhost:8000/index.html
```

---

## 📸 Sample Pages

* Home Page
* About Page
* Events Page
* Gallery Page
* Registration Page
* Contact Page

---

## 🚀 Future Enhancements

* Online payment integration
* Email confirmation system
* Admin login panel
* Certificate generation
* Dynamic event management
* Team member management

---

## 👩‍💻 Developed By

**Shravani H. Kharade**

Bachelor of Engineering (Computer Engineering)

Project: Annual Sports Meet 2026 – Registration System

Technologies: HTML, CSS, JavaScript, PHP, MySQL
🌟 Website Features
Home Page
Introduction to Annual Sports Meet 2026
Event highlights and statistics
About Page
Information about the sports meet
Mission and organizing committee details
Events Page
Sports categories
Day-wise event schedule
Gallery Page
Previous sports meet highlights and images
Registration System
Participant registration form
Personal details and sport selection
Team and individual participation options
Automatic Bib Number generation
Registration confirmation page
Contact Inquiry System
Collects:
Name
Email
Phone Number
Subject
Message
Stores inquiries in MySQL database
Admin Pages
View all registered participants
View all contact inquiries
🗄️ Database Tables
registrations

Stores:

Participant Name
Email
Phone Number
Age
Gender
Emergency Contact Details
Institution Name
Sport
Participation Type
Team Name
T-Shirt Size
Bib Number
inquiries

Stores:

Name
Email
Phone Number
Subject
Message
Date and Time
⚙️ Installation Steps
Step 1: Clone Repository
git clone https://github.com/your-username/sports-meet-registration.git
Step 2: Import Database

Create database:

CREATE DATABASE sports_meet;

Import:

database.sql
Step 3: Configure Database

Update config.php:

$host = "127.0.0.1";
$user = "root";
$pass = "your_mysql_password";
$db   = "sports_meet";
Step 4: Start PHP Server
php -S localhost:8000
Step 5: Open Website
http://localhost:8000/index.html
