<?php
class UpdateStatusModel {

    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "khodao");
        if ($this->conn->connect_error) {
            die("Database Connection Failed");
        }
    }

    public function searchByOrderId($orderid) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM updatedeliverydtatus WHERE Orderid=?"
        );
        $stmt->bind_param("s", $orderid);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateStatus($id, $orderid, $pickup, $delivery) {
        $stmt = $this->conn->prepare(
            "UPDATE updatedeliverydtatus 
             SET Orderid=?, pickup=?, delivery=? 
             WHERE ID=?"
        );
        $stmt->bind_param("sssi", $orderid, $pickup, $delivery, $id);
        return $stmt->execute();
    }
}
