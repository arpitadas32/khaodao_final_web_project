<?php
session_start();
require "db.php";

$username = trim($_POST["username"]);
$password = $_POST["password"];

$sql = "SELECT id, username, password FROM users WHERE username=? OR email=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($result)) {
    if (password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        header("Location: dashboard.php");
        exit();
    }
}

header("Location: customer_login.php?error=invalid");
exit();
