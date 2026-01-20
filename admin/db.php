<?php

$conn = new mysqli("localhost", "root", "", "login_system");

if ($conn->connect_error) {
    // This will tell you exactly why it's not running
    die("❌ Database Connection Failed: " . $conn->connect_error);
}
?>