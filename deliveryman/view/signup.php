<?php require_once "../controllers/SignupController.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>

    <link rel="stylesheet" href="signup.css">
    <script src="../controllers/signupValidation.js"></script>
</head>
<body>

<div class="login-container">
    <div class="login-card">

        <h2>Welcome Delivery Man</h2>
        <p>Please fill in the details</p>

        <form method="POST" onsubmit="return validateSignup()">

            <input type="text" name="username" id="username" placeholder="Username">

            <input type="email" name="email" id="email" placeholder="Email">

            <input type="password" name="password" id="password" placeholder="Password">

            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">

            <button type="submit">Sign Up</button>

        </form>

        <?php
        foreach ($errors as $e) {
            echo "<p class='error'>$e</p>";
        }
        if (!empty($success)) {
            echo "<p class='success'>$success</p>";
        }
        ?>

        <p class="login-link">
            Already have an account? <a href="../login.php">Login</a>
        </p>

    </div>
</div>

</body>
</html>
