<?php
session_start();
require_once "../models/UpdateStatusModel.php";

/* SESSION + COOKIE CHECK */
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location: ../views/login.php");
    exit();
}

if (isset($_SESSION['username'])) {
    setcookie("username", $_SESSION['username'], time()+3600, "/");
}

$model = new UpdateStatusModel();
$update_msg = "";
$order = null;

/* SEARCH */
if (isset($_POST['search'])) {
    $search_id = trim($_POST['search_id']);

    if (!empty($search_id)) {
        $order = $model->searchByOrderId($search_id);

        if (!$order) {
            $update_msg = "❌ No record found for Order ID: " . htmlspecialchars($search_id);
        }
    }
}

/* UPDATE */
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $orderid = trim($_POST['orderid']);
    $pickup = trim($_POST['pickup']);
    $delivery = trim($_POST['delivery']);

    if ($orderid && $pickup && $delivery) {
        if ($model->updateStatus($id, $orderid, $pickup, $delivery)) {
            $update_msg = "✅ Delivery status updated successfully!";
        } else {
            $update_msg = "❌ Update failed!";
        }
    } else {
        $update_msg = "❗ All fields are required!";
    }
}

require "../views/update_status.php";
