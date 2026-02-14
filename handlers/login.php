<?php

session_start();
require_once "../includes/db_connection.php";
require_once "../includes/validation.php";

if (!isset($_POST['login'])) {
    header("Location: ../login.php");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];


$rules = [
    "email" => "required|email|exists:users,email",
    "password" => "required",
];

$errors = validate($_POST, $rules);

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header("Location: ../login.php");
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        $_SESSION['is_logged_in'] = true;
        if (isset($_POST['remember']) and $_POST['remember'] == 'on') {
            $token = bin2hex(random_bytes(32));
            $hashed_token = hash('sha256', $token);
            $remember_token_expiry = 86400 * 30;
            setcookie('remember_token', $token, time() + $remember_token_expiry, '/');
            $userId = $user['id'];
            $stmt = mysqli_prepare($conn, "UPDATE users SET remember_token = ?, remember_token_expiry = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "ssi", $hashed_token, $remember_token_expiry, $userId);
            mysqli_stmt_execute($stmt);
        }
        header("Location: ../shop.php");
        exit();
    } else {
        $_SESSION['errors'][] = "Invalid credintails";
        $_SESSION['old'] = $_POST;
    }
} else {
    $_SESSION['errors'][] = "Invalid credintails";
    $_SESSION['old'] = $_POST;
}
header("Location: ../login.php");
exit();
