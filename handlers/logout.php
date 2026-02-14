<?php

session_start();
require_once "../includes/db_connection.php";
$stmt = mysqli_prepare($conn, "UPDATE users SET remember_token = NULL, remember_token_expiry = NULL WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $_SESSION['user']['id']);
mysqli_stmt_execute($stmt);
session_destroy();
setcookie('remember_token', '', time() - 3600, '/');
header('location: login.php');
exit();
