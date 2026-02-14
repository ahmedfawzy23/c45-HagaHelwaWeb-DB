<?php require_once __DIR__ . '/db_connection.php';
require_once __DIR__ . '/lang.php';
?>
<!DOCTYPE html>
<html lang="<?= __('header.other_lang_key') ?>" dir="<?= __('header.direction') ?>">

<head>

    <!-- Start Links -->
    <link rel="stylesheet" href="css/splide.min.css">
    <link rel="stylesheet" href="css/splide-core.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--Start Home Style -->
    <link rel="stylesheet" href="css/index_style.css">
    <!-- End Home Style -->

    <!-- Start Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@1,400&display=swap" rel="stylesheet">
    <!-- End Google Fonts -->

    <!-- End Links -->

    <title>Haga Helwa</title>

</head>

<body>
    <!-- Start header -->

    <section id="header">

        <a href="index.php">
            <img src="img/logo.png" alt="homeLogo">
        </a>
        <div>
            <ul id="navbar">
                <li class="link">
                    <a href="index.php"><?= __('header.home') ?></a>
                </li>
                <li class="link">
                    <a href="shop.php"><?= __('header.shop') ?></a>
                </li>
                <li class="link">
                    <a class="active " href="blog.php"><?= __('header.blog') ?></a>
                </li>
                <li class="link">
                    <a href="about.php"><?= __('header.about') ?></a>
                </li>
                <li class="link">
                    <a href="contact.php"><?= __('header.contact') ?></a>
                </li>
                <?php if (!isset($_SESSION['user'])): ?>
                    <li class="link">
                        <a href="signup.php"><?= __('header.signup') ?></a>
                    </li>
                    <li class="link">
                        <a href="login.php"><?= __('header.login') ?></a>
                    </li>
                <?php else: ?>
                    <li class="link">
                        <a href="handlers/logout.php"><?= __('header.logout') ?></a>
                    </li>
                    <li class="link">
                        <a><?= $_SESSION['user']['username'] ?></a>
                    </li>
                <?php endif; ?>
                <li class="link">
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?lang=<?= __('header.other_lang_key') ?>"><?= __('header.other_lang') ?></a>
                </li>
                <li class="link">
                    <a id="lg-cart" href="cart.php">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </li>
                <a href="#" id="close"><i class="fas fa-times"></i></a>
            </ul>


        </div>
        <div id="mobile">
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <a href="#" id="bar"> <i class="fas fa-outdent"></i> </a>
        </div>
    </section>

    <!-- End header -->
