<?php

session_start();

use App\models\Admin;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (isset($_POST['btnAddCategory'])) {
    $category = Admin::getCategory($_POST['name']);
    var_dump($category);
    if (empty($_POST['name'])) {
        $_SESSION['error'] = 'Заполните поле';
    } else {
        if ($category != null) {
            $_SESSION['error'] = 'Такая категория уже есть';
        } else {
            Admin::addCategory($_POST['name']);
        }
    }
}
header("Location: /app/admin/tables/category.php");
