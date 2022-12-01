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
                <a href="login.php">Login</a>
            </div>
        </nav>
    </header>

    <!--About-->
    <section class="about">
        <div class="about__container">
            <div class="about__title">
                <h2>Welcome to Our Ecommerence shop</h2>
            </div>
            <div class="about__subtitle">
                <h3>shopping made easy </h3>
            </div>
            <div class="about__info">
                <p>We are simply an online store , looking forward to make
                    shopping easy for people with in Uganda and beyond.
                    <em>Shop</em> is a platform where you can buy and sell your products.
                </p>
            </div>
        </div>
    </section>

    <!--Featured-->
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

    <!--team-->
    <section class="team">
        <div class="team__container">
            <div class="team__title">
                <h1>Our Team</h1>
            </div>
            <div class="team__members">
                <div class="team__member">
                    <div class="team__member__image">
                        <img src="images/ass2.jpg" alt="">
                    </div>
                    <div class="team__member__info">
                        <h3>Human  Resource </h3>
                        <h6>MARGET</h6>
                        <p>marget is the human resource of shop</p>

                    </div>
                </div>
                <div class="team__member">
                    <div class="team__member__image">
                        <img src="images/ass3.jpg" alt="">
                    </div>
                    <div class="team__member__info">
                        <h3>CEO</h3>
                        <h6>Claire </h6>
                        <p>Claire is the chief executive officer of shop</p>

                    </div>
                </div>
                <div class = "team__member">
                    <div class = "team__member__image">
                        <img src = "images/ass5.jpg" alt = "">
                    </div>
                    <div class = "team__member__info">
                        <h3>Marketing Manager</h3>
                        <h6>Sara</h6>
                        <p>Sara is the marketing manager of shop</p>
                    </div>

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