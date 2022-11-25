<?php

require_once '../../includes/products.php';
require_once '../../includes/config.php';

$product = new Product($db);

if ($_GET && isset($_GET['id'])) {
    $product->id = $_GET['id'];
    $product->delete();
    header('Location: products.php');
} else {
    header('Location: products.php');
}
