<?php
// session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>

<style>
    .nav-link-item {
        transition: background 0.25s ease, color 0.25s ease;
    }

    .nav-link-item:hover {
        background: #3b5368;
        color: #ffffff !important;
    }
</style>


<div class="sidebar" style="
    width: 240px;
    height: 100vh;
    background: #2c3e50;
    padding: 25px 20px;
    position: fixed;
    left: 0;
    top: 0;
    display: flex;
    flex-direction: column;
    box-sizing: border-box;
    z-index: 1000;
">

    <h2 style="
        font-family: 'Baloo Da 2', cursive;
        font-weight: 700;
        color: #ff5722;
        text-align: center;
        font-size: 32px;
        margin-bottom: 25px;
        text-shadow: 2px 2px 0px #ffd54f;
        margin-top: 0;
    ">
        খাও দাও
    </h2>

    <nav style="flex-grow: 1; display: flex; flex-direction: column; gap: 8px;">

        <a href="dashboard.php" class="nav-link-item"
           style="display: flex; align-items: center; padding: 12px 15px;
           color: #ecf0f1; text-decoration: none; border-radius: 5px;
           font-size: 15px;
           <?php if($current_page=='dashboard.php') echo 'background:#3498db;color:white;'; ?>">
           <span style="margin-right: 10px;">📊</span> Dashboard
        </a>

        <a href="manage_customers.php" class="nav-link-item"
           style="display: flex; align-items: center; padding: 12px 15px;
           color: #ecf0f1; text-decoration: none; border-radius: 5px;
           font-size: 15px;
           <?php if($current_page=='manage_customers.php') echo 'background:#3498db;color:white;'; ?>">
           <span style="margin-right: 10px;">👥</span> Customers
        </a>

        <a href="manage_delivery.php" class="nav-link-item"
           style="display: flex; align-items: center; padding: 12px 15px;
           color: #ecf0f1; text-decoration: none; border-radius: 5px;
           font-size: 15px;
           <?php if($current_page=='manage_delivery.php') echo 'background:#3498db;color:white;'; ?>">
           <span style="margin-right: 10px;">🚚</span> Delivery
        </a>

        <a href="manage_menu.php" class="nav-link-item"
           style="display: flex; align-items: center; padding: 12px 15px;
           color: #ecf0f1; text-decoration: none; border-radius: 5px;
           font-size: 15px;
           <?php if($current_page=='manage_menu.php') echo 'background:#3498db;color:white;'; ?>">
           <span style="margin-right: 10px;">🍱</span> Food Menu
        </a>

        <a href="view_orders.php" class="nav-link-item"
           style="display: flex; align-items: center; padding: 12px 15px;
           color: #ecf0f1; text-decoration: none; border-radius: 5px;
           font-size: 15px;
           <?php if($current_page=='view_orders.php') echo 'background:#3498db;color:white;'; ?>">
           <span style="margin-right: 10px;">🛍️</span> Orders
        </a>

        <a href="profile.php" class="nav-link-item"
           style="display: flex; align-items: center; padding: 12px 15px;
           color: #ecf0f1; text-decoration: none; border-radius: 5px;
           font-size: 15px;
           <?php if($current_page=='profile.php') echo 'background:#3498db;color:white;'; ?>">
           <span style="margin-right: 10px;">⚙️</span> Admin Profile
        </a>

        <a href="logout.php"
           onclick="return confirm('Are you sure?')"
           style="display: flex; align-items: center; padding: 12px 15px;
           color: white; text-decoration: none; border-radius: 5px;
           font-size: 15px; background: #e53c29; margin-top: 20px;">
           <span style="margin-right: 10px;">🚪</span> Logout
        </a>
    </nav>

    <div style="text-align: center; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
        <h4 style="font-family: 'Baloo Da 2', cursive; color: #ff5722; margin: 0;">খাও দাও</h4>
        <p style="color: #95a5a6; font-size: 13px; margin: 0;">Admin Panel</p>
    </div>
</div>
