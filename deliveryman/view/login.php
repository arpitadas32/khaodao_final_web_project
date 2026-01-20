<?php require_once "../controllers/LoginController.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="login.css">
    <script src="../controllers/loginValidation.js"></script>
</head>
<body>

<div class="login-container">
    <div class="login-card">

        <h2>Welcome Back</h2>

        <form method="POST" onsubmit="return validateLogin()">

            <input type="text" name="username" id="username" placeholder="Username">

            <input type="password" name="password" id="password" placeholder="Password">

            <button type="submit">Login</button>

            <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

        </form>

    </div>
</div>

</body>
</html>
