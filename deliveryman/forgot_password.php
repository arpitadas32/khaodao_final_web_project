<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "login_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $new_password = $_POST["new_password"];

    // Optional: Encrypt password (recommended)
    // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Check if email exists
    $check_sql = "SELECT * FROM regi WHERE email = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update password
        $update_sql = "UPDATE regi SET password = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $new_password, $email); // Use $hashed_password if encrypting
        if ($update_stmt->execute()) {
            echo "<p style='color:green;'>✅ Password updated successfully.</p>";
        } else {
            echo "<p style='color:red;'>❌ Failed to update password.</p>";
        }
    } else {
        echo "<p style='color:orange;'>⚠️ Email not found.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forget Password</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; padding: 30px; }
        form { background: #fff; padding: 20px; border-radius: 8px; width: 300px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; margin: 8px 0; box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50; color: white; padding: 10px; border: none; width: 100%;
            cursor: pointer; border-radius: 4px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">🔐 Forget Password</h2>
<form method="POST" action="">
    <label>Email:</label>
    <input type="email" name="email" required>

    <label>New Password:</label>
    <input type="password" name="new_password" required>

    <input type="submit" value="Reset Password">
</form>

</body>
</html>

