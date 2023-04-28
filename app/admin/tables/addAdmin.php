<?php

use App\models\Admin;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if (!isset($_SESSION['chiefAdmin']) ) {
    header("Location: /");
}

if (!$_SESSION['chiefAdmin']) {
    header("Location: /app/admin/tables/admin.php");
}

$admins= Admin::allAdmin();

include $_SERVER['DOCUMENT_ROOT'] . "/views/admin/addAdmin.view.php";
