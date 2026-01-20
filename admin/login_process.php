<?php
session_start();
require "db.php"; // ডাটাবেজ কানেকশন ফাইল

// ফর্ম থেকে আসা ডেটা রিসিভ করা
$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

// সিকিউরিটির জন্য ডাটাবেজে পাঠানোর আগে এস্কেপ করা
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

if (!empty($username) && !empty($password)) {
    // ডাটাবেজ টেবিল থেকে ইউজার চেক করা
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password' LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // লগইন সফল হলে সেশন সেট করা
        $admin_data = $result->fetch_assoc();
        $_SESSION["admin"] = $admin_data["username"];
        
        header("Location: dashboard.php");
        exit();
    } else {
        // ইউজারনেম বা পাসওয়ার্ড ভুল হলে
        echo "<script>alert('Wrong Username or Password'); window.location='login.php';</script>";
        exit();
    }
} else {
    // ফিল্ড খালি থাকলে
    echo "<script>alert('Please enter both username and password'); window.location='login.php';</script>";
    exit();
}