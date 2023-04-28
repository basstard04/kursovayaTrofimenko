<?php

use App\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

unset($_SESSION['error']);

if (isset($_POST['btnAdmin'])) {
    $_SESSION ["info"]["email"] = $_POST['email'];
    $user = User::getUser($_POST['email'], $_POST['password']);
    if ($user == null) {
        $_SESSION['error'] = "Пользователя не найден";
        header("Location: /app/admin/tables/auth.php");
        die();
    } else {
        if ($user->role == 'Администратор') {
            $_SESSION["id"] = $user->id;
            $_SESSION['admin'] = true;
            header("Location: /app/admin/tables/product.php");
            die();
        } elseif ($user->role == 'Главный администратор') {
            $_SESSION["id"] = $user->id;
            $_SESSION['chiefAdmin'] = true;
            $_SESSION['admin'] = true;
            header("Location: /app/admin/tables/product.php");
            die();
        } else {
            $_SESSION['error'] = "Вы не являетесь администратором";
            header("Location: /app/admin/tables/auth.php");
        }
    }
}
