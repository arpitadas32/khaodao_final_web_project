<?php
session_start();
require "db.php"; 


if (!isset($_SESSION["user_id"])) {
    header("Location: customer_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = mysqli_prepare($conn, "SELECT username, email, created_at FROM users WHERE id = ?");
mysqli_stmt_bind_param($query, "i", $user_id);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);
$user = mysqli_fetch_assoc($result);
$username = $user['username'] ?? 'User';
$email = $user['email'] ?? '';
$created_at = $user['created_at'] ?? null;
mysqli_stmt_close($query);

$order_sql = "SELECT COUNT(*) as total_orders FROM orders WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $order_sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$order_result = mysqli_stmt_get_result($stmt);
$order_data = mysqli_fetch_assoc($order_result);
$total_orders = $order_data['total_orders'] ?? 0;
mysqli_stmt_close($stmt);


$revenue_sql = "SELECT SUM(total_amount) as total_spent FROM orders WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $revenue_sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$rev_result = mysqli_stmt_get_result($stmt);
$rev_data = mysqli_fetch_assoc($rev_result);
$total_spent = $rev_data['total_spent'] ?? 0;
mysqli_stmt_close($stmt);


$recent_sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 3";
$stmt = mysqli_prepare($conn, $recent_sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$recent_result = mysqli_stmt_get_result($stmt);
$recent_orders = mysqli_fetch_all($recent_result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);


$avg_order = $total_orders > 0 ? $total_spent / $total_orders : 0;


$order_success = $_GET['order_success'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard - KHAO DAO</title>
<link rel="stylesheet" href="dashboard.css">

</head>
<body>
<div class="dashboard">
    <?php include 'sidebar.php'; ?>
    
    <div class="main">
        
        <?php if ($order_success): ?>
        <div class="alert-success" id="successAlert">
            <div>
                <strong>✅ Order Successful!</strong> Your order #<?php echo htmlspecialchars($order_success); ?> has been placed.
            </div>
            <button class="close" onclick="document.getElementById('successAlert').style.display='none'">&times;</button>
        </div>
        <?php endif; ?>
        
        <div class="topbar">
            <h3 style="margin:0;">Welcome back, <?php echo htmlspecialchars($username); ?>!</h3>
            <span style="color: #666; font-size: 14px;"><?php echo date('l, F j, Y'); ?></span>
        </div>

        <div class="cards">
            <div class="card orders">
                <h4>Total Orders</h4>
                <p><?php echo $total_orders; ?></p>
                <small style="color: #888;">All time orders</small>
            </div>
            
            <div class="card spent">
                <h4>Total Spent</h4>
                <p>৳ <?php echo number_format($total_spent, 2); ?></p>
                <small style="color: #888;">Total expenditure</small>
            </div>
            
            <div class="card avg">
                <h4>Avg. Order Value</h4>
                <p>৳ <?php echo number_format($avg_order, 2); ?></p>
                <small style="color: #888;">Per order average</small>
            </div>
            
            <div class="card status">
                <h4>Account Status</h4>
                <p style="color: #4CAF50; font-size: 1.2rem;">✓ Active</p>
                <small style="color: #888;">
                    <?php if ($created_at) echo "Member since " . date('M Y', strtotime($created_at)); ?>
                </small>
            </div>
        </div>

        <div class="overview-card">
            <h4 style="color: #764ba2; margin-bottom: 15px;">📊 Activity Overview</h4>
            <p style="color: #666; line-height: 1.6;">
                Hello <strong><?php echo htmlspecialchars($username); ?></strong>, 
                you have placed <strong><?php echo $total_orders; ?></strong> orders so far, 
                spending a total of <strong>৳ <?php echo number_format($total_spent, 2); ?></strong>.
                <?php if($total_orders > 0): ?>
                Your average order value is <strong>৳ <?php echo number_format($avg_order, 2); ?></strong>.
                <?php endif; ?>
            </p>
            
            <div class="quick-actions">
                <a href="menu.php" class="action-btn" style="background: #8fe15c;">🍱 Order Now</a>
                <a href="orders.php" class="action-btn" style="background: #d06fe1;">📜 View Orders</a>
                <a href="profile.php" class="action-btn" style="background: #22a0ef;">👤 My Profile</a>
            </div>
        </div>

        <?php if($total_orders > 0): ?>
        <div class="recent-orders">
            <h4 style="color: #764ba2; margin-bottom: 15px;">📋 Recent Orders</h4>
            <?php if(count($recent_orders) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($recent_orders as $order): 
                        $order_date = date('M d, Y', strtotime($order['created_at']));
                        $status_class = strtolower($order['status']);
                    ?>
                    <tr>
                        <td>#<?php echo $order['id']; ?></td>
                        <td><?php echo $order_date; ?></td>
                        <td>৳ <?php echo number_format($order['total_amount'], 2); ?></td>
                        <td>
                            <span class="status-badge status-<?php echo $status_class; ?>">
                                <?php echo $order['status']; ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p style="color: #888; text-align: center; padding: 20px;">No recent orders found.</p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="footer">
            <p>© <?php echo date("Y"); ?> Khao Dao - Fastest Food Delivery. All rights reserved.</p>
        </div>
    </div>
</div>

<script>
    
    setTimeout(function() {
        var alert = document.getElementById('successAlert');
        if (alert) { alert.style.display = 'none'; }
    }, 5000);
</script>
</body>
</html>
