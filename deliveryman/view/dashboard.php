<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - খাও দাও</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<header class="page-header">
    <h1>খাও দাও</h1>
</header>

<div class="sidebar">
    <a href="#">📊 Dashboard</a>
    <a href="#">👤 Profile</a>
    <a href="#">📦 Delivery Request</a>
    <a href="#">🔄 Update Status</a>
    <a href="#">✅ Completed Deliveries</a>
    <a href="#">📜 Delivery History</a>
    <a href="../logout.php">🚪 Logout</a>
</div>

<div class="main">
    <h2>Welcome Delivery Man, <?= htmlspecialchars($username) ?>!</h2>
    <h3>Assigned Orders</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Order ID</th>
            <th>Pickup</th>
            <th>Date</th>
        </tr>

        <?php foreach ($assigned_orders as $order): ?>
        <tr>
            <td><?= $order['ID'] ?></td>
            <td><?= htmlspecialchars($order['Orderid']) ?></td>
            <td><?= htmlspecialchars($order['pickup']) ?></td>
            <td><?= date('M d, Y h:i A', strtotime($order['Date'])) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<footer class="page-footer">
    © 2026 Khao Dao – Fastest Food Delivery
</footer>

<script src="../controller/validation.js"></script>
</body>
</html>
