<?php

session_start();
require_once "../includes/db_connection.php";
require_once "../includes/validation.php";

if (!isset($_POST['send_verify_otp'])) {
    header("Location: ../verifyOtp.php");
    exit();
}

$verify_Otp = $_POST['verify_Otp'];

$rules = [
    "verify_Otp" => "required|numeric|exists:users,otp",
];

$errors = validate($_POST, $rules);

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header("Location: ../verifyOtp.php");
    exit();
}


$stmt = mysqli_prepare($conn, "select * from users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $_SESSION['verify_email']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user['otp'] == $verify_Otp && $user['otp_expiry'] > date('Y-m-d H:i:s')) {
    $_SESSION['success'] = "OTP verified successfully";
    header("Location: ../resetPassword.php");
    exit();
} else {
    $_SESSION['errors'][] = "Invalid OTP";
    $_SESSION['old'] = $_POST;
    header("Location: ../verifyOtp.php");
    exit();
}
