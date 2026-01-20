
<?php
session_start();
require "db.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];

// Fetch assigned orders
$sql = "SELECT * FROM assignedorders ORDER BY Date DESC";
$result = mysqli_query($conn, $sql);
$assigned_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - খাও দাও</title>
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
            font-size: 40px;
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
            animation: fadeIn 0.6s ease-in-out;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 30px;
            color: #f07109;
        }
        h3 {
            margin-bottom: 15px;
            font-size: 22px;
            color: #555;
        }

        /* TABLE */
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

        /* FOOTER */
        .page-footer {
            background: #d8ba94;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #333;
            border-top: 2px solid rgba(0,0,0,0.05);
            margin-left: 240px;
        }

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
            .page-footer {
                margin-left: 0;
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
    <h2>Welcome Delivery Man, <?php echo htmlspecialchars($username); ?>!</h2>
    <h3>Assigned Orders</h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Pickup</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assigned_orders as $order): ?>
            <tr>
                <td><?php echo $order['ID']; ?></td>
                <td><?php echo htmlspecialchars($order['Orderid']); ?></td>
                <td><?php echo htmlspecialchars($order['pickup']); ?></td>
                <td><?php echo date('M d, Y h:i A', strtotime($order['Date'])); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- FOOTER -->
<footer class="page-footer">
    <p>© 2026 Khao Dao – Fastest Food Delivery. All rights reserved.</p>
</footer>

</body>
</html>


