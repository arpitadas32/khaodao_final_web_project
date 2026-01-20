<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
require "db.php";

// Fetch counts
$user_query = $conn->query("SELECT COUNT(*) as total FROM users");
$users_count = ($user_query) ? $user_query->fetch_assoc()["total"] : 0;

$delivery_query = $conn->query("SELECT COUNT(*) as total FROM regi");
$delivery_count = ($delivery_query) ? $delivery_query->fetch_assoc()["total"] : 0;

$menu_query = $conn->query("SELECT COUNT(*) as total FROM menu_items");
$menu_count = ($menu_query) ? $menu_query->fetch_assoc()["total"] : 0;

$order_query = $conn->query("SELECT COUNT(*) as total FROM orders");
$orders_count = ($order_query) ? $order_query->fetch_assoc()["total"] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Khao Dao - Admin Dashboard</title>
<style>
    /* Prevent body scroll if content is small */
    html, body { height: 100%; overflow: hidden; } 
    .stat-card { transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0,0,0,0.15) !important; }
    
    /* Content container that scrolls only if cards overflow */
    .main-wrapper {
        margin-left: 240px;
        height: 100vh;
        display: flex;
        flex-direction: column;
        overflow-y: auto; /* Scroll only if content actually exceeds height */
    }
</style>
</head>
<body style="margin:0; font-family:Arial, sans-serif; background:#f5f7fa;">

<?php include "sidebar.php"; ?>

<div class="main-wrapper">
  
  <div style="padding:25px; flex: 1;">

    <div style="background:white; padding:20px; border-radius:8px; margin-bottom:25px; box-shadow:0 2px 10px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="color:#2c3e50; margin: 0;">🚀 Admin Dashboard</h2>
            <p style="margin: 5px 0 0 0; color: #7f8c8d;">Welcome back, <strong><?= htmlspecialchars($_SESSION["admin"]) ?></strong></p>
        </div>
        <div style="text-align: right; color: #7f8c8d; font-size: 14px;">
            📅 <?= date('l, d M Y') ?>
        </div>
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:20px; margin-bottom:30px;">
        
        <div class="stat-card" style="background:white; padding:25px; border-radius:10px; box-shadow:0 3px 15px rgba(0,0,0,0.1); border-left:5px solid #3498db;">
            <h3 style="color:#7f8c8d; font-size:14px; margin-bottom:10px; text-transform: uppercase;">👥 Customers</h3>
            <div style="font-size:32px; font-weight:bold; color:#2c3e50;"><?= number_format($users_count) ?></div>
        </div>

        <div class="stat-card" style="background:white; padding:25px; border-radius:10px; box-shadow:0 3px 15px rgba(0,0,0,0.1); border-left:5px solid #2ecc71;">
            <h3 style="color:#7f8c8d; font-size:14px; margin-bottom:10px; text-transform: uppercase;">🚚 Deliverymen</h3>
            <div style="font-size:32px; font-weight:bold; color:#2c3e50;"><?= number_format($delivery_count) ?></div>
        </div>

        <div class="stat-card" style="background:white; padding:25px; border-radius:10px; box-shadow:0 3px 15px rgba(0,0,0,0.1); border-left:5px solid #f39c12;">
            <h3 style="color:#7f8c8d; font-size:14px; margin-bottom:10px; text-transform: uppercase;">🍱 Food Menu</h3>
            <div style="font-size:32px; font-weight:bold; color:#2c3e50;"><?= number_format($menu_count) ?></div>
        </div>

        <div class="stat-card" style="background:white; padding:25px; border-radius:10px; box-shadow:0 3px 15px rgba(0,0,0,0.1); border-left:5px solid #e74c3c;">
            <h3 style="color:#7f8c8d; font-size:14px; margin-bottom:10px; text-transform: uppercase;">🛍️ Orders</h3>
            <div style="font-size:32px; font-weight:bold; color:#2c3e50;"><?= number_format($orders_count) ?></div>
        </div>
    </div>

  </div>

  <?php include "footer.php"; ?>

</div>

</body>
</html>