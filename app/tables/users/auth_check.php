<?php

use App\models\User;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

unset($_SESSION['error']);
// var_dump($_POST);
if (isset($_POST['login'])) {
    $user = User::getUser($_POST['login'], $_POST['password']);
    if ($user == null) {
        $_SESSION['auth'] = false;
        echo json_encode([
            "error"=>"Пользователя не найден",
        ], JSON_UNESCAPED_UNICODE);
        // echo  "Пользователя не найден";
        // header("Location: /app/tables/users/auth.php");
        die();
    } else {
        $_SESSION["auth"] = true;
        $_SESSION["id"] = $user->id;
        $_SESSION['name'] = $user->name;
        echo json_encode([
            "error"=>"",
            "name"=>$user->name,
        ], JSON_UNESCAPED_UNICODE);
        // header("Location: /app/tables/users/profile.php");
    }
}
