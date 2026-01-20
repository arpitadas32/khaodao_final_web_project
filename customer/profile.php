<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: customer_login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT username, email, created_at FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

$join_date = date("F j, Y", strtotime($user['created_at']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - KHAO DAO</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .dashboard {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        
        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            overflow-y: auto;
        }
        
        .main {
            flex: 1;
            margin-left: 230px;
            padding: 25px;
            overflow-y: auto;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .profile-wrapper {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
            flex: 1;
            margin-bottom: 25px;
        }
        
        .profile-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        
        .user-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 40px;
            font-weight: bold;
            margin: 0 auto 15px;
        }
        
        .info-group {
            margin-bottom: 20px;
            border-bottom: 1px solid #f4f4f4;
            padding-bottom: 10px;
        }
        
        .info-group label {
            display: block;
            font-size: 13px;
            color: #888;
            margin-bottom: 5px;
        }
        
        .info-group p {
            font-size: 16px;
            color: #333;
            font-weight: 600;
        }
        
        .status-tag {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
        }
        
        .footer {
            margin-top: auto;
            padding: 15px;
            background: white;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="dashboard">
    <?php include 'sidebar.php'; ?>
    
    <div class="main">
        <div class="topbar">
            <h3>My Profile</h3>
        </div>

        <div class="profile-wrapper">
            <div class="profile-card" style="text-align: center;">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                </div>
                <h2><?php echo htmlspecialchars($user['username']); ?></h2>
                <p style="color: #888; margin-bottom: 15px;">Customer</p>
                <span class="status-tag">Active Account</span>
            </div>

            <div class="profile-card">
                <h4 style="margin-bottom: 20px; color: #764ba2;">Account Details</h4>
                
                <div class="info-group">
                    <label>Username</label>
                    <p><?php echo htmlspecialchars($user['username']); ?></p>
                </div>

                <div class="info-group">
                    <label>Email Address</label>
                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                </div>

                <div class="info-group">
                    <label>Member Since</label>
                    <p><?php echo $join_date; ?></p>
                </div>

                <a href="settings.php" style="color: #667eea; text-decoration: none; font-size: 14px; font-weight: bold;">
                    Edit Account Settings →
                </a>
            </div>
        </div>

        <div class="footer">
            <p>© <?php echo date("Y"); ?> Khao Dao. All rights reserved.</p>
        </div>
    </div>
</div>

</body>
</html>