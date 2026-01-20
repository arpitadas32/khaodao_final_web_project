<?php
require_once "Database.php";

class AssignedOrderModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function getAssignedOrders() {
        $sql = "SELECT * FROM assignedorders ORDER BY Date DESC";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
