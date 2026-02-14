<?php

session_start();
require_once "../includes/db_connection.php";
require_once "../includes/validation.php";

if (!isset($_POST['signup'])) {
    header("Location: ../signup.php");
    exit();
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$rules = [
    "username" => "required|alpha_numeric|min:3|max:20",
    "email" => "required|email|unique:users,email",
    "password" => "required|min:6|max:20",
    "phone" => "required|min:10|max:20|unique:users,phone",
    "address" => "required|min:10|max:255"
];

$errors = validate($_POST, $rules);

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    header("Location: ../signup.php");
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $hashed_password, $phone, $address);
mysqli_stmt_execute($stmt);

// $query = "INSERT INTO users (username, email, password, phone, address) VALUES ('$username', '$email', '$hashed_password', '$phone', '$address')";
// $result = mysqli_query($conn, $query);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    header("Location: ../login.php");
    exit();
} else {
    header("Location: ../signup.php");
    exit();
}
