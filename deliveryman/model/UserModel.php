<?php
require_once "Database.php";

class UserModel {

    public static function login($username, $password) {
        $conn = Database::connect();

        $stmt = $conn->prepare(
            "SELECT * FROM regi WHERE username=? AND password=?"
        );
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->num_rows === 1;
    }
}
