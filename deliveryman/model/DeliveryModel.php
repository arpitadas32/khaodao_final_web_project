<?php
class DeliveryModel {

    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "khodao");
        if ($this->conn->connect_error) {
            die("DB Connection Failed");
        }
    }

    public function getAllRequests() {
        $sql = "SELECT * FROM deliveryrequest ORDER BY ID DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRequestById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM deliveryrequest WHERE ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function acceptOrder($order) {
        $stmt = $this->conn->prepare(
            "INSERT INTO updatedeliverystatus (Orderid, pickup, delivery) VALUES (?,?,?)"
        );
        $stmt->bind_param("sss", $order['Orderid'], $order['pickup'], $order['delivery']);
        return $stmt->execute();
    }

    public function deleteRequest($id) {
        $stmt = $this->conn->prepare("DELETE FROM deliveryrequest WHERE ID=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
