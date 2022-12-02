<?php
session_start(); 
require_once '../partials/header.php';
require_once '../includes/config.php';
require_once '../includes/contact.php';

$contact = new Contact($db);

if($_POST && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    $contact->name = $_POST['name'];
    $contact->email = $_POST['email'];
    $contact->message = $_POST['message'];
    if($contact->create()) {
        header('Location: contact.php?success=true');
    } else {
        header('Location: contact.php?success=false');
    }
}


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
   <!--contact section -->
   <?php if (isset($_GET['success']) && $_GET['success'] == true) : ?>
        <div class="alert alert-success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <p><?php echo $_SESSION['success']; ?></p>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['success']) && $_GET['success'] == false) : ?>
        <div class="alert alert-danger">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <p><?php echo $_SESSION['error']; ?></p>
        </div>
    <?php endif; ?>
    <section class="contact">
        <div class="contact__container">
            <div class="contact__left">
                <h1 class="contact__title">Contact Us</h1>
                <p class="contact__text">Please feel free to reach out for help or inquiries </p>
                <div class="contact__info">
                    <div class="contact__info-box">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>Address</h3>
                            <span>123 Street, New York, USA</span>
                        </div>
                    </div>
                    <div class="contact__info-box">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h3>Call Us</h3>
                            <span>+1 123 456 7890</span>
                        </div>
                    </div>
                    <div class="contact__info-box">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h3>Email Us</h3>
                            <span>shop@email.com</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact__right">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="contact__form">
                    <input name="name" type="text" class="contact__input" placeholder="Name">
                    <input name="email" type="email" class="contact__input" placeholder="Email">
                    <textarea name="message" id="" cols="0" rows="10" class="contact__input" placeholder="Message"></textarea>
                    <input type="submit" value="Send" class="contact__button">
                </form>
            </div>
        </div>
    </section>
    <!-- Footer -->
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