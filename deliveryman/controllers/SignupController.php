<?php
require_once __DIR__ . "/../models/UserModel.php";

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm = trim($_POST["confirm_password"]);

    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if (empty($errors)) {

        if (UserModel::userExists($username, $email)) {
            $errors[] = "Username or Email already exists.";
        } else {
            if (UserModel::createUser($username, $email, $password)) {

                // cookie set after signup
                setcookie("signup_success", "1", time() + 300, "/");

                $success = "Account created successfully!";
            } else {
                $errors[] = "Error inserting data.";
            }
        }
    }
}
