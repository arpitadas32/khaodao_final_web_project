<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Completed Deliveries</title>
    <link rel="stylesheet" href="completed_deliveries.css">
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
    <h2>Completed Deliveries</h2>

    <?php if ($msg): ?>
        <div class="insert-msg"><?= $msg ?></div>
    <?php endif; ?>

    <div class="form-box">
        <form method="POST" onsubmit="return validateOrderForm();">
            <label>Order ID</label>
            <input type="text" name="orderid" id="orderid">

            <label>Order Name</label>
            <input type="text" name="ordername" id="ordername">

            <label>Price</label>
            <input type="number" name="price" id="price">

            <button type="submit" class="btn">Complete Delivery</button>
        </form>
    </div>

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
            <tr><td colspan="4">No completed deliveries</td></tr>
        <?php endif; ?>
    </table>
</div>

<footer class="page-footer">
    © 2026 Khao Dao – Fastest Food Delivery
</footer>

<script src="../controller/orderValidation.js"></script>
</body>
</html>
