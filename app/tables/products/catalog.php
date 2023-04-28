<?php

use App\models\Brand;
use App\models\Category;
use App\models\Color;
use App\models\Product;
use App\models\Size_range;
use App\models\Type_of_goods;


include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

// if(isset($_POST['btn-category'])){
//     $products = Product::productsByManyCategories($_POST['btn-id']);
// }
// var_dump($_POST);
$categories = Category::all();
$type_of_goods = Type_of_goods::all();
$brands = Brand::all();
$colors = Color::all();
$size_ranges = Size_range::all();

include $_SERVER['DOCUMENT_ROOT'] . "/views/products/catalog.view.php";