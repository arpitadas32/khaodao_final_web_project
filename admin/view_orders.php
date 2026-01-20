<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
require "db.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Manage Orders </title>
<style>
    /* Prevent body scroll */
    html, body { height: 100%; overflow: hidden; margin: 0; } 
    
    /* Wrapper for main content + footer */
    .main-wrapper {
        margin-left: 240px; 
        height: 100vh;
        display: flex;
        flex-direction: column;
        overflow-y: auto; 
        background: #f5f7fa;
    }
    
    tr.order-row:hover { background: #f9f9f9; }
    
    .status-badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        color: white;
    }
</style>
</head>
<body style="font-family:Arial,sans-serif;">

<?php include "sidebar.php"; ?>

<div class="main-wrapper">
    <div style="padding:25px; flex: 1;">
        
        <div style="background:white; padding:20px; border-radius:8px; margin-bottom:25px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
            <h2 style="color:#2c3e50; margin:0;">🛍️ Customer Orders</h2>
            <p style="color:#7f8c8d; margin:5px 0 0 0;">Manage and track food delivery requests</p>
        </div>

        <div style="background:white; border-radius:10px; overflow:hidden; box-shadow:0 3px 15px rgba(0,0,0,0.1);">
            <table style="width:100%; border-collapse:collapse;">
                <thead style="background:#2c3e50; color:white;">
                    <tr>
                        <th style="padding:15px 20px; text-align:left;">Order ID</th>
                        <th style="padding:15px 20px; text-align:left;">Customer ID</th>
                        <th style="padding:15px 20px; text-align:left;">Total Amount</th>
                        <th style="padding:15px 20px; text-align:left;">Status</th>
                        <th style="padding:15px 20px; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
<?php
$res = $conn->query("SELECT * FROM orders ORDER BY id DESC");
if ($res && $res->num_rows > 0) {
    while ($o = $res->fetch_assoc()) {
        // Status color logic
        $status = strtolower($o['status']);
        $bg = "#7f8c8d"; // Default Grey
        if ($status == 'delivered' || $status == 'completed') $bg = "#27ae60"; // Green
        if ($status == 'pending' || $status == 'processing') $bg = "#f39c12"; // Orange
        if ($status == 'cancelled') $bg = "#e74c3c"; // Red

        echo "<tr class='order-row' style='border-bottom:1px solid #eee;'>
            <td style='padding:12px 20px;'>#{$o['id']}</td>
            <td style='padding:12px 20px;'>User #{$o['user_id']}</td>
            <td style='padding:12px 20px; font-weight:bold; color:#2c3e50;'>৳" . number_format($o['total'], 2) . "</td>
            <td style='padding:12px 20px;'>
                <span class='status-badge' style='background: {$bg};'>".ucfirst($o['status'])."</span>
            </td>
            <td style='padding:12px 20px; text-align:right;'>
                <button style='padding:6px 15px; background:#3498db; color:white; border:none; border-radius:4px; cursor:pointer; font-size:12px;'>View Details</button>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5' style='padding:40px; text-align:center; color:#bdc3c7;'>No orders found.</td></tr>";
}
?>
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px; color:#64748b; font-size:14px; padding-bottom: 20px;">
            Total Records: <strong><?= ($res) ? $res->num_rows : 0 ?></strong>
        </div>
    </div>

    <?php include "footer.php"; ?>
</div>

</body>
</html>