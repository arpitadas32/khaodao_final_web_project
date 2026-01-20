<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
require "db.php";

// DELETE PROCESS
if (isset($_GET["delete"])) {
    $delete_id = (int)$_GET["delete"];
    $conn->query("DELETE FROM users WHERE id = $delete_id");
    header("Location: manage_customers.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Manage Customers</title>
<style>
    /* Prevents the outer body from scrolling */
    html, body { height: 100%; overflow: hidden; margin: 0; } 
    
    /* Wrapper for main content + footer */
    .main-wrapper {
        margin-left: 240px; /* Width of your sidebar */
        height: 100vh;
        display: flex;
        flex-direction: column;
        overflow-y: auto; /* Scrollbar appears only if content overflows */
        background: #f5f7fa;
    }
    
    /* Hover effect for table rows */
    tr.data-row:hover { background: #f9f9f9; }
</style>
</head>
<body style="font-family:Arial,sans-serif;">

<?php include "sidebar.php"; ?>

<div class="main-wrapper">
    <div style="padding:25px; flex: 1;">
        
        <div style="background:white; padding:20px; border-radius:8px; margin-bottom:25px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
            <h2 style="color:#2c3e50; margin:0;">👥 Manage Customers</h2>
            <p style="color:#7f8c8d; margin:5px 0 0 0;">Customer management portal</p>
        </div>

        <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px;">
            <input type="text" placeholder="Search by username or email..." style="padding:10px; border:1px solid #ddd; border-radius:4px; flex:1;">
            <select style="padding:10px; border:1px solid #ddd; border-radius:4px;">
                <option>All Customers</option>
                <option>Newest First</option>
                <option>Oldest First</option>
            </select>
            <button style="padding:10px 16px; background:#3498db; color:white; border:none; border-radius:4px; cursor:pointer;">Filter</button>
        </div>

        <div style="background:white; border-radius:10px; overflow:hidden; box-shadow:0 3px 15px rgba(0,0,0,0.1);">
            <table style="width:100%; border-collapse:collapse;">
                <thead style="background:#2c3e50; color:white;">
                    <tr>
                        <th style="padding:15px 20px; text-align:left;">ID</th>
                        <th style="padding:15px 20px; text-align:left;">Profile</th>
                        <th style="padding:15px 20px; text-align:left;">Username</th>
                        <th style="padding:15px 20px; text-align:left;">Email</th>
                        <th style="padding:15px 20px; text-align:left;">Joined Date</th>
                        <th style="padding:15px 20px; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    $res = $conn->query("SELECT * FROM users ORDER BY id DESC");
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $date = date('M d, Y', strtotime($row['created_at']));
            echo "<tr class='data-row' style='border-bottom:1px solid #eee;'>
                <td style='padding:12px 20px;'>#{$row['id']}</td>
                <td style='padding:12px 20px;'>👤</td>
                <td style='padding:12px 20px;'><strong>" . htmlspecialchars($row['username']) . "</strong></td>
                <td style='padding:12px 20px;'>" . htmlspecialchars($row['email']) . "</td>
                <td style='padding:12px 20px;'>{$date}</td>
                <td style='padding:12px 20px; text-align:right;'>
                    <a href='edit_record.php?id={$row['id']}&type=customer' style='padding:6px 12px; background:#3498db; color:white; border-radius:4px; text-decoration:none; margin-right:5px; font-size:13px;'>Edit</a>
                    <a href='?delete={$row['id']}' onclick='return confirm(\"Are you sure?\")' style='padding:6px 12px; background:#e74c3c; color:white; border-radius:4px; text-decoration:none; font-size:13px;'>Delete</a>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6' style='padding:30px; text-align:center; color:#95a5a6;'>No customers found.</td></tr>";
    }
    ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px; color:#64748b; font-size:14px; padding-bottom: 20px;">
            Showing <strong><?= ($res) ? $res->num_rows : 0 ?></strong> registered customers
        </div>
    </div>

    <?php include "footer.php"; ?>
</div>

</body>
</html>