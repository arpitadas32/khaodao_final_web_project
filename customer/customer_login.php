<?php
if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
    echo "<p class='success'>Account created successfully. Please login.</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-card">
    <h2>Welcome Back</h2>
    <p style="margin-bottom: 40px;">Please login to your account</p>
    
    <form action="login_process.php" method="POST" onsubmit="return validateLogin()">
        <div class="input-box" style="margin-top: 20px; position: relative; margin-bottom: 35px;">
            <input type="text" name="username" id="username" required 
                   style="width: 100%; padding: 10px 0; font-size: 16px; color: #fff; border: none; border-bottom: 1px solid #fff; outline: none; background: transparent;">
            <label style="position: absolute; top: 0; left: 0; padding: 10px 0; font-size: 16px; color: #fff; pointer-events: none; transition: 0.5s;">Username</label>
        </div>

        <div class="input-box" style="position: relative; margin-bottom: 35px;">
            <input type="password" name="password" id="password" required 
                   style="width: 100%; padding: 10px 0; font-size: 16px; color: #fff; border: none; border-bottom: 1px solid #fff; outline: none; background: transparent;">
            <label style="position: absolute; top: 0; left: 0; padding: 10px 0; font-size: 16px; color: #fff; pointer-events: none; transition: 0.5s;">Password</label>
        </div>

    <div class="forgot-link">
        <a href="forgot_password.php">Forgot Password?</a>
    </div>

   
    <button type="submit" class="login-btn">Login</button>

    <div class="signup-link">
        <p>Don’t have an account?
            <a href="signup.php">Create one</a>
        </p>
    </div>

    <?php
    if (isset($_GET["error"])) {
        echo "<p class='error'>Invalid username or password</p>";
    }
    ?>

    <p class="error" id="error-msg"></p>


        </form>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
