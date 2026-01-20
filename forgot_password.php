<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <h2>Forgot Password</h2>
        <p>Reset your account password</p>

        <form action="forgot_process.php" method="POST">

            <div class="input-box">
                <input type="text" name="username" required>
                <label>Username or Email</label>
            </div>

            <div class="input-box">
                <input type="password" name="new_password" required>
                <label>New Password</label>
            </div>

            <div class="input-box">
                <input type="password" name="confirm_password" required>
                <label>Confirm Password</label>
            </div>

            <button type="submit">Reset Password</button>

            <div class="login-link">
                <p><a href="customer_login.php">Back to Login</a></p>
            </div>

        </form>
    </div>
</div>

</body>
</html>
