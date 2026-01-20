<?php
require_once __DIR__ . "/../models/UserModel.php";

$message = "";
$msgType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $new_password = trim($_POST["new_password"]);

    if (empty($email) || empty($new_password)) {
        $message = "All fields are required.";
        $msgType = "error";
    } else {

        if (UserModel::emailExists($email)) {

            if (UserModel::updatePassword($email, $new_password)) {

                // cookie set (password reset flag)
                setcookie("password_reset", "success", time() + 300, "/");

                $message = "Password updated successfully.";
                $msgType = "success";
            } else {
                $message = "Failed to update password.";
                $msgType = "error";
            }

        } else {
            $message = "Email not found.";
            $msgType = "warning";
        }
    }
}
