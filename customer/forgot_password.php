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
        <p style="margin-bottom: 40px;">Reset your account password</p>

        <form action="forgot_process.php" method="POST">

            <div class="input-box" style="margin-top: 20px; position: relative; margin-bottom: 30px;">
                <input type="text" name="username" required 
                       style="width: 100%; padding: 10px 0; font-size: 16px; color: #fff; border: none; border-bottom: 1px solid #fff; outline: none; background: transparent;">
                <label style="position: absolute; top: 0; left: 0; padding: 10px 0; font-size: 16px; color: #fff; pointer-events: none; transition: 0.5s;">Username or Email</label>
            </div>

            <div class="input-box" style="position: relative; margin-bottom: 30px;">
                <input type="password" name="new_password" required 
                       style="width: 100%; padding: 10px 0; font-size: 16px; color: #fff; border: none; border-bottom: 1px solid #fff; outline: none; background: transparent;">
                <label style="position: absolute; top: 0; left: 0; padding: 10px 0; font-size: 16px; color: #fff; pointer-events: none; transition: 0.5s;">New Password</label>
            </div>

            <div class="input-box" style="position: relative; margin-bottom: 35px;">
                <input type="password" name="confirm_password" required 
                       style="width: 100%; padding: 10px 0; font-size: 16px; color: #fff; border: none; border-bottom: 1px solid #fff; outline: none; background: transparent;">
                <label style="position: absolute; top: 0; left: 0; padding: 10px 0; font-size: 16px; color: #fff; pointer-events: none; transition: 0.5s;">Confirm Password</label>
            </div>

            <button type="submit" class="login-btn">Reset Password</button>

            <div class="login-link" style="margin-top: 20px;">
                <p><a href="customer_login.php" style="color: #fff; text-decoration: none; font-weight: bold;">Back to Login</a></p>
            </div>

        </form>
    </div>
</div>
</body>
</html>
