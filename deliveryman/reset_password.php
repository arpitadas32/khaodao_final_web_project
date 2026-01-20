<?php
session_start();
$error = "";
$success = "";

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $newPassword = trim($_POST['password']);

    if (empty($email) || empty($newPassword)) {
        $error = "Both email and new password are required.";
    } else {
        $conn = new mysqli("localhost", "root", "", "login_system");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if email exists
        $stmt = $conn->prepare("SELECT * FROM regi WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Update password directly
            $update = $conn->prepare("UPDATE regi SET password=? WHERE email=?");
            $update->bind_param("ss", $newPassword, $email);
            $update->execute();

            $success = "Password updated successfully. <a href='login.php'>Login</a>";
        } else {
            $error = "Email not found.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <style>
        body { font-family: Arial; background-color: #f2f2f2; }
        .container { display:flex; justify-content:center; margin-top:50px; }
        .card { background:white; padding:30px; border-radius:10px; width:350px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align:center; margin-bottom:20px; }
        .input-box { margin-bottom:20px; }
        .input-box input { width:100%; padding:10px; border:1px solid #aaa; border-radius:5px; }
        button { width:100%; padding:10px; background:#007BFF; color:white; border:none; border-radius:5px; cursor:pointer; }
        .error { color:red; text-align:center; }
        .success { color:green; text-align:center; }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Reset Password</h2>
        <form method="POST" action="">
            <div class="input-box">
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Enter new password" required>
            </div>
            <button type="submit" name="submit">Reset Password</button>
        </form>
        <?php
        if (!empty($error)) { echo "<p class='error'>$error</p>"; }
        if (!empty($success)) { echo "<p class='success'>$success</p>"; }
        ?>
    </div>
</div>
</body>
</html>

