<?php

use App\models\Basket;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

//получаем поток для работы с входными данными
$stream = file_get_contents("php://input");

if (isset($stream)) {

    $product = json_decode($stream)->data ?? false;
    // $product_size_id = json_decode($stream)->data;
    $action = json_decode($stream)->action;
    $user_id = $_SESSION['id'];
    $productInBasket = match ($action) {
        "add" => Basket::add($product->id, $user_id, $product->size_id),
        "minus" => Basket::minus($product->id, $user_id, $product->size_id),
        "delete" => Basket::delete($product->id, $user_id, $product->size_id),
        "clear" => Basket::clear($user_id)
    };

    echo json_encode([
        "productInBasket" => $productInBasket,
        "totalPrice" => Basket::totalPrice($user_id),
        "totalCount" => Basket::totalCount($user_id)
    ], JSON_UNESCAPED_UNICODE);
}
