<?php

use App\models\Basket;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$user_id = $_SESSION['id'];
$productInBasket =  Basket::productsInBasket($user_id);
$totalPrice = Basket::totalPrice($user_id);
$totalCount = Basket::totalCount($user_id);

include $_SERVER['DOCUMENT_ROOT'] . "/views/products/basket.view.php";
