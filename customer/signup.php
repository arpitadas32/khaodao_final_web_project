<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <h2>Create Account</h2>
        <p>Please fill in the details</p>

        <form action="signup_process.php" method="POST" onsubmit="return validateSignup()">

            <div class="input-box">
                <input type="text" name="username" id="username" required>
                <label>Username</label>
            </div>

            <div class="input-box">
                <input type="email" name="email" id="email" required>
                <label>Email</label>
            </div>

            <div class="input-box">
                <input type="password" name="password" id="password" required>
                <label>Password</label>
            </div>

           
            <div class="input-box">
                <input type="password" name="confirm_password" id="confirm_password" required>
                <label>Confirm Password</label>
            </div>

            <button type="submit">Sign Up</button>

<?php
if (isset($_GET["error"])) {
    echo "<p class='error'>".$_GET["error"]."</p>";
}

if (isset($_GET["success"])) {
    echo "<p class='success'>".$_GET["success"]."</p>";
}
?>

<p class="error" id="error-msg"></p>

<div class="login-link" style="margin-top: 15px;">
    <p>Already have an account? 
        <a href="customer_login.php">Login</a>
    </p>
</div>

        </form>
    </div>
</div>

<script src="signup.js"></script>
</body>
</html>