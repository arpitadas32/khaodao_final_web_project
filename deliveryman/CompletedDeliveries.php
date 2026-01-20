
<?php
session_start();
require "db.php";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$insert_msg = "";

// Handle insert
if (isset($_POST['insert'])) {
    $orderid = trim($_POST['orderid']);
    $ordername = trim($_POST['ordername']);
    $price = intval($_POST['price']);

    if (!empty($orderid) && !empty($ordername) && $price > 0) {
        $sql = "INSERT INTO `order` (Orderid, `Order`, price) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $orderid, $ordername, $price);
        if (mysqli_stmt_execute($stmt)) {
            $insert_msg = "✅ New order added successfully!";
        } else {
            $insert_msg = "❌ Failed to insert order.";
        }
        mysqli_stmt_close($stmt);
    } else {
        $insert_msg = "❗ All fields are required and price must be positive.";
    }
}

// Fetch all orders
$sql = "SELECT * FROM `order` ORDER BY ID DESC";
$result = mysqli_query($conn, $sql);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Completed Deliveries - খাও দাও</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            margin:0;
            font-family: 'Baloo Da 2', cursive;
            background:#f9fafc;
            color:#333;
            display:flex;
            flex-direction:column;
            min-height:100vh;
        }

        /* HEADER */
        .page-header {
            background: linear-gradient(90deg, #d8ba94, #f07109);
            padding:20px;
            text-align:center;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }
        .page-header h1 {
            font-size:36px;
            color:#fff;
            margin:0;
            text-shadow:2px 2px rgba(0,0,0,0.2);
        }

        /* SIDEBAR */
        .sidebar {
            width:240px;
            background:#d8ba94;
            height:100vh;
            position:fixed;
            padding-top:30px;
            box-shadow:4px 0 15px rgba(0,0,0,0.1);
        }
        .sidebar a {
            display:block;
            padding:15px 25px;
            color:#333;
            text-decoration:none;
            font-weight:bold;
            border-radius:8px;
            margin:5px 10px;
            transition:all 0.3s ease;
        }
        .sidebar a:hover {
            background:#f07109;
            color:#fff;
            transform:translateX(5px);
        }

        /* MAIN */
        .main {
            margin-left:240px;
            padding:40px;
            flex:1; /* main অংশ flex-grow করবে */
        }
        h2 {
            margin-bottom:20px;
            font-size:28px;
            color:#f07109;
        }
        .insert-msg {
            background:#d4edda;
            color:#155724;
            padding:15px;
            border-radius:8px;
            margin-bottom:20px;
            border:1px solid #c3e6cb;
            font-weight:bold;
        }

        /* FORM */
        .form-box {
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 6px 25px rgba(0,0,0,0.1);
            max-width:500px;
            margin-bottom:30px;
        }
        .form-box label {
            display:block;
            margin-top:15px;
            font-weight:bold;
            color:#555;
        }
        .form-box input {
            width:100%;
            padding:12px;
            margin-top:5px;
            border:1px solid #ccc;
            border-radius:8px;
        }
        .btn {
            margin-top:20px;
            padding:12px 20px;
            background: linear-gradient(90deg, #28a745, #218838);
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
            font-weight:bold;
            transition:transform 0.2s ease;
        }
        .btn:hover {
            transform:scale(1.05);
        }

        /* TABLE */
        table {
            width:100%;
            background:white;
            border-collapse:collapse;
            border-radius:10px;
            overflow:hidden;
            box-shadow:0 4px 20px rgba(0,0,0,0.1);
        }
        th, td {
            padding:14px;
            border-bottom:1px solid #eee;
            text-align:left;
        }
        th {
            background:#f07109;
            color:#fff;
            font-size:16px;
        }
        tr:hover {
            background:#fff3e0;
            transition:background 0.3s ease;
        }

        /* FOOTER */
        .page-footer {
            background:#d8ba94;
            padding:20px;
            text-align:center;
            font-size:14px;
            color:#333;
            border-top:2px solid rgba(0,0,0,0.05);
            margin-left:240px;
        }

        /* RESPONSIVE */
        @media (max-width:768px) {
            .sidebar {
                width:100%;
                height:auto;
                position:relative;
                display:flex;
                flex-direction:row;
                overflow-x:auto;
            }
            .sidebar a {
                flex:1;
                text-align:center;
                margin:0;
                border-radius:0;
            }
            .main { margin-left:0; padding:20px; }
            .page-footer { margin-left:0; }
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
    <a href="UpdateStatus.php">🔄 Update Status</a>
    <a href="CompletedDeliveries.php">✅ Completed Deliveries</a>
    <a href="DeliveryHistory.php">📜 Delivery History</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">
    <h2>Completed Deliveries</h2>

    <?php if (!empty($insert_msg)): ?>
        <div class="insert-msg"><?php echo $insert_msg; ?></div>
    <?php endif; ?>

    <!-- Insert Form -->
    <div class="form-box">
        <form method="POST" action="">
            <label>Order ID</label>
            <input type="text" name="orderid" required>

            <label>Order Name</label>
            <input type="text" name="ordername" required>

            <label>Price</label>
            <input type="number" name="price" required>

            <button type="submit" name="insert" class="btn">Complete Delivery</button>
        </form>
    </div>

    <!-- Full Order Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Order</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $row): ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo htmlspecialchars($row['Orderid']); ?></td>
                    <td><?php echo htmlspecialchars($row['Order']); ?></td>
                    <td><?php echo $row['price']; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center;">No completed deliveries found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- FOOTER -->
<footer class="page-footer">
    <p>© 2026 Khao Dao – Fastest Food Delivery. All rights reserved.</p>
</footer>

</body>
</html>


