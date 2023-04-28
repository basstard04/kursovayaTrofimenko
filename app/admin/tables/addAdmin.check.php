<?php

session_start();

use App\models\Admin;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (isset($_POST['btn-addAdmin'])) {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Не все поля заполнены";
    }

    if (!isset($_SESSION['error']) || empty($_SESSION['error'])) {
        if(Admin::addAdmin($_POST) == null){
            $_SESSION['error'] = "Такой пользователь уже зарегестирован";
        }
    }
}

header("Location: /app/admin/tables/addAdmin.php");
