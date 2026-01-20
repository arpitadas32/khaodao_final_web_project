<?php
require "db.php";
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $security_answer = $conn->real_escape_string($_POST['security_answer']);
    $new_password = $conn->real_escape_string($_POST['new_password']);
    
    // ইউজারনেম এবং সিকিউরিটি উত্তর একসাথে চেক করা হচ্ছে
    $query = "SELECT * FROM admin WHERE username = '$username' AND security_answer = '$security_answer'";
    $check = $conn->query($query);
    
    if ($check && $check->num_rows > 0) {
        // সব ঠিক থাকলে পাসওয়ার্ড আপডেট
        $update = $conn->query("UPDATE admin SET password = '$new_password' WHERE username = '$username'");
        if ($update) {
            $msg = "<p style='color:green;'>✅ Success! Password updated. <a href='login.php'>Login here</a></p>";
        }
    } else {
        // ভুল উত্তর বা ইউজারনেম দিলে
        $msg = "<p style='color:red;'>❌ Error: Invalid Username or Security Answer!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Password Reset</title>
    <link rel="stylesheet" href="css/admin_style.css">
    <style>
        body { font-family: Arial; background: #f5f7fa; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .reset-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 350px; }
        h2 { margin-top: 0; color: #2c3e50; font-size: 22px; text-align: center; }
        label { font-size: 13px; color: #7f8c8d; font-weight: bold; display: block; margin-top: 10px; }
        input { width: 100%; padding: 12px; margin: 5px 0 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #2ecc71; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #27ae60; }
    </style>
</head>
<body>
    <div class="reset-container">
        <h2>🔒 Secure Reset</h2>
        <?= $msg ?>
        <form method="post">
            <label>Admin Username</label>
            <input type="text" name="username" placeholder="Enter username" required>

            <label>Security Question: What is your nickname?</label>
            <input type="text" name="security_answer" placeholder="Your answer" required>

            <label>New Password</label>
            <input type="password" name="new_password" placeholder="Set new password" required>

            <button type="submit">Reset Password</button>
            <p style="text-align:center; margin-top: 15px;"><a href="login.php" style="color:#3498db; text-decoration:none; font-size:14px;">Back to Login</a></p>
        </form>
    </div>
</body>
</html>