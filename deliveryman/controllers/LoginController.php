<?php
require_once __DIR__ . "/../models/UserModel.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        $error = "All fields are required.";
    } else {
        if (UserModel::login($username, $password)) {

            // Cookie based session
            setcookie("username", $username, time() + 3600, "/");

            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}
