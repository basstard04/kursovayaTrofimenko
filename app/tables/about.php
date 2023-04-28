<?php

use App\models\Product;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$products = Product::newProducts();

include $_SERVER['DOCUMENT_ROOT'] . "/views/about.view.php";