
<?php
session_start();
require "db.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];

// Fetch user info
$sql = "SELECT email FROM regi WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
$email = $user['email'] ?? '';
mysqli_stmt_close($stmt);

// Handle update
$update_msg = "";
if (isset($_POST['update'])) {
    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    $new_password = trim($_POST['password']);

    if (!empty($new_username) && !empty($new_email) && !empty($new_password)) {
        $update_sql = "UPDATE regi SET username=?, email=?, password=? WHERE username=?";
        $stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($stmt, "ssss", $new_username, $new_email, $new_password, $username);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION["username"] = $new_username;
            $username = $new_username;
            $email = $new_email;
            $update_msg = "✅ Profile updated successfully!";
        } else {
            $update_msg = "❌ Update failed.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $update_msg = "❗ All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Profile - খাও দাও</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Baloo Da 2', cursive;
            background: #f9fafc;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* HEADER */
        .page-header {
            background: linear-gradient(90deg, #d8ba94, #f07109);
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .page-header h1 {
            font-size: 36px;
            color: #fff;
            text-shadow: 2px 2px rgba(0,0,0,0.2);
            margin: 0;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #d8ba94;
            height: 100vh;
            position: fixed;
            padding-top: 30px;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }
        .sidebar a {
            display: block;
            padding: 15px 25px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            margin: 5px 10px;
            transition: all 0.3s ease;
        }
        .sidebar a:hover {
            background: #f07109;
            color: #fff;
            transform: translateX(5px);
        }

        /* MAIN */
        .main {
            margin-left: 240px;
            padding: 40px;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.6s ease-in-out;
        }

        /* PROFILE BOX */
        .profile-box {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.1);
            width: 420px;
        }
        .profile-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #f07109;
        }
        .profile-box label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }
        .profile-box input {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border 0.3s ease;
        }
        .profile-box input:focus {
            border-color: #f07109;
            outline: none;
        }
        .profile-box button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #f07109, #ff9800);
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        .profile-box button:hover {
            transform: scale(1.05);
        }

        /* SUCCESS/ERROR */
        .success { color: green; text-align: center; margin-top: 15px; font-weight: bold; }
        .error { color: red; text-align: center; margin-top: 15px; font-weight: bold; }

        /* ANIMATION */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                display: flex;
                flex-direction: row;
                overflow-x: auto;
            }
            .sidebar a {
                flex: 1;
                text-align: center;
                margin: 0;
                border-radius: 0;
            }
            .main {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header class="page-header">
    <h1>খাও দাও</h1>
</header>

<!-- SIDEBAR -->
<div class="sidebar">
    <a href="dashboard.php">📊 Dashboard</a>
    <a href="profile.php">👤 Profile</a>
    <a href="deliveryrequest.php">📦 Delivery Request</a>
    <a href="cart.php">🔄 Update Status</a>
    <a href="orders.php">✅ Completed Deliveries</a>
    <a href="settings.php">📜 Delivery History</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">
    <div class="profile-box">
        <h2>My Profile</h2>
        <form method="POST" action="">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label>New Password</label>
            <input type="password" name="password" required>

            <button type="submit" name="update">Update Profile</button>

            <?php if (!empty($update_msg)): ?>
                <p class="<?php echo strpos($update_msg, 'success') !== false ? 'success' : 'error'; ?>">
                    <?php echo $update_msg; ?>
                </p>
            <?php endif; ?>
        </form>
    </div>
</div>

</body>
</html>

