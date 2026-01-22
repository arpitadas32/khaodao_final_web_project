<?php
session_start();
require "db.php"; 

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";


$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

if (!empty($username) && !empty($password)) {
    
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password' LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
   
        $admin_data = $result->fetch_assoc();
        $_SESSION["admin"] = $admin_data["username"];
        
        header("Location: dashboard.php");
        exit();
    } else {
      
        echo "<script>alert('Wrong Username or Password'); window.location='login.php';</script>";
        exit();
    }
} else {
   
    echo "<script>alert('Please enter both username and password'); window.location='login.php';</script>";
    exit();
}