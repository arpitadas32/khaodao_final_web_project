<?php
$host = "localhost";
$dbname = "login_system"; // Change this to your DB name
$dbuser = "root";               // Change this to your DB username
$dbpass = "";                   // Change this to your DB password

$conn = mysqli_connect($host, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}