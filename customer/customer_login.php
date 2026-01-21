<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <h2>Welcome Back</h2>
        
        <?php 
        if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
            echo "<p style='color: green;'>Account created! Please login.</p>";
        }
        if (isset($_GET["error"])) {
            echo "<p style='color: red;'>Invalid username or password.</p>";
        }
        ?>

        <form action="login_process.php" method="POST">
            <div class="input-box">
                <label>Username or Email</label>
                <input type="text" name="username" required>
            </div>

            <div class="input-box">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="forgot-link">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>

            <button type="submit" class="login-btn">Login</button>

            <div class="signup-link">
                <p>Don’t have an account? <a href="signup.php">Create one</a></p>
            </div>
        </form>
    </div>
</div>

</body>
</html>