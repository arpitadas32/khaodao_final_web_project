<?php
require_once __DIR__ . "/../models/UserModel.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        $error = "Both email and new password are required.";
    } else {

        if (UserModel::findByEmail($email)) {

            if (UserModel::resetPassword($email, $password)) {

                // cookie set instead of session
                setcookie("reset_success", "1", time() + 300, "/");

                $success = "Password updated successfully. <a href='../login.php'>Login</a>";
            } else {
                $error = "Password update failed.";
            }

        } else {
            $error = "Email not found.";
        }
    }
}
