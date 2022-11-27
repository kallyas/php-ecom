<?php
session_start();
require_once '../partials/header.php';
require_once '../includes/products.php';
require_once '../includes/config.php';

$product = new Product($db);
$products = $product->read();
$featured = $product->read();
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
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) : ?>
                    <a href="../checkout.php">Cart</a>
                    <a href="../logout.php">Logout</a>
                <?php else : ?>
                    <a href="../login.php">Login</a>
                <?php endif; ?>
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
                    <!-- check if product is featured -->
                    <?php if ($product['featured'] == 1) : ?>
                        <div class="featured__product">
                            <div class="featured__product__image">
                                <img src="images/<?php echo $product['image']; ?>" alt="">
                            </div>
                            <div class="featured__product__info">
                                <h3><?php echo $product['name']; ?></h3>
                                <p><?php echo $product['description']; ?></p>
                                <p>$<?php echo $product['price']; ?></p>
                                <a href="product.php?id=<?php echo $product['id']; ?>">View Product</a>
                            </div>
                        </div>
                    <?php endif; ?>
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
                <!-- loop through the rest of the products -->
                <?php foreach ($products as $product) : ?>
                    <div class="products__grid__item">
                        <div class="products__grid__item__image">
                            <img src="<?php echo base_url($product['image']) ?>" alt="">
                        </div>
                        <div class="products__grid__item__info">
                            <h3><?php echo $product['name']; ?></h3>
                            <p><?php echo $product['description']; ?></p>
                            <p><?php echo $product['price']; ?></p>
                            <a href="product.php?id=<?php echo $product['id']; ?>">View</a>
                        </div>
                    </div>
                <?php endforeach; ?>
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