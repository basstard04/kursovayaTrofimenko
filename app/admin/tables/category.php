<?php

use App\models\Admin;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['admin'])) {
    header("Location: /");
}

if (!$_SESSION['admin']) {
    header("Location: /app/admin/tables/admin.php");
}

$categories = Admin::categoryAll();

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/category.view.php";
