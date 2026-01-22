<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-card">
    <h2>Create Account</h2>
    <p style="margin-bottom: 40px;">Please fill in the details</p>

    <form action="signup_process.php" method="POST" onsubmit="return validateSignup()">

        <div class="input-box" style="margin-top: 20px; position: relative; margin-bottom: 30px;">
            <input type="text" name="username" id="username" required 
                   style="width: 100%; padding: 10px 0; font-size: 16px; color: #fff; border: none; border-bottom: 1px solid #fff; outline: none; background: transparent;">
            <label style="position: absolute; top: 0; left: 0; padding: 10px 0; font-size: 16px; color: #fff; pointer-events: none; transition: 0.5s;">Username</label>
        </div>

        <div class="input-box" style="position: relative; margin-bottom: 30px;">
            <input type="email" name="email" id="email" required 
                   style="width: 100%; padding: 10px 0; font-size: 16px; color: #fff; border: none; border-bottom: 1px solid #fff; outline: none; background: transparent;">
            <label style="position: absolute; top: 0; left: 0; padding: 10px 0; font-size: 16px; color: #fff; pointer-events: none; transition: 0.5s;">Email</label>
        </div>

        <div class="input-box" style="position: relative; margin-bottom: 30px;">
            <input type="password" name="password" id="password" required 
                   style="width: 100%; padding: 10px 0; font-size: 16px; color: #fff; border: none; border-bottom: 1px solid #fff; outline: none; background: transparent;">
            <label style="position: absolute; top: 0; left: 0; padding: 10px 0; font-size: 16px; color: #fff; pointer-events: none; transition: 0.5s;">Password</label>
        </div>

        <div class="input-box" style="position: relative; margin-bottom: 35px;">
            <input type="password" name="confirm_password" id="confirm_password" required 
                   style="width: 100%; padding: 10px 0; font-size: 16px; color: #fff; border: none; border-bottom: 1px solid #fff; outline: none; background: transparent;">
            <label style="position: absolute; top: 0; left: 0; padding: 10px 0; font-size: 16px; color: #fff; pointer-events: none; transition: 0.5s;">Confirm Password</label>
        </div>

        <button type="submit" class="login-btn">Sign Up</button>
        
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