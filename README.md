KHAO DAO – Online Food Delivery Management System
A robust and functional Online Food Delivery Management System built with Procedural
PHP and MySQL.
This project demonstrates core web development concepts including authentication,
role-based access control, CRUD operations, order management, database handling,
and dynamic order tracking.
Features
Core Features (All Users)
• Secure Login & Registration system
• Forget Password functionality
• Change Password
• Profile View & Update
• Session-based Authentication
• Secure Logout
🍽 Customer
• User registration and login (authentication)
• Browse food menu through web interface
• Search and filter food items
• Add food items to shopping cart
• Place orders using web forms
• View order status dynamically
• View previous orders (order history)
Seller (Admin)
• Secure login to admin dashboard
• Add, update, and delete food items (CRUD operations)
• View customer orders in real time
• Accept or reject customer orders
• Update order status through web panel
• Assign delivery man to orders
• View sales reports and order history
Delivery Man
• View assigned delivery orders
• Accept or reject delivery requests
• View pickup and delivery information
• Update delivery status
• Track completed deliveries
• View delivery history
🛠 Tech Stack
• Backend: PHP (Procedural Style)
• Database: MySQL
• Frontend: HTML5, CSS3, JavaScript
• Server: Apache (XAMPP)
• Project Structure
• /KHAO_DAO (Project Root)
• /controllers # Handles business logic and request processing
• /models # Database interaction and data operations
• /views # UI files for Customer, Seller, and Delivery Man
• /assets # CSS, JavaScript, Images
• index.php # Main entry point and routing
• khaodao.sql # Database schema
How to Run
Prerequisites
• PHP 7.4 or higher
• MySQL (XAMPP recommended)
Setup Steps
1. Clone or download the project
2. Move the project folder to htdocs
3. Create a MySQL database named khaodao
4. Import khaodao.sql into the database
5. Configure database credentials in the config file
6. Start Apache & MySQL from XAMPP
7. Open browser and visit:
http://localhost/KHAO_DAO
Security Highlights
• Prepared Statements to prevent SQL Injection
• Session-based authentication
• Role-based access control
• Server-side form validation
• Secure password handling
About
This project was developed as part of an academic group assignment to demonstrate
practical knowledge of web application development using PHP and MySQL.
