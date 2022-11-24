<?php 
require_once '../partials/header.php'
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
                <div class="featured__product">
                    <div class="featured__product__img">
                        <img src="../img/featured1.jpg" alt="featured1">
                    </div>
                    <div class="featured__product__info">
                        <h3>Product 1</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <a href="product.php">View Product</a>
                    </div>
                </div>
                <div class="featured__product">
                    <div class="featured__product__img">
                        <img src="../img/featured2.jpg" alt="featured2">
                    </div>
                    <div class="featured__product__info">
                        <h3>Product 2</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <a href="product.php">View Product</a>
                    </div>
                </div>
                <div class="featured__product">
                    <div class="featured__product__img">
                        <img src="../img/featured3.jpg" alt="featured3">
                    </div>
                    <div class="featured__product__info">
                        <h3>Product 3</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                        <a href="product.php">View Product</a>
                    </div>
                </div>
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
                    <div class="team__member__img">
                        <img src="../img/team1.jpg" alt="team1">
                    </div>
                    <div class="team__member__info">
                        <h3>Member 1</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                    </div>
                </div>
                <div class="team__member">
                    <div class="team__member__img">
                        <img src="../img/team2.jpg" alt="team2">
                    </div>
                    <div class="team__member__info">
                        <h3>Member 2</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                    </div>
                </div>
                <div class="team__member">
                    <div class="team__member__img">
                        <img src="../img/team3.jpg" alt="team3">
                    </div>
                    <div class="team__member__info">
                        <h3>Member 3</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quae.</p>
                    </div>
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


