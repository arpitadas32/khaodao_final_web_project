<?php
session_start();
require_once "../models/DeliveryModel.php";

/* SESSION + COOKIE */
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location: ../views/login.php");
    exit();
}

if (isset($_SESSION['username'])) {
    setcookie("username", $_SESSION['username'], time()+3600, "/");
}

$model = new DeliveryModel();
$message = "";

/* ACCEPT */
if (isset($_POST['accept'])) {
    $id = intval($_POST['order_id']);
    $order = $model->getRequestById($id);

    if ($order) {
        $model->acceptOrder($order);
        $model->deleteRequest($id);
        $message = "✅ Order Accepted Successfully!";
    } else {
        $message = "❌ Order Not Found!";
    }
}

/* REJECT */
if (isset($_POST['reject'])) {
    $id = intval($_POST['order_id']);
    $model->deleteRequest($id);
    $message = "❌ Order Rejected Successfully!";
}

/* DATA FOR VIEW */
$requests = $model->getAllRequests();

require "../views/delivery_request.php";
