<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Delivery History - খাও দাও</title>
    <link rel="stylesheet" href="delivery_history.css">
</head>
<body>

<header class="page-header">
    <h1>খাও দাও</h1>
</header>

<div class="sidebar">
    <a href="../controller/DashboardController.php">📊 Dashboard</a>
    <a href="#">👤 Profile</a>
    <a href="#">📦 Delivery Request</a>
    <a href="#">🔄 Update Status</a>
    <a href="#">✅ Completed Deliveries</a>
    <a href="#">📜 Delivery History</a>
    <a href="../logout.php">🚪 Logout</a>
</div>

<div class="main">
    <h2>Delivery History</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Order ID</th>
            <th>Order</th>
            <th>Price</th>
        </tr>

        <?php if (count($orders) > 0): ?>
            <?php foreach ($orders as $row): ?>
            <tr>
                <td><?= $row['ID'] ?></td>
                <td><?= htmlspecialchars($row['Orderid']) ?></td>
                <td><?= htmlspecialchars($row['Order']) ?></td>
                <td><?= $row['price'] ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" style="text-align:center;">No orders found</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

<footer class="page-footer">
    © 2026 Khao Dao – Fastest Food Delivery
</footer>

<script src="../controller/historyValidation.js"></script>
</body>
</html>
