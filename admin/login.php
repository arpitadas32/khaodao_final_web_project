<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | খাও দাও</title>
    <link rel="stylesheet" href="css/admin_style.css">
    <style>
        .forget-link {
            display: block;
            margin-top: 10px;
            text-align: right;
            font-size: 13px;
            color: #3498db;
            text-decoration: none;
        }
        .forget-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="post" action="login_process.php">
            <input type="text" name="username" placeholder="Username" required class="form-control">
            <input type="password" name="password" placeholder="Password" required class="form-control">
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="forget_password.php" class="forget-link">Forget Password?</a>
        </form>
    </div>
</body>
</html>