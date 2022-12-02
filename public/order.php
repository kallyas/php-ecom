<?php

session_start();

require_once '../includes/config.php';
require_once '../includes/order.php';
require_once '../includes/cart.php';

$order = new Order($db);
$cart = new Cart($db);
$cart->user_id = $_SESSION['user_id'];
$order->user_id = $_SESSION['user_id'];

if(isset($_POST)) {
    $order->address = $_POST['address'];
    $order->city = $_POST['city'];
    $order->country = $_POST['country'];
    $order->phone = $_POST['phone'];
    $order->email = $_POST['email'];
    $order->payment_method = $_POST['payment'];
    $order->created_at = date('Y-m-d H:i:s');
    
    if($order->create()) {
        $cart->deleteAll();
        header('Location: checkout.php?message=Order placed');
    } else {
        header('Location: checkout.php?message=Order failed');
    }
} else {
    header('Location: checkout.php?message=Order failed');
}