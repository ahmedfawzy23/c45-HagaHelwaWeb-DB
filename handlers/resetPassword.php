<?php

session_start();
require_once "../includes/db_connection.php";
require_once "../includes/validation.php";
require_once "../includes/mailer.php";

if (!isset($_POST['reset_password'])) {
    header("Location: ../resetPassword.php");
    exit();
}

$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$rules = [
    "password" => "required|confirmed",
];

$errors = validate($_POST, $rules);

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header("Location: ../forgetPassword.php");
    exit();
}

$hasedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "UPDATE users set password = ? WHERE email = ?");
mysqli_stmt_bind_param($stmt, "ss", $hasedPassword, $_SESSION['verify_email']);
$success = mysqli_stmt_execute($stmt);

if ($success) {
    $_SESSION['success'] = "Password reset successfully";
    header("Location: ../login.php");
    exit();
} else {
    $_SESSION['errors'][] = "Failed to reset password";
    $_SESSION['old'] = $_POST;
    header("Location: ../resetPassword.php");
    exit();
}
