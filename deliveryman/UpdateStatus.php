
<?php
session_start();
require "db.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$update_msg = "";
$order = null;

// Handle search
if (isset($_POST['search'])) {
    $search_id = trim($_POST['search_id']);
    if (!empty($search_id)) {
        $sql = "SELECT * FROM updatedeliverydtatus WHERE Orderid = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $search_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $order = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if (!$order) {
            $update_msg = "❌ No record found for Order ID: " . htmlspecialchars($search_id);
        }
    }
}

// Handle update
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $orderid = trim($_POST['orderid']);
    $pickup = trim($_POST['pickup']);
    $delivery = trim($_POST['delivery']);

    if (!empty($orderid) && !empty($pickup) && !empty($delivery)) {
        $sql = "UPDATE updatedeliverydtatus SET Orderid=?, pickup=?, delivery=? WHERE ID=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $orderid, $pickup, $delivery, $id);
        if (mysqli_stmt_execute($stmt)) {
            $update_msg = "✅ Delivery status updated successfully!";
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
    <title>Update Delivery Status - খাও দাও</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Baloo Da 2', cursive;
            background: #f9fafc;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .page-header {
            background: linear-gradient(90deg, #d8ba94, #f07109);
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .page-header h1 {
            font-size: 36px;
            color: #fff;
            margin: 0;
        }
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
        .main {
            margin-left: 240px;
            padding: 40px;
            flex: 1;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #f07109;
        }
        .update-msg {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            font-weight: bold;
        }
        .form-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.1);
            max-width: 500px;
        }
        .form-box label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }
        .form-box input {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .btn {
            margin-top: 20px;
            padding: 12px 20px;
            background: linear-gradient(90deg, #007BFF, #0056b3);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: transform 0.2s ease;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        .page-footer {
            background: #d8ba94;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #333;
            border-top: 2px solid rgba(0,0,0,0.05);
            margin-left: 240px;
        }
    </style>
</head>
<body>

<header class="page-header">
    <h1>খাও দাও</h1>
</header>

<div class="sidebar">
    <a href="dashboard.php">📊 Dashboard</a>
    <a href="profile.php">👤 Profile</a>
    <a href="deliveryrequest.php">📦 Delivery Request</a>
    <a href="UpdateStatus.php">🔄 Update Status</a>
    <a href="CompletedDeliveries.php">✅ Completed Deliveries</a>
    <a href="DeliveryHistory.php">📜 Delivery History</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="main">
    <h2>Update Delivery Status</h2>

    <?php if (!empty($update_msg)): ?>
        <div class="update-msg"><?php echo $update_msg; ?></div>
    <?php endif; ?>

    <div class="form-box">
        <!-- Search Form -->
        <form method="POST" action="">
            <label>Search by Order ID</label>
            <input type="text" name="search_id" placeholder="Enter Order ID">
            <button type="submit" name="search" class="btn">Search</button>
        </form>

        <?php if ($order): ?>
        <!-- Update Form -->
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $order['ID']; ?>">

            <label>Order ID</label>
            <input type="text" name="orderid" value="<?php echo htmlspecialchars($order['Orderid']); ?>">

            <label>Pickup</label>
            <input type="text" name="pickup" value="<?php echo htmlspecialchars($order['pickup']); ?>">

            <label>Delivery</label>
            <input type="text" name="delivery" value="<?php echo htmlspecialchars($order['delivery']); ?>">

            <button type="submit" name="update" class="btn">Update</button>
        </form>
        <?php endif; ?>
    </div>
</div>

<footer class="page-footer">
    <p>© 2026 Khao Dao – Fastest Food Delivery. All rights reserved.</p>
</footer>

</body>
</html>


