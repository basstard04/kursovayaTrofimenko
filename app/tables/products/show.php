<?php

use App\models\Product;
use App\models\Size_range;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$product_id = $_GET['id'];

$product = Product::find($product_id);
$sizes = Size_range::search($product_id, 'RUS');

include $_SERVER['DOCUMENT_ROOT'] . "/views/products/show.view.php";