<?php
require_once '../partials/header.php';
require_once '../includes/products.php';
require_once '../includes/config.php';

$products = new Product($db);
$products = $products->read();
$featured = [$products[0], $products[1], $products[2]];
?>
<body>
    <!-- Navigation -->
    <header class="header">
        <nav class="nav">
            <div class="nav__logo">
                <a href="index.php">
                    Shop
                </a>
            </div>
            <div class="nav__links">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <a href="login.php">Login</a>
            </div>
        </nav>
    </header>
    <!-- Hero -->
    <!-- Display featured products -->
    <section class="featured">
        <div class="featured__container">
            <div class="featured__title">
                <h1>Featured Products</h1>
            </div>
            <div class="featured__products">
                <!-- loop through the first 3 products -->
                <?php foreach ($featured as $product) : ?>
                    <div class="featured__product">
                        <div class="featured__product__image">
                            <img src="http://placehold.it/350x150" alt="">
                        </div>
                        <div class="featured__product__info">
                            <h3><?php echo $product['name']; ?></h3>
                            <p><?php echo $product['description']; ?></p>
                            <p><?php echo $product['price']; ?></p>
                            <a href="product.php?id=<?php echo $product['id']; ?>">View</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- main products section 4x4-->
    <section class="products">
        <div class="products__container">
            <div class="products__title">
                <h1>Products</h1>
            </div>
            <div class="products__grid">
                <div class="products__grid__item">
                    <div class="products__grid__item__img">
                        <img src="../img/product1.jpg" alt="product1">
                    </div>
                    <div class="products__grid__item__info">
                        <h3>Product 1</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <a href="product.php">View Product</a>
                    </div>
                </div>
                <div class="products__grid__item">
                    <div class="products__grid__item__img">
                        <img src="../img/product2.jpg" alt="product2">
                    </div>
                    <div class="products__grid__item__info">
                        <h3>Product 2</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <a href="product.php">View Product</a>
                    </div>
                </div>
                <div class="products__grid__item">
                    <div class="products__grid__item__img">
                        <img src="../img/product3.jpg" alt="product3">
                    </div>
                    <div class="products__grid__item__info">
                        <h3>Product 3</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <a href="product.php">View Product</a>
                    </div>
                </div>
                <div class="products__grid__item">
                    <div class="products__grid__item__img">
                        <img src="../img/product4.jpg" alt="product4">
                    </div>
                    <div class="products__grid__item__info">
                        <h3>Product 4</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <a href="product.php">View Product</a>
                    </div>
                </div>
                <div class="products__grid__item">
                    <div class="products__grid__item__img">
                        <img src="../img/product5.jpg" alt="product5">
                    </div>
                    <div class="products__grid__item__info">
                        <h3>Product 5</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <a href="product.php">View Product</a>
                    </div>
                </div>
                <div class="products__grid__item">
                    <div class="products__grid__item__img">
                        <img src="../img/product6.jpg" alt="product6">
                    </div>
                    <div class="products__grid__item__info">
                        <h3>Product 6</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <a href="product.php">View Product</a>
                    </div>
                </div>
                <div class="products__grid__item">
                    <div class="products__grid__item__img">
                        <img src="../img/product7.jpg" alt="product7">
                    </div>
                    <div class="products__grid__item__info">
                        <h3>Product 7</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <a href="product.php">View Product</a>
                    </div>
                </div>
                <div class="products__grid__item">
                    <div class="products__grid__item__img">
                        <img src="../img/product8.jpg" alt="product8">
                    </div>
                    <div class="products__grid__item__info">
                        <h3>Product 8</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <a href="product.php">View Product</a>
                    </div>
                </div>
            </div>
            <!-- pagination -->
            <div class="pagination">
                <a href="#" class="pagination__link">1</a>
                <a href="#" class="pagination__link">2</a>
                <a href="#" class="pagination__link">3</a>
                <a href="#" class="pagination__link">4</a>
                <a href="#" class="pagination__link">5</a>
            </div>
        </div>
    </section>
    <!-- footer -->
    <footer class="footer">
        <div class="footer__container">
            <div class="footer__links">
                <div class="footer__links__item">
                    <h2>Company</h2>
                    <a href="#">About Us</a>
                    <a href="#">Contact Us</a>
                    <a href="#">Careers</a>
                    <a href="#">Affiliate</a>
                </div>
                <div class="footer__links__item">
                    <h2>Get Help</h2>
                    <a href="#">FAQ</a>
                    <a href="#">Shipping</a>
                    <a href="#">Returns</a>
                    <a href="#">Order Status</a>
                    <a href="#">Payment Options</a>
                </div>
                <div class="footer__links__item">
                    <h2>Online Shop</h2>
                    <a href="#">Watch</a>
                    <a href="#">Bag</a>
                    <a href="#">Shoes</a>
                    <a href="#">Dress</a>
                </div>
                <div class="footer__links__item">
                    <h2>Policy</h2>
                    <a href="#">Return Policy</a>
                    <a href="#">Terms Of Use</a>
                    <a href="#">Security</a>
                    <a href="#">Privacy</a>
                    <a href="#">Sitemap</a>
                    <a href="#">Store Directory</a>
                </div>
            </div>
            <div class="footer__social">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>
    </footer>
<?php require_once '../partials/footer.php'; ?>