<?php

use App\models\Category;
use App\models\Brand;
use App\models\Product;
use App\models\Soviet;
use App\models\Type_of_goods;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$products = Product::newProducts();
$brands = Brand::all();
$categories = Category::all();
$soviets = Soviet::all();
$type_of_goods = Type_of_goods::all();
$brandsreform =[];
$text = "st1";
$arrtemp = [];
for($i = 0; $i<count($brands); $i++){
    array_push($arrtemp, $brands[$i]);
    if(($i+1)%5==0 || $i==count($brands)-1){
        $brandsreform[$text] = $arrtemp;
        $text = "st" .$i;
        $arrtemp = [];
    }

}
include $_SERVER['DOCUMENT_ROOT'] . "/views/products/index.view.php";