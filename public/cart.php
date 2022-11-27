<?php
session_start();

require_once '../includes/config.php';
require_once '../includes/cart.php';

$cart = new Cart($db);

// check if there is a user id in the session
if (isset($_SESSION['user_id'])) {
    // set user id property
    $cart->user_id = $_SESSION['user_id'];
} else {
    // redirect to login page and after login redirect to this page
    header('Location: login.php?redirect_to=' . urlencode($_SERVER['REQUEST_URI']));
}


$cart->product_id = $_GET['id'];
// cart quantity increases every time user visits cart page
$cart->quantity = 1;

// add product to cart
if ($cart->add()) {
    header("Location: checkout.php");
} else {
    header("Location: product.php?id={$cart->product_id}&action=failed");
}
