<?php

namespace App\models;

use App\helpers\Connection;
use App\models\Basket;
use App\models\Product;

class Order
{
    public static function create($user_id, $payment_method, $delivery_id)
    {
        //получаем корзину пользователя
        $basket = Basket::productsInBasket($user_id);

        //установим подключение для работы с транзакцией
        $conn = Connection::make();

        //транзакция
        try {
            //открываем транзакцию
            $conn->beginTransaction();

            //1: создаём новый заказ
            $order_id = self::addOrder($user_id, $payment_method, $delivery_id, $conn);
            
            //2: добавляем продукты в заказ
            self::addOrderProducts($basket, $order_id, $conn);
            
            //3: коректируем количество товаров на складе
            Product::updateCount($basket, $conn);
            
            //4: очищаем корзину пользователя
            Basket::clear($user_id, $conn);
           
            //принимаем транзакцию
            $conn->commit();
        } catch (\PDOException $error) {
            //откатываем транзакцию в случаи ошибки
            $conn->rollBack();
            echo "Ошибка" . $error->getMessage();
        }
        
    }

    //добавление нового заказа
    public static function addOrder($user_id, $payment_method, $delivery_id, $conn)
    {
        $query = $conn->prepare('INSERT INTO orders (data_order,payment_method,user_id,delivery_id) VALUES (:data_order,:payment_method,:user_id,:delivery_id)');
        $query->execute([
            ":data_order" => date("Y-m-d"),
            ":payment_method" => $payment_method,
            ':user_id' => $user_id,
            ":delivery_id" => $delivery_id
        ]);
        return $conn->lastInsertId();
    }


    public static function addOrderProductsTemp($product_id, $user_id, $count)
    {
        $query = Connection::make()->prepare('INSERT INTO product_orders (user_id,product_id,count) VALUES (:user_id,:product_id,:count');
        $query->execute([
            ':user_id' => $user_id,
            'product_id' => $product_id,
            'count' => $count
        ]);
    }

    private static function getParams($array, $value)
    {
        return implode(",", array_fill(0, count($array), $value));
    }

    //добавление продуктов в таблицу order_products
    public static function addOrderProducts($basket, $order_id, $conn)
    {
        $queryText = "INSERT INTO product_orders (order_id,product_id,count,size_id) VALUES ";
        $params = self::getParams($basket, "(?,?,?,?)");
        $queryText .= $params;
        $values = [];
        foreach ($basket as $item) {
            array_push($values, $order_id, $item->product_id, $item->count,$item->product_size_id);
        }
        $query = $conn->prepare($queryText);
        $query->execute($values);
    }

    public static function allDelivery()
    {
        $query = Connection::make()->query("SELECT * FROM delivery");
        return $query->fetchAll();
    }

    public static function all()
    {
        $query = Connection::make()->query("SELECT orders.*, users.name as user, statuses.name as status FROM orders INNER JOIN users ON users.id = orders.user_id INNER JOIN statuses ON statuses.id = orders.status_id");
        return $query->fetchAll();
    }

    public static function totalPrice($id)
    {
        $query = Connection::make()->prepare("SELECT SUM(products.price) as total_price FROM product_orders INNER JOIN products ON product_orders.product_id = products.id WHERE order_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    public static function totalCount($id)
    {
        $query = Connection::make()->prepare("SELECT SUM(product_orders.count) as total_count FROM product_orders INNER JOIN products ON product_orders.product_id = products.id WHERE order_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    public static function allStatus()
    {
        $query = Connection::make()->query("SELECT * FROM statuses");
        return $query->fetchAll();
    }

    public static function updateStatus($id, $status_id)
    {
        $query = Connection::make()->prepare("UPDATE orders SET status_id = :status_id WHERE id = :id");
        $query->execute([
            ':id' => $id,
            ':status_id' => $status_id
        ]);
    }

    public static function statusCansel($id, $status_id, $reason_cancel)
    {
        $query = Connection::make()->prepare("UPDATE orders SET status_id = :status_id, reason_cancel = :reason_cancel WHERE id = :id");
        $query->execute([
            ':id' => $id,
            ':status_id' => $status_id,
            ':reason_cancel' => $reason_cancel
        ]);
    }

    public static function getUserInOrder($id)
    {
        $query = Connection::make()->prepare("SELECT order_products.*,orders.updated_at,users.name as userName FROM order_products INNER JOIN users ON orders.user_id = users.id INNER JOIN orders ON orders.id = order_products.order_id WHERE order_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }

    public static function ordersByManyStatuses($status)
    {
        $query = Connection::make()->prepare("SELECT orders.*, users.name as user, statuses.name as status FROM orders INNER JOIN users ON users.id = orders.user_id INNER JOIN statuses ON orders.status_id = statuses.id WHERE orders.status_id = :status");
        $query->execute([
            ':status' => $status
        ]);
        return $query->fetchAll();
    }

    public static function findStatusInOrder($id)
    {
        $query = Connection::make()->prepare("SELECT orders.*, statuses.name as status FROM orders INNER JOIN statuses ON orders.status_id = statuses.id WHERE orders.id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }
}
