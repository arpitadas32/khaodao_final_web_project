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

<div class="login-container">
    <div class="login-card">
        <h2>Welcome Back</h2>
        <p>Please login to your account</p>

        <form action="login_process.php" method="POST" onsubmit="return validateLogin()">

            
 
   

    <div class="input-box">
        <input type="text" name="username" id="username" required>
        <label>Username</label>
    </div>

    <div class="input-box">
        <input type="password" name="password" id="password" required>
        <label>Password</label>
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
