<?php
require_once "../model/AssignedOrderModel.php";

/* Cookie Check */
if (!isset($_COOKIE['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_COOKIE['username'];

$model = new AssignedOrderModel();
$assigned_orders = $model->getAssignedOrders();

/* View Load */
include "../view/dashboard.php";
