<?php
session_start();

// check if user is logged in, if not redirect to login page and after login redirect to this page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php?redirect_to=' . urlencode($_SERVER['REQUEST_URI']));
}

require_once '../includes/config.php';
require_once '../includes/cart.php';
require_once '../includes/order.php';
require_once '../includes/user.php';

$cart = new Cart($db);
$user = new User($db);
$cart->user_id = $_SESSION['user_id'];
$cart_items = $cart->read();
$user->id = $_SESSION['user_id'];
$user = $user->readOne();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check out</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/checkout.css">
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
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) : ?>
                    <a href="../checkout.php">Cart</a>
                    <a href="../logout.php">Logout</a>
                <?php else : ?>
                    <a href="../login.php">Login</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <section class="checkout__section">
        <div class="checkout__container">
            <div class="checkout__items">
                <h1>Check out</h1>
                <div class="checkout__items__container">
                    <?php foreach ($cart_items as $item) : ?>
                        <div class="checkout__item">
                            <div class="checkout__item__image">
                                <img src="<?php echo $item['image']; ?>" alt="">
                            </div>
                            <div class="checkout__item__info">
                                <h2><?php echo $item['name']; ?></h2>
                                <p><?php echo $item['description']; ?></p>
                                <p>Quantity: <?php echo $item['quantity']; ?></p>
                                <p>Price: <?php echo $item['price']; ?></p>
                                <span class="checkout__item__remove">
                                    <a href="remove_from_cart.php?id=<?php echo $item['id']; ?>">Remove</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="checkout__form">
                <h1>Shipping Address</h1>
                <form action="order.php" method="post">
                    <div class="form__group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="<?= $user['first_name'] . ' ' . $user['last_name']; ?>" readonly>
                    </div>
                    <div class="form__group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?= $user['email']; ?>" readonly>
                    </div>
                    <div class="form__group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" required>
                    </div>
                    <div class="form__group">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" required>
                    </div>
                    <div class="form__group">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" required>
                    </div>
                    <div class="form__group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" required>
                    </div>
                    <div class="form__group">
                        <label for="payment">Payment</label>
                        <select name="payment" id="payment" required>
                            <option value="paypal">Paypal</option>
                            <option value="credit_card">Credit Card</option>
                        </select>
                    </div>
                    <div class="form__group">
                        <input type="submit" value="Place Order">
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>