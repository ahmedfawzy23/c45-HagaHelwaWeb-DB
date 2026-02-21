<?php

session_start();
require_once "../includes/db_connection.php";
require_once "../includes/validation.php";
require_once "../includes/mailer.php";

if (!isset($_POST['send_otp'])) {
    header("Location: ../forgetPassword.php");
    exit();
}

$email = $_POST['email'];

$rules = [
    "email" => "required|email|exists:users,email",
];

$errors = validate($_POST, $rules);

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header("Location: ../forgetPassword.php");
    exit();
}

$otp = rand(100000, 999999);
$expiry = date('Y-m-d H:i:s', time() + 60 * 15);

$stmt = mysqli_prepare($conn, "UPDATE users set otp = ?, otp_expiry = ? WHERE email = ?");
mysqli_stmt_bind_param($stmt, "sss", $otp, $expiry, $email);
mysqli_stmt_execute($stmt);

if (mysqli_affected_rows($conn) > 0) {
    if (sendOtp($email, $otp)) {
        $_SESSION['verify_email'] = $email;
        $_SESSION['success'] = "OTP sent successfully";
        header("Location: ../verifyOtp.php");
        exit();
    } else {
        $_SESSION['errors'][] = "Failed to send OTP";
        $_SESSION['old'] = $_POST;
        header("Location: ../forgetPassword.php");
        exit();
    }
} else {
    $_SESSION['errors'][] = "Failed to send OTP";
    $_SESSION['old'] = $_POST;
    header("Location: ../forgetPassword.php");
    exit();
}
