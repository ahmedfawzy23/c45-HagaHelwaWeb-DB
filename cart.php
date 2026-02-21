<?php include "includes/header.php";


$stmt = mysqli_prepare($conn, "SELECT * FROM carts JOIN products ON carts.product_id = products.id WHERE carts.user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $_SESSION['user']['id']);
mysqli_stmt_execute($stmt);
$cart = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
        echo "<div class='alert alert-danger'>" . $error . "</div>";
    }
    unset($_SESSION['errors']);
}

if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);
}
?>

`
<!-- End header -->
<div class="container pt-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if (!empty($cart)) :
                $subtotal = 0;
                foreach ($cart as $product) :
                    $subtotal += $product['quantity'] * $product['price'];
            ?>
                    <tr>
                        <th scope="row">1</th>
                        <td><img src="img/products/<?= $product['image'] ?>" style="width: 50px;" alt=""></td>
                        <td><?= $product['name_' . $_SESSION['lang']] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td>
                            <form action="handlers/updateCart.php" method="post">
                                <input type="number" name="quantity" value="<?= $product['quantity'] ?>">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button type="submit" name="updateCart" class="btn btn-primary">Update</button>
                            </form>
                        </td>
                        <td><?= $product['quantity'] * $product['price'] ?></td>
                        <td>
                            <a href="handlers/removeFromCart.php?product_id=<?= $product['id'] ?>" class="btn btn-danger">Remove</a>
                        </td>
                    </tr>
                <?php endforeach;
            else: ?>
                <?= "cart has no items" ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<section id="cart-add" class="section-p1">
    <div id="coupon">
        <h3>Coupon</h3>
        <input type="text" placeholder="Enter coupon code">
        <button class="normal">Apply</button>
    </div>
    <div id="subTotal">
        <h3>Cart totals</h3>
        <table>
            <tr>
                <td>Subtotal</td>
                <td>$<?= $subtotal ?? 0 ?></td>

            </tr>
            <tr>
                <td>Shipping</td>
                <td>$0.00</td>
            </tr>
            <tr>
                <td>Tax</td>
                <td>$0.00</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong>$<?= $subtotal ?? 0 ?></strong></td>
            </tr>
        </table>
        <button class="normal">proceed to checkout</button>
    </div>
</section>
<?php include "includes/footer.php" ?>
