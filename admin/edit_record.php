<?php
session_start();
if (!isset($_SESSION["admin"])) { header("Location: login.php"); exit(); }
require "db.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$type = $_GET['type'] ?? 'customer';

if ($type === 'customer') {
    $table = "users";
    $id_col = "id";
    $redirect = "manage_customers.php";
} else {
    $table = "regi";
    $id_col = "ID";
    $redirect = "manage_delivery.php";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_email = $_POST['email'];
    $new_pass = $_POST['password'];

    if (!empty($new_pass)) {
        $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
        $sql = "UPDATE $table SET email = ?, password = ? WHERE $id_col = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $new_email, $hashed_pass, $id);
    } else {
        $sql = "UPDATE $table SET email = ? WHERE $id_col = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_email, $id);
    }

    if ($stmt->execute()) {
        header("Location: $redirect?msg=success");
        exit();
    }
}

$stmt_fetch = $conn->prepare("SELECT * FROM $table WHERE $id_col = ?");
$stmt_fetch->bind_param("i", $id);
$stmt_fetch->execute();
$user = $stmt_fetch->get_result()->fetch_assoc();

if (!$user) { die("Error: Record not found."); }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Details | Khao Dao</title>
</head>
<body style="background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, sans-serif; margin: 0; padding: 0;">
    
    <?php include "sidebar.php"; ?>

    <div style="margin-left: 250px; padding: 60px 20px; display: flex; justify-content: center;">
        
        <div style="background-color: #ffffff; width: 100%; max-width: 550px; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); border: 1px solid #eeeeee;">
            
            <div style="text-align: center; margin-bottom: 35px; border-bottom: 2px solid #f9f9f9; padding-bottom: 20px;">
                <h2 style="margin: 0; color: #333333; font-size: 24px;">Edit <?= ucfirst($type) ?> Details</h2>
                <p style="color: #777777; font-size: 14px; margin-top: 8px;">Updating information for ID: #<?= $id ?></p>
            </div>

            <form method="POST">
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #555555; font-size: 14px;">Username</label>
                    <input type="text" value="<?= htmlspecialchars($user['username'] ?? $user['Name'] ?? 'N/A') ?>" disabled 
                           style="width: 100%; padding: 12px 15px; border: 1px solid #dddddd; border-radius: 10px; background-color: #f9f9f9; color: #999999; cursor: not-allowed; box-sizing: border-box; font-size: 15px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #555555; font-size: 14px;">Email Address</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required 
                           style="width: 100%; padding: 12px 15px; border: 1px solid #cccccc; border-radius: 10px; box-sizing: border-box; font-size: 15px; outline: none; transition: 0.3s;">
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #555555; font-size: 14px;">New Password</label>
                    <input type="password" name="password" placeholder="Leave blank to keep current" 
                           style="width: 100%; padding: 12px 15px; border: 1px solid #cccccc; border-radius: 10px; box-sizing: border-box; font-size: 15px; outline: none;">
                    <p style="font-size: 12px; color: #e67e22; margin-top: 7px; font-style: italic;">* Fill this only if you want to change the password.</p>
                </div>

                <div style="display: flex; gap: 15px;">
                    <a href="<?= $redirect ?>" 
                       onmouseover="this.style.backgroundColor='#e0e0e0';" 
                       onmouseout="this.style.backgroundColor='#eeeeee';"
                       style="flex: 1; padding: 14px; text-align: center; text-decoration: none; background-color: #eeeeee; color: #555555; font-weight: 600; border-radius: 12px; transition: 0.3s; font-size: 15px;">
                       Cancel
                    </a>

                    <button type="submit" 
                            onmouseover="this.style.backgroundColor='#218838'; this.style.transform='translateY(-2px)';" 
                            onmouseout="this.style.backgroundColor='#28a745'; this.style.transform='translateY(0)';"
                            style="flex: 2; padding: 14px; border: none; background-color: #28a745; color: white; font-weight: 700; border-radius: 12px; cursor: pointer; transition: all 0.3s ease; font-size: 15px; box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>