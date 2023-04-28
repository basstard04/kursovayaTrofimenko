<?php

use App\models\Admin;

session_start();
unset($_SESSION['product']);
unset($_SESSION['error']);

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$extensions = ["jpeg", "jpg", "png", "webp"];
$types = ["image/jpg", "image/jpeg", "image/png", "image/webp"];
$product = Admin::getProduct($_POST['name']);
if (isset($_POST['btnAddProduct'])) {
    $_SESSION['product']['name'] = $_POST['name'];
    $_SESSION['product']['price'] = $_POST['price'];
    if (empty($_POST['name'])) {
        $_SESSION['error']['name'] = 'Заполните name';
    }
    if (empty($_POST['price'])) {
        $_SESSION['error']['price'] = 'Заполните price';
    }
    if (isset($_FILES['image'])) {
        $name = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];
        $size = $_FILES['image']['size'];
        $type = $_FILES["image"]["type"];

        $path_parts = pathinfo($name);

        $ext = $path_parts["extension"];
        $mimeType = mime_content_type($tmpName);

        if (in_array($ext, $extensions) && in_array($mimeType, $types)) {

            if ($error == 0) {
                if (!move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . "/upload/product/$name")) {
                    $_SESSION['error']['image'] = "Не получилось переместить файл";
                }
            } else {
                $_SESSION['error']['image'] = 'Есть ошибка';
            }
        } else {
            $_SESSION['error']['image'] = 'Расширение файла должно быть: ' . implode(", ", $extensions);
        }
    }
    
    // if (preg_match("/image\/.+/", $type)) {
    //     if (!move_uploaded_file($tmpName, $_SERVER["DOCUMENT_ROOT"] . "/upload/$name")) {
    //         $_SESSION['error']['file'] = "Не получилось переместить файл";
    //     }
    // }

    if (isset($_SESSION['error'])) {
        header("Location: /app/admin/tables/product.php");
    } else {
        Admin::addProduct($_POST['name'], $_POST['price'],$name,$_POST['description'],$_POST['color_id'], $_POST['country_id'], $_POST['category_id'], $_POST['brand_id'], $_POST['type_of_good_id']);
        unset($_SESSION['product']);
    }
}

header("Location: /app/admin/tables/product.php");
