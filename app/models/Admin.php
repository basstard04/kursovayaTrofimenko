<?php

namespace App\models;

use App\helpers\Connection;

class Admin
{
    //добавление новой категории
    public static function addCategory($name)
    {
        $query = Connection::make()->prepare("INSERT INTO categories (name) VALUES (:name)");
        $query->execute([
            ':name' => $name,
        ]);
    }

    public static function categoryAll()
    {
        $query = Connection::make()->query("SELECT id, name, photo FROM categories");
        return $query->fetchAll();
    }

    //получаем категорию
    public static function getCategory($name)
    {
        $query = Connection::make()->prepare("SELECT * FROM categories WHERE name = :name");
        $query->execute([
            ':name' => $name
        ]);
        $category = $query->fetch();
        var_dump($category);
        if ($category) {
            return $category;
        }
        return null;
    }

    //удаление категории
    public static function deleteCategory($id)
    {
        $query = Connection::make()->prepare("DELETE FROM categories WHERE id = :id");
        $query->execute([
            ':id' => $id
        ]);
    }

    //получаем продукт
    public static function getProduct($name)
    {
        $query = Connection::make()->prepare("SELECT * FROM products WHERE name = :name");
        $query->execute([
            ':name' => $name
        ]);
        $product = $query->fetch();
        if ($product > 0) {
            return $product;
        }
        return null;
    }

    public static function deleteImage($id)
    {
        $imgQuery = Connection::make()->prepare("SELECT photo FROM products WHERE id = :id");
        $imgQuery->execute([
            ':id' => $id
        ]);
        return $imgQuery->fetch();
    }

    public static function deleteProduct($id)
    {
        $img = self::deleteImage($id);
        if ($img != "") {
            unlink($_SERVER['DOCUMENT_ROOT'] . "/upload/product/" . $img->photo);
        }

        $query = Connection::make()->prepare("DELETE FROM products WHERE id = :id");
        $query->execute([
            ':id' => $id
        ]);
    }

    //добавление нового товара
    public static function addProduct($name, $price, $photo, $description, $color_id, $country_id, $category_id, $brand_id, $type_of_good_id)
    {
        $query = Connection::make()->prepare("INSERT INTO products (name,price,photo,description,color_id,country_id,category_id,brand_id,type_of_good_id) VALUE (:name,:price,:photo,:description,:color_id,:country_id,:category_id,:brand_id,:type_of_good_id)");
        $query->execute([
            ':name' => $name,
            ':price' => $price,
            ':photo' => $photo,
            ':description' => $description,
            ':color_id' => $color_id,
            ':country_id' => $country_id,
            ':category_id' => $category_id,
            ':brand_id' => $brand_id,
            ':type_of_good_id' => $type_of_good_id,
        ]);
    }

    //получить все страны
    public static function allCountries()
    {
        $query = Connection::make()->query("SELECT id, name FROM countries");
        return $query->fetchAll();
    }

    public static function getProductsByCategory($category_id)
    {
        $query = Connection::make()->prepare("SELECT products.*, categories.name as category, countries.name as country, colors.name as color FROM products INNER JOIN categories ON categories.id = products.category_id INNER JOIN countries ON countries.id = products.country_id INNER JOIN colors ON colors.id = products.color_id WHERE category_id = :category_id");
        $query->execute(["category_id" => $category_id]);
        return $query->fetchAll();
    }

    public static function getProductsInOrder($id)
    {
        $query = Connection::make()->prepare("SELECT product_orders.*,products.name as name,products.price FROM product_orders INNER JOIN orders ON product_orders.order_id = orders.id INNER JOIN products ON product_orders.product_id = products.id WHERE product_orders.order_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetchAll();
    }

    //итоговая сумма товаров в заказе
    public static function totalPriceInOrderProducts($id)
    {
        $query = Connection::make()->prepare("SELECT SUM(products.price) as total_price FROM product_orders INNER JOIN products ON product_orders.product_id = products.id WHERE order_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    //общее количество товаров в заказе
    public static function totalCountInOrderProducts($id)
    {
        $query = Connection::make()->prepare("SELECT SUM(count) as total_count FROM product_orders WHERE order_id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    public static function infoOrderInProducts($id)
    {
        $query = Connection::make()->prepare("SELECT orders.id, users.name as user, users.email as login FROM orders INNER JOIN users ON orders.user_id = users.id WHERE orders.id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }

    public static function addAdmin($data)
    {
        $user = User::getUserForCs($data['email'], $data['password']);
        if ($user == null) {
            $query = Connection::make()->prepare("INSERT INTO users (name, gender, email, phone, password, role_id) VALUES (:name, :gender, :email, :phone, :password, 1)");
            return $query->execute([
                ':name' => $data['name'],
                ':gender' => $data['pol'],
                ':email' => $data['email'],
                ':phone' => $data['phone'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ]);
        }
        return null;
    }

    public static function allAdmin(){
        $query = Connection::make()->query("SELECT * FROM users WHERE role_id = 1");
        return $query->fetchAll();
    }
}
