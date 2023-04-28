<?php

use App\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    header("Location: /");
    die();
}

$orders = User::ordersByUser($_SESSION['id']);

include $_SERVER['DOCUMENT_ROOT'] . "/views/users/profile.order.view.php";
