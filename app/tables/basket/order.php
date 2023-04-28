<?php

use App\models\Basket;
use App\models\Order;
use App\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$deliveries = Order::allDelivery();
$totalPrice = Basket::totalPrice($_SESSION['id']);
$totalCount = Basket::totalCount($_SESSION['id']);
$info = User::info($_SESSION['id']);

include $_SERVER['DOCUMENT_ROOT'] . "/views/products/order.view.php";
