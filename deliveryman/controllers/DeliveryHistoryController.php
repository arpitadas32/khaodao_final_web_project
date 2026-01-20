<?php
require_once "../model/HistoryModel.php";

/* Cookie Authentication */
if (!isset($_COOKIE['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_COOKIE['username'];

$model = new HistoryModel();
$orders = $model->getDeliveryHistory();

/* Load View */
include "../view/delivery_history.php";
