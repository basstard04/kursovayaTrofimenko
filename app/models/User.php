<?php

namespace App\models;

use App\helpers\Connection;

//содержаться все методы необходимые для работы с пользователем в базе
class User
{
    public static function all()
    {
        $query = Connection::make()->query("SELECT * FROM users");

        return $query->fetchAll();
    }

    public static function insert($data)
    {
        $query = Connection::make()->prepare("INSERT INTO users (name,gender,email,phone,password) VALUES (:name,:gender,:email,:phone,:password);");

        return $query->execute([
            ':name' => $data['name'],
            ':gender' => $data['pol'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }
    public static function getUserForCs($email)
    {
        $query = Connection::make()->prepare("SELECT users.*, roles.name as role FROM users INNER JOIN roles ON roles.id = users.role_id WHERE users.email = :email");
        $query->execute([':email' => $email]);
        return $query->fetch();
    }

    public static function getUser($email, $password)
    {
        $query = Connection::make()->prepare("SELECT users.*, roles.name as role FROM users INNER JOIN roles ON roles.id = users.role_id WHERE users.email = :email");
        $query->execute([':email' => $email]);

        $user = $query->fetch();
        if ($user != null) {
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return null;
    }

    public static function find($id)
    {
        $query = Connection::make()->prepare("SELECT * FROM users WHERE users.id = :id");
        $query->execute([':id' => $id]);
        $user = $query->fetch();
        return $user;
    }

    public static function ordersByUser($id)
    {
        $query = Connection::make()->prepare("SELECT orders.*, statuses.name as status, delivery.address as delivery FROM orders INNER JOIN statuses ON orders.status_id = statuses.id INNER JOIN delivery ON delivery.id = orders.delivery_id WHERE orders.user_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetchAll();
    }

    public static function productByOrderUser($order_id)
    {
        $query = Connection::make()->prepare("SELECT product_orders.*, products.name as name, products.price as price, products.photo as photo, size_ranges.RUS as size FROM product_orders INNER JOIN products ON product_orders.product_id = products.id INNER JOIN product_sizes ON product_orders.size_id = product_sizes.size_range_id INNER JOIN size_ranges ON size_ranges.id = product_sizes.size_range_id WHERE product_orders.order_id = :order_id AND product_sizes.product_id = products.id");
        $query->execute([
            ':order_id' => $order_id
        ]);
        return $query->fetchAll();
    }
    public static function allRole()
    {
        $query = Connection::make()->query("SELECT role FROM users");
        return $query->fetchAll();
    }

    public static function info($id)
    {
        $query = Connection::make()->prepare("SELECT * FROM users WHERE id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }
}
