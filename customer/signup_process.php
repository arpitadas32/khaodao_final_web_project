<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $email    = trim($_POST["email"]);
    $password = $_POST["password"];

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   
    $check = "SELECT id FROM users WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        header("Location: signup.php?error=exists");
        exit();
    }

 
    $sql = "INSERT INTO users (username, email, password)
            VALUES ('$username', '$email', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: customer_login.php");
        exit();
    }
}
?>
