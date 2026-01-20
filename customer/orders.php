<?php
session_start();
require "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: customer_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders - KHAO DAO</title>
	<link rel="stylesheet" href="dashboard.css">
  <style>
 .dashboard {
    display: flex;
    min-height: 100vh;
    font-family: 'Segoe UI', sans-serif;
    background: #f8f9fa;
}

.main {
    flex: 1;
    margin-left: 260px; /* same as sidebar width */
    padding: 30px 45px;
    min-height: 100vh;
    overflow-y: auto;
    background-color: #f9f9f9;
}


/* Headings */
h2 {
    margin-bottom: 25px;
    font-size: 28px;
    color: #333;
}

/* Alerts */
.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

/* Order Cards */
.order-card {
    background: #fff;
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.order-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-weight: 600;
    color: #333;
}

.status {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    background: #f0f0f0;
    font-weight: 500;
}

/* Order Items */
.order-items {
    margin-bottom: 15px;
}

.order-item {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 12px;
}

.order-item img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 12px;
}

/* Divider */
hr {
    margin: 15px 0;
    border: 0;
    border-top: 1px dashed #eee;
}

/* Total / Delivery info */
.order-summary {
    display: flex;
    justify-content: space-between;
    font-weight: 600;
    font-size: 15px;
    color: #333;
    margin-top: 10px;
}
</style>
</head>
<body>
<div class="dashboard">
<?php include 'sidebar.php'; ?>

<div class="main">
    <h2>My Orders</h2>

    <?php if (isset($_GET['success'])): ?>
        <p class="alert-success">✅ Order placed successfully!</p>
    <?php endif; ?>

    <?php if (mysqli_num_rows($result) == 0): ?>
        <p>No orders yet.</p>
    <?php endif; ?>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="order-card">
            <div class="order-header">
                <strong>Order #<?= $row['id'] ?></strong>
                <span class="status"><?= htmlspecialchars($row['status']) ?></span>
            </div>

            <div class="order-items">
                <?php
                $items = json_decode($row['order_data'], true); 
                if (!empty($items)) {
                    foreach ($items as $item) {
                        
                        $imgPath = !empty($item['img']) ? $item['img'] : 'images/default_food.png';
                        echo "<div class='order-item'>
                            <img src='{$imgPath}' alt='" . htmlspecialchars($item['name']) . "'>
                            <div>
                                <strong>" . htmlspecialchars($item['name']) . "</strong><br>
                                ৳{$item['price']} × {$item['quantity']}
                            </div>
                        </div>";
                    }
                } else {
                    echo "<p>No items found</p>";
                }
                ?>
            </div>

            <hr>
            <p>Delivery: ৳<?= $row['delivery_charge'] ?><br>
               <strong>Total: ৳<?= $row['total_amount'] ?></strong>
            </p>
        </div>
    <?php endwhile; ?>
</div>
</div>
</body>
</html>
