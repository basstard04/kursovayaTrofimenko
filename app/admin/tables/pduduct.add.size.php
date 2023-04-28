<?php

use App\models\Size_range;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['admin'])) {
    header("Location: /");
}

if (!$_SESSION['admin']) {
    header("Location: /app/admin/tables/admin.php");
}

$sizes = Size_range::all();

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/order.view.php";
