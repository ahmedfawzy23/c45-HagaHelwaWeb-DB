<?php

session_start();
require_once "../includes/db_connection.php";
require_once "../includes/validation.php";


if (isset($_POST['updateCart'])) {

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $rules = [
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|numeric|min:1'
    ];

    $errors = validate($rules, $_POST);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../cart.php");
        exit();
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


    if ($quantity > $total_stock) {
        $_SESSION['errors'][] = "Product is out of stock";
        header("Location: ../cart.php");
        exit();
    } else {
        if ($cart_quantity > 0) {
            $new_quantity = $quantity;
            $cart_stmt = mysqli_prepare($conn, "UPDATE carts SET quantity = ? WHERE product_id=? And user_id=?");
            mysqli_stmt_bind_param($cart_stmt, "iii", $new_quantity, $product_id, $_SESSION['user']['id']);
            mysqli_stmt_execute($cart_stmt);
            $_SESSION['success'] = "Product updated in cart";
        } else {
            $new_quantity = $quantity;
            $cart_stmt = mysqli_prepare($conn, "INSERT INTO carts (product_id, user_id, quantity) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($cart_stmt, "iii", $product_id, $_SESSION['user']['id'], $new_quantity);
            mysqli_stmt_execute($cart_stmt);
            $_SESSION['success'] = "Product added to cart";
        }
        header("Location: ../cart.php");
        exit();
    }
} else {
    header("Location: ../cart.php");
}
