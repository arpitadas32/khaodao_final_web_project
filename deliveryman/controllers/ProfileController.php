<?php
require_once "../model/UserModel.php";

/* Cookie Authentication */
if (!isset($_COOKIE['username'])) {
    header("Location: ../login.php");
    exit();
}

$username = $_COOKIE['username'];
$msg = "";

$model = new UserModel();

/* Fetch user info */
$user = $model->getUserByUsername($username);
$email = $user['email'] ?? "";

/* Update logic */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_username = trim($_POST['username']);
    $new_email    = trim($_POST['email']);
    $password     = trim($_POST['password']);

    if ($new_username && $new_email && $password) {
        if ($model->updateProfile($new_username, $new_email, $password, $username)) {
            setcookie("username", $new_username, time() + 86400, "/");
            $username = $new_username;
            $email = $new_email;
            $msg = "success";
        } else {
            $msg = "error";
        }
    } else {
        $msg = "empty";
    }
}

/* Load View */
include "../view/profile.php";
