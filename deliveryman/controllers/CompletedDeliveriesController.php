<?php
require_once "../model/OrderModel.php";

/* Cookie Authentication */
if (!isset($_COOKIE['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_COOKIE['username'];
$msg = "";

$model = new OrderModel();

/* Insert Logic */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $orderid   = trim($_POST['orderid']);
    $ordername = trim($_POST['ordername']);
    $price     = intval($_POST['price']);

    if ($orderid && $ordername && $price > 0) {
        if ($model->insertOrder($orderid, $ordername, $price)) {
            $msg = "✅ New order added successfully!";
        } else {
            $msg = "❌ Failed to insert order.";
        }
    } else {
        $msg = "❗ All fields are required and price must be positive.";
    }
}

$orders = $model->getAllOrders();

/* Load View */
include "../view/completed_deliveries.php";
