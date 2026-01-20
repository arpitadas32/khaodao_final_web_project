
<?php
session_start();
require "db.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$accepted_msg = "";

// Accept logic
if (isset($_POST['accept'])) {
    $id = intval($_POST['order_id']);
    $sql = "SELECT * FROM deliveryrequest WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $order = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($order) {
        $insert_sql = "INSERT INTO updatedeliverystatus (Orderid, pickup, delivery) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($stmt, "sss", $order['Orderid'], $order['pickup'], $order['delivery']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $delete_sql = "DELETE FROM deliveryrequest WHERE ID = ?";
        $stmt = mysqli_prepare($conn, $delete_sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $accepted_msg = "✅ Order Accepted Successfully!";
    } else {
        $accepted_msg = "❌ Order ID not found.";
    }
}

// Reject logic
if (isset($_POST['reject'])) {
    $id = intval($_POST['order_id']);
    $delete_sql = "DELETE FROM deliveryrequest WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $delete_sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $accepted_msg = "❌ Order Rejected and Deleted.";
}

// Fetch requests
$sql = "SELECT * FROM deliveryrequest ORDER BY ID DESC";
$result = mysqli_query($conn, $sql);
$requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Delivery Request - খাও দাও</title>
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
        .accepted-msg {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            font-weight: bold;
        }
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        th {
            background: #f07109;
            color: #fff;
            font-size: 16px;
        }
        tr:hover {
            background: #fff3e0;
            transition: background 0.3s ease;
        }
        .form-box {
            margin-top: 30px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.1);
            max-width: 500px;
        }
        .form-box label {
            font-weight: bold;
            color: #555;
        }
        input[type="number"] {
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 10px;
        }
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
        }
        .accept-btn { background: #28a745; color: white; }
        .reject-btn { background: #dc3545; color: white; }
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
    <h2>Delivery Requests</h2>

    <?php if (!empty($accepted_msg)): ?>
        <div class="accepted-msg"><?php echo $accepted_msg; ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Pickup</th>
                <th>Delivery</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($requests) > 0): ?>
                <?php foreach ($requests as $req): ?>
                <tr>
                    <td><?php echo $req['ID']; ?></td>
                    <td><?php echo htmlspecialchars($req['Orderid']); ?></td>
                    <td><?php echo htmlspecialchars($req['pickup']); ?></td>
                    <td><?php echo htmlspecialchars($req['delivery']); ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center;">No delivery requests found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="form-box">
        <form method="POST" action="">
            <label>Enter Order ID to Accept/Reject</label>
            <input type="number" name="order_id" required>
            <br><br>
            <button type="submit" name="accept" class="btn accept-btn">Accept</button>
            <button type="submit" name="reject" class="btn reject-btn">Reject</button>
        </form>
    </div>
</div>

<footer class="page-footer">
    <p>© 2026 Khao Dao – Fastest Food Delivery. All rights reserved.</p>
</footer>

</body>


