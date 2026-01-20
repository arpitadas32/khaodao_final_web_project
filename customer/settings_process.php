<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];


if (isset($_POST['update_info'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = $_POST['new_password'];

    if (!empty($new_password)) {
        $password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET username='$username', email='$email', password='$password_hashed' WHERE id='$user_id'";
    } else {
        $update_query = "UPDATE users SET username='$username', email='$email' WHERE id='$user_id'";
    }

    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success'] = "Account information updated successfully.";
    } else {
        $_SESSION['error'] = "Error updating account info: ".mysqli_error($conn);
    }

    header("Location: settings.php");
    exit();
}


if (isset($_POST['upload_photo'])) {
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $file_name = time() . "_" . $_FILES['profile_image']['name'];
        $file_tmp = $_FILES['profile_image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];

        if (in_array($file_ext, $allowed)) {
            if (!is_dir("uploads")) {
                mkdir("uploads", 0777, true);
            }

            if (move_uploaded_file($file_tmp, "uploads/".$file_name)) {
                
                $update = mysqli_query($conn, "UPDATE users SET profile_pic='$file_name' WHERE id='$user_id'");
                if ($update) {
                    $_SESSION['success'] = "Profile photo updated successfully.";
                } else {
                    $_SESSION['error'] = "Failed to update profile photo in database.";
                }
            } else {
                $_SESSION['error'] = "Failed to upload file.";
            }
        } else {
            $_SESSION['error'] = "Invalid file type. Allowed: jpg, jpeg, png, gif.";
        }
    } else {
        $_SESSION['error'] = "No file selected or upload error.";
    }

    header("Location: settings.php");
    exit();
}
