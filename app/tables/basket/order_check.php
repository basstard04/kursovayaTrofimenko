<?php

use App\models\Order;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if(isset($_POST['btn-order'])){
    Order::create($_SESSION["id"],$_POST['radio'],$_POST['delivery_id']);
}

header("Location: /app/tables/basket/basket.php");