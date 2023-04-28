<?php

use App\models\Product;
use App\models\Size_range;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

//дикодируем json данные(категории)
if (isset($_GET['country']) && isset($_GET['product'])) {

    $sizes = Size_range::search($_GET['product'], $_GET['country']);

    echo json_encode($sizes, JSON_UNESCAPED_UNICODE);
}
