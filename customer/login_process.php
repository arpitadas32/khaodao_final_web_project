<?php
session_start();
require "db.php";

// 1. Check if data was actually posted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // 2. Prepare the SQL statement
    $sql = "SELECT id, username, password FROM users WHERE username=? OR email=? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // 3. Fetch the data
        if ($user = mysqli_fetch_assoc($result)) {
            // 4. Verify the hashed password
            if (password_verify($password, $user["password"])) {
                
                // Success! Create session
                session_regenerate_id(true);
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                
                header("Location: dashboard.php");
                exit();
            }
        }
    }
}

// If we reach this point, login failed
header("Location: customer_login.php?error=invalid");
exit();