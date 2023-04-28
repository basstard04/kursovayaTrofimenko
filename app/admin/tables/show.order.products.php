<?php

use App\models\Admin;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$productsInOrder = Admin::getProductsInOrder($_GET['id']);
$totalPrice = Admin::totalPriceInOrderProducts($_GET['id']);
$totalCount = Admin::totalCountInOrderProducts($_GET['id']);
$info = Admin::infoOrderInProducts($_GET['id']);

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/show.order.view.php";
