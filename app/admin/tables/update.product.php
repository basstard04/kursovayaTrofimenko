<?php

use App\models\Product;

session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";
if (isset($_POST['btn-update'])) {
    if ($_FILES['image']['name'] == "") {
        $name = $_POST['imageOld'];
    } else {
        $name = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];
        $size = $_FILES['image']['size'];
        move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . "/upload/product/$name");
        unlink($_SERVER['DOCUMENT_ROOT'] . "/upload/product/" . $_POST['imageOld']);
    }

    Product::update($_POST['id'], $_POST['name'], $_POST['price'], $name, $_POST['description'], $_POST['color_id'], $_POST['country_id'], $_POST['category_id'],$_POST['brand_id'],$_POST['type_of_good_id']);
}

header("Location: /app/admin/tables/product.php");
