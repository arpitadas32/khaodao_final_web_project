<?php
require_once "Database.php";

class HistoryModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function getDeliveryHistory() {
        $sql = "SELECT * FROM `order` ORDER BY ID DESC";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
