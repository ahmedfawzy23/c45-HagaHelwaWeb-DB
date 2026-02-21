<?php

session_start();
require_once "../includes/db_connection.php";
require_once "../includes/validation.php";


if (isset($_GET['product_id'])) {

    $product_id = $_GET['product_id'];

    $rules = [
        'product_id' => 'required|exists:products,id'
    ];

    $errors = validate($rules, $_GET);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../cart.php");
    }
    $stmt = mysqli_prepare($conn, "DELETE FROM carts WHERE product_id=? And user_id=?");
    mysqli_stmt_bind_param($stmt, "ii", $product_id, $_SESSION['user']['id']);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Product removed from cart";
        header("Location: ../cart.php");
        exit();
    } else {
        $_SESSION['errors'][] = "Failed to remove product from cart";
        header("Location: ../cart.php");
        exit();
    }
} else {
    header("Location: ../cart.php");
}
