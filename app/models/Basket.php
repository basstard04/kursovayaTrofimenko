<?php

namespace App\models;

use App\helpers\Connection;

class Basket
{
    //ищем товар в корзине пользователя
    public static function search($product_id, $user_id, $product_size_id)
    {
        $query = Connection::make()->prepare("SELECT baskets.*, products.price * baskets.count as price_position FROM baskets INNER JOIN products ON baskets.product_id = products.id WHERE product_id = :product_id AND user_id = :user_id AND product_size_id = :product_size_id");
        $query->execute([
            ':product_id' => $product_id,
            ':user_id' => $user_id,
            ':product_size_id' => $product_size_id
        ]);
        return $query->fetch();
    }

    //итоговая стоимость
    public static function totalPrice($user_id)
    {
        $query = Connection::make()->prepare("SELECT SUM(baskets.count*products.price) as sum FROM baskets INNER JOIN products ON baskets.product_id = products.id WHERE baskets.user_id = :user_id");
        $query->execute([
            ':user_id' => $user_id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    //итоговое количество
    public static function totalCount($user_id)
    {
        $query = Connection::make()->prepare("SELECT SUM(count) as total_count FROM baskets WHERE user_id = :user_id");
        $query->execute([
            ':user_id' => $user_id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    public static function find($product_id, $size_range_id)
    {
        $query = Connection::make()->prepare("SELECT product_sizes.* FROM product_sizes INNER JOIN products ON products.id = product_sizes.product_id WHERE product_sizes.product_id = :product_id AND product_sizes.size_range_id = :size_range_id");
        $query->execute([
            ':product_id' => $product_id,
            ':size_range_id' => $size_range_id
        ]);
        return $query->fetch();
    }

    //добавление товар в корзину пользователя
    public static function add($product_id, $user_id, $product_size_id)
    {
        //поищем товар в корзине пользователя
        $productInBasket = self::search($product_id, $user_id, $product_size_id);
        $product = self::find($product_id,$product_size_id);

        //если товара нет в корзине, то мы его в корзину добавим в количестве = 1
        if (!$productInBasket) {
            $query = Connection::make()->prepare('INSERT INTO baskets (count,user_id,product_id,product_size_id) VALUE (1,:user_id,:product_id,:product_size_id)');
            $query->execute([
                ':user_id' => $user_id,
                ':product_id' => $product_id,
                ':product_size_id' => $product_size_id
            ]);
        }
        //иначе если количество товаров в корзине не больше того, что имеется на складе, то увеличиваем на 1
        else {
            if ($productInBasket->count < $product->count) {
                $query = Connection::make()->prepare('UPDATE baskets SET count=count+1 WHERE product_id = :product_id AND user_id = :user_id AND product_size_id = :product_size_id');
                $query->execute([
                    ':product_id' => $product_id,
                    ':user_id' => $user_id,
                    ':product_size_id' => $product_size_id
                ]);
            }
        }
        return self::search($product_id, $user_id, $product_size_id);
    }

    //уменьшение количество товара в корзине пользователя на 1
    public static function minus($product_id, $user_id, $product_size_id)
    {
        //поищем товар в корзине пользователя
        $productInBasket = self::search($product_id, $user_id, $product_size_id);

        if ($productInBasket->count > 1) {
            $query = Connection::make()->prepare('UPDATE baskets SET count=count-1 
            WHERE product_id = :product_id AND user_id = :user_id AND product_size_id = :product_size_id');
            $query->execute([
                ':product_id' => $product_id,
                ':user_id' => $user_id,
                ':product_size_id' => $product_size_id
            ]);
            // var_dump($product_size_id);
            // var_dump($product_id);
        }
        return self::search($product_id, $user_id, $product_size_id);
    }

    //получаем корзину пользователя
    public static function productsInBasket($user_id)
    {
        $query = Connection::make()->prepare('SELECT baskets.*, products.photo, products.name, products.price, baskets.count*products.price as price_position, size_ranges.*, colors.name as color FROM baskets INNER JOIN products ON baskets.product_id=products.id INNER JOIN product_sizes ON product_sizes.product_id = products.id INNER JOIN size_ranges ON size_ranges.id = product_sizes.size_range_id INNER JOIN colors ON colors.id = products.color_id WHERE baskets.user_id=:user_id AND product_sizes.size_range_id = baskets.product_size_id');
        $query->execute(['user_id' => $user_id]);
        return $query->fetchAll();
    }

    //удаляем товар из корзины
    public static function delete($product_id, $user_id, $size_id)
    {
        $query = Connection::make()->prepare("DELETE FROM baskets WHERE product_id = :product_id AND user_id = :user_id AND product_size_id = :product_size_id");
        $query->execute([
            ':product_id' => $product_id,
            ':user_id' => $user_id,
            ':product_size_id' => $size_id
        ]);
        return "delete";
    }

    //очищаем корзину пользователя
    public static function clear($user_id, $conn = null)
    {
        $conn = $conn ?? Connection::make();

        $query = $conn->prepare("DELETE FROM baskets WHERE user_id = :user_id");
        $query->execute([
            ':user_id' => $user_id
        ]);
    }
}
