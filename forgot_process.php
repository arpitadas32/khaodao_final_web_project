<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: forgot_password.php");
    exit();
}

$username = trim($_POST["username"]);
$new_pass = $_POST["new_password"];
$confirm_pass = $_POST["confirm_password"];

if ($new_pass !== $confirm_pass) {
    die("Passwords do not match!");
}

$hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);

// find user
$sql = "SELECT id FROM users WHERE username=? OR email=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($result)) {

    $update = "UPDATE users SET password=? WHERE id=?";
    $stmt2 = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt2, "si", $hashed_pass, $user["id"]);
    mysqli_stmt_execute($stmt2);

    header("Location: customer_login.php?reset=success");
    exit();

} else {
    die("User not found!");
}
