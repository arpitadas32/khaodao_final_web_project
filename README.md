# KHAO DAO – Online Food Delivery Management System

A robust and functional Online Food Delivery Management System built with **Procedural PHP** and **MySQL**.

This project demonstrates core web development concepts including authentication, role-based access control, CRUD operations, order management, database handling, and dynamic order tracking.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white) ![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white) ![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

## Features

### Core Features (All Users)
• Secure Login & Registration system  
• Forget Password functionality  
• Change Password  
• Profile View & Update  
• Session-based Authentication  
• Secure Logout  

### 🍽 Customer
• User registration and login (authentication)  
• Browse food menu through web interface  
• Search and filter food items  
• Add food items to shopping cart  
• Place orders using web forms  
• View order status dynamically  
• View previous orders (order history)  

### Seller (Admin)
• Secure login to admin dashboard  
• Add, update, and delete food items (CRUD operations)  
• View customer orders in real time  
• Accept or reject customer orders  
• Update order status through web panel  
• Assign delivery man to orders  
• View sales reports and order history  

### Delivery Man
• View assigned delivery orders  
• Accept or reject delivery requests  
• View pickup and delivery information  
• Update delivery status  
• Track completed deliveries  
• View delivery history  

## 🛠 Tech Stack
• **Backend:** PHP (Procedural Style)  
• **Database:** MySQL  
• **Frontend:** HTML5, CSS3, JavaScript  
• **Server:** Apache (XAMPP)  

## Project Structure
/KHAO_DAO (Project Root)
    /controllers    # Handles business logic and request processing
    /models         # Database interaction and data operations
    /views          # UI files for Customer, Seller, and Delivery Man
    /assets         # CSS, JavaScript, Images
    index.php       # Main entry point and routing
    khaodao.sql     # Database schema
How to Run
Prerequisites

PHP 7.4 or higher

MySQL (XAMPP recommended)

Setup Steps

Clone or download the project

Move the project folder to htdocs

Create a MySQL database named khaodao

Import khaodao.sql into the database

Configure database credentials in the config file

Start Apache & MySQL from XAMPP

Open browser and visit:http://localhost/khaodao
Security Highlights

Prepared Statements to prevent SQL Injection

Session-based authentication

Role-based access control

Server-side form validation

Secure password handling

📌 About

This project was developed as part of an academic group assignment to demonstrate practical knowledge of web application development using PHP and MySQL.
