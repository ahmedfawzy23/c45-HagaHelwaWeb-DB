<?php
include "db_connection.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_COOKIE['remember_token']) and empty($_SESSION['user'])) {
    $token = $_COOKIE['remember_token'];
    $hashed_token = hash('sha256', $token);
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE remember_token = ? And remember_token_expiry > ?");
    $current_time = time();
    mysqli_stmt_bind_param($stmt, "ss", $hashed_token, $current_time);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $user;
        $_SESSION['is_logged_in'] = true;
    }
    header('Location:' . $_SERVER['PHP_SELF']);
    exit();
}


if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
