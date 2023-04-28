<?php

use App\models\Admin;
use App\models\Category;
use App\models\Product;
use App\models\Brand;
use App\models\Color;
use App\models\Type_of_goods;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['admin'])) {
    header("Location: /");
}
if (!$_SESSION['admin']) {
    header("Location: /app/admin/tables/admin.php");
}

$_SESSION['product']['id'] = $_POST['id'];

$product = Product::find($_SESSION['product']['id']);
$categories = Category::all();
$countries = Admin::allCountries();
$colors = Color::all();
$type_of_goodes = Type_of_goods::all();
$brands = Brand::all();

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/show.view.php";
