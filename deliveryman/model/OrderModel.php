<?php
require_once "Database.php";

class OrderModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function insertOrder($orderid, $ordername, $price) {
        $sql = "INSERT INTO `order` (Orderid, `Order`, price) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $orderid, $ordername, $price);
        return mysqli_stmt_execute($stmt);
    }

    public function getAllOrders() {
        $sql = "SELECT * FROM `order` ORDER BY ID DESC";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
