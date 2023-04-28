<?php

use App\models\Product;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if ($_GET['category'] != 'all') {
    $products = Product::productsByManyCategories($_GET['category']);
} else {
    $products = Product::all();
}

echo json_encode($products, JSON_UNESCAPED_UNICODE);
