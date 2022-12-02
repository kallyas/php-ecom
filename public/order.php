<?php

require_once '../includes/config.php';
require_once '../includes/order.php';

$order = new Order($db);
$order->user_id = $_SESSION['user_id'];
$order->create();