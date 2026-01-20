<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
require "db.php";

$admin_username = $_SESSION["admin"];
$success_msg = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $conn->real_escape_string($_POST['username']);
    $current_password = $conn->real_escape_string($_POST['current_password']);
    $new_password = $conn->real_escape_string($_POST['new_password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    // ১. প্রথমে চেক করা হচ্ছে কারেন্ট পাসওয়ার্ড সঠিক কি না
    $check = $conn->query("SELECT * FROM admin WHERE username = '$admin_username' AND password = '$current_password'");
    
    if ($check->num_rows > 0) {
        // ২. নতুন পাসওয়ার্ড কনফার্মেশন চেক
        if (!empty($new_password)) {
            if ($new_password === $confirm_password) {
                $password_query = ", password = '$new_password'";
            } else {
                $error_msg = "New passwords do not match!";
            }
        } else {
            $password_query = ""; // পাসওয়ার্ড খালি থাকলে শুধু ইউজারনেম আপডেট হবে
        }

        // ৩. আপডেট কুয়েরি রান করা (যদি কোনো এরর না থাকে)
        if (empty($error_msg)) {
            $update = $conn->query("UPDATE admin SET username = '$new_username' $password_query WHERE username = '$admin_username'");
            
            if ($update) {
                $_SESSION["admin"] = $new_username;
                $admin_username = $new_username;
                $success_msg = "Profile updated successfully!";
            } else {
                $error_msg = "Update failed. Please try again.";
            }
        }
    } else {
        $error_msg = "Current password is incorrect!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Profile | খাও দাও</title>
<style>
    html, body { height: 100%; overflow: hidden; margin: 0; } 
    .main-wrapper {
        margin-left: 240px; 
        height: 100vh;
        display: flex;
        flex-direction: column;
        overflow-y: auto; 
        background: #f5f7fa;
    }
    .profile-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        max-width: 550px;
        width: 100%;
        margin-bottom: 20px;
    }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; color: #34495e; font-weight: bold; font-size: 14px; }
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        box-sizing: border-box;
    }
    .update-btn {
        background: #2ecc71;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        width: 100%;
    }
    .update-btn:hover { background: #27ae60; }
    .alert { padding: 12px; border-radius: 6px; margin-bottom: 20px; width: 100%; max-width: 550px; text-align: center; font-size: 14px; }
</style>
</head>
<body style="font-family:Arial,sans-serif;">

<?php include "sidebar.php"; ?>

<div class="main-wrapper">
    <div style="padding:30px; flex: 1; display: flex; flex-direction: column; align-items: center;">

        <?php if($success_msg): ?>
            <div class="alert" style="background: #d4edda; color: #155724; border: 1px solid #c3e6cb;"><?= $success_msg ?></div>
        <?php endif; ?>

        <?php if($error_msg): ?>
            <div class="alert" style="background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;"><?= $error_msg ?></div>
        <?php endif; ?>

        <div class="profile-card">
            <form method="POST">
               

            <div style="text-align: center; margin-bottom: 35px; border-bottom: 2px solid #f9f9f9; padding-bottom: 20px;">
                <h2 style="margin: 0; color: #333333; font-size: 24px;">⚙️ Account Settings</h2>
            </div>

                <div style="border-bottom: 1px solid #eee; margin-bottom: 20px; padding-bottom: 10px;">
                    <h3 style="margin:0; color: #34495e; font-size: 18px;">Personal Information</h3>
                </div>
                
                <div class="form-group">
                    <label>Admin Username</label>
                    <input type="text" name="username" value="<?= htmlspecialchars($admin_username) ?>" required>
                </div>

                <div style="border-bottom: 1px solid #eee; margin-top: 25px; margin-bottom: 20px; padding-bottom: 10px;">
                    <h3 style="margin:0; color: #34495e; font-size: 18px;">Security Update</h3>
                </div>

                <div class="form-group">
                    <label>Current Password (Required to save changes)</label>
                    <input type="password" name="current_password" placeholder="Enter your current password" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>New Password (Optional)</label>
                        <input type="password" name="new_password" placeholder="Leave blank to keep same">
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="confirm_password" placeholder="Re-type new password">
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="update-btn">Update Profile & Password</button>
                </div>
            </form>
        </div>
        
        <a href="dashboard.php" style="color: #7f8c8d; text-decoration: none; font-size: 14px;">← Back to Dashboard</a>
    </div>

    <?php include "footer.php"; ?>
</div>

</body>
</html>