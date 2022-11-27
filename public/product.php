<?php

require_once "../includes/config.php";
require_once "../includes/products.php";

$product_id = $_GET['id'];
$product = new Product($db);
$product->id = $product_id;
$product_details = $product->readOne();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product_details['name']; ?> | Ecom</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/product.css">
</head>
<body>
    <header class="header">
        <nav class="nav">
            <div class="nav__logo">
                <a href="../index.php">
                    Shop
                </a>
            </div>
            <div class="nav__links">
                <a href="../index.php">Home</a>
                <a href="../about.php">About</a>
                <a href="../contact.php">Contact</a>
                <a href="../login.php">Login</a>
            </div>
        </nav>
    </header>
    <section class="product__section">
        <div class="error">
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'failed') {
                echo "<div class='alert alert-danger'>Unable to add product to cart.</div>";
            }
            ?>
        </div>
        <div class="product__container">
            <div class="product__image">
                <img src="../images/<?php echo $product_details['image']; ?>" alt="">
            </div>
            <div class="product__info">
                <h1><?php echo $product_details['name']; ?></h1>
                <p><?php echo $product_details['description']; ?></p>
                <p>$<?php echo $product_details['price']; ?></p>
                <a href="../cart.php?id=<?php echo $product_details['id']; ?>">Add to Cart</a>
            </div>
        </div>
    </section>
</body>
</html>