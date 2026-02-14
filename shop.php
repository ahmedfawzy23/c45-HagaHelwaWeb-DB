<?php
include "includes/header.php";
include "includes/auth.php";
$limit = 8;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
if ($page < 1)
    {
        header("Location: shop.php?page=1");
    }
$offset = ($page - 1) * $limit;

$result = mysqli_query($conn, "SELECT products.*, categories.name_" . $_SESSION['lang'] . " as category_name FROM products
JOIN categories ON products.categories_id = categories.id
LIMIT $limit OFFSET $offset");
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

$productsCount = mysqli_query($conn, "SELECT COUNT(*) as count FROM products");
$productsCount = mysqli_fetch_assoc($productsCount);
$productsCount = $productsCount['count'];
$totalPages = ceil($productsCount / $limit);
// echo "<pre>";
// print_r($productsCount);
// echo $totalPages;
// DIE();
// print_r($products);

if ($page > $totalPages) {
    header("Location: shop.php?page=$totalPages");
}

?>

    <!-- Start Hero -->

    <section id="page-header">
        <h2><?= __('shop.hero_title') ?></h2>
        <p><?= __('shop.hero_description') ?></p>
    </section>

    <!-- End Hero -->



    <!-- Start New Arrival or productCard Features -->
    <section id="product1" class="section-p1">
        <h2><?= __('shop.products_title') ?> </h2>
        <p><?= __('shop.products_description') ?></p>
        <?php if (!empty($products)) : ?>
            <div class="pro-container">
                <?php foreach ($products as $product) : ?>
                    <div class="pro" onclick="window.location.href='product.html'">
                        <img src=" img/products/<?= $product['image'] ?> " alt="p1 ">
                        <div class="des ">
                            <span><?= $product['category_name'] ?></span>
                            <h5><?= $product['name_' . $_SESSION['lang']] ?></h5>
                            <div class="star ">
                                <i class="fas fa-star "></i>
                                <i class="fas fa-star "></i>
                                <i class="fas fa-star "></i>
                                <i class="fas fa-star "></i>
                                <i class="fas fa-star "></i>
                            </div>
                            <h4><?= $product['price'] ?> EGP</h4>
                            <a href="# " class="cart "><i class="fas fa-shopping-cart "></i></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>No products found</p>
        <?php endif; ?>
    </section>

    <section id="pagenation" class="section-p1">
        <?php if ($page > 1) { ?>
            <a href="shop.php?page=<?php echo $page - 1; ?>">prev</a>
        <?php } ?>
        <?php if ($totalPages > 1) { ?>
            <?php for ($i = 1; $i <= $totalPages; $i++) {

                echo "<a style='margin: 0 5px;" . ($i == $page ? "background-color: #000;" : "") . "' href='shop.php?page=$i'>$i</a>";
            } ?>
            <?php if ($page < $totalPages) { ?>
                <a href="shop.php?page=<?php echo $page + 1; ?>">next</a>
            <?php } ?>

        <?php } ?>
        <!-- <a href="shop.php?page=2">2</a>
        <a href="shop.php?page=3"><i class="fas fa-long-arrow-alt-right "></i></a> -->

    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext ">
            <h4>Sign Up For Newletters</h4>
            <p>Get E-mail Updates about our latest shop and <span class="text-warning ">Special Offers.</span></p>
        </div>
        <div class="form ">
            <input type="text " placeholder="Enter Your E-mail... ">
            <button class="normal ">Sign Up</button>
        </div>
    </section>


<?php

include "includes/footer.php";
?>
