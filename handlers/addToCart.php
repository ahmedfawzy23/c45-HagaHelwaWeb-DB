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
        header("Location: ../shop.php");
    }
    $product_stmt = mysqli_prepare($conn, "SELECT * FROM PRODUCTS WHERE ID=?");
    mysqli_stmt_bind_param($product_stmt, "i", $product_id);
    mysqli_stmt_execute($product_stmt);
    $product = mysqli_fetch_assoc(mysqli_stmt_get_result($product_stmt));
    $total_stock = $product['stock'];

    $cart_stmt = mysqli_prepare($conn, "SELECT * FROM carts WHERE product_id=? And user_id=?");
    mysqli_stmt_bind_param($cart_stmt, "ii", $product_id, $_SESSION['user']['id']);
    mysqli_stmt_execute($cart_stmt);
    $cart = mysqli_fetch_assoc(mysqli_stmt_get_result($cart_stmt));
    $cart_quantity = $cart['quantity'] ?? 0;


    if ($cart_quantity + 1 > $total_stock) {
        $_SESSION['errors'][] = "Product is out of stock";
        header("Location: ../shop.php");
        exit();
    } else {
        if ($cart_quantity > 0) {
            $new_quantity = $cart_quantity + 1;
            $cart_stmt = mysqli_prepare($conn, "UPDATE carts SET quantity = ? WHERE product_id=? And user_id=?");
            mysqli_stmt_bind_param($cart_stmt, "iii", $new_quantity, $product_id, $_SESSION['user']['id']);
            mysqli_stmt_execute($cart_stmt);
            $_SESSION['success'] = "Product added to cart";
        } else {
            $new_quantity = 1;
            $cart_stmt = mysqli_prepare($conn, "INSERT INTO carts (product_id, user_id, quantity) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($cart_stmt, "iii", $product_id, $_SESSION['user']['id'], $new_quantity);
            mysqli_stmt_execute($cart_stmt);
            $_SESSION['success'] = "Product added to cart";
        }
        header("Location: ../shop.php");
        exit();
    }
} else {
    header("Location: ../shop.php");
}
