<?php
session_start();


require_once '../includes/config.php';
require_once '../includes/cart.php';

$cart = new Cart($db);
$cart->user_id = $_SESSION['user_id'];
$cart->id = $_GET['id'];
$cart->delete();

header('Location: checkout.php?message=Item removed from cart');