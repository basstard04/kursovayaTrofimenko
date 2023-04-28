<?php

namespace App\models;

use App\helpers\Connection;

class Product
{
    //получаем товары отсортированные по новизне, при условии что они есть на складе
    public static function all()
    {
        $query = Connection::make()->query("SELECT products.*, countries.name as country, categories.name as category, brands.name as brand, type_of_goods.name as type, colors.name as color FROM products INNER JOIN countries ON countries.id = products.country_id INNER JOIN categories ON categories.id = products.category_id INNER JOIN brands ON brands.id = products.brand_id INNER JOIN type_of_goods ON type_of_goods.id = products.type_of_good_id INNER JOIN colors ON colors.id = products.color_id");
        return $query->fetchAll();
    }

    //ищем товар на складе по его id
    public static function find($id)
    {
        $query = Connection::make()->prepare("SELECT products.*, countries.name as country, categories.name as category, colors.name as color, brands.photo as brand_photo, brands.name as brand, type_of_goods.name as type_of_good FROM products INNER JOIN countries ON countries.id = products.country_id INNER JOIN categories ON products.category_id = categories.id INNER JOIN brands ON brands.id = products.brand_id INNER JOIN type_of_goods ON type_of_goods.id = products.type_of_good_id INNER JOIN colors ON colors.id = products.color_id WHERE products.id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }

    //получаем пять последних добавленных товаров
    public static function newProducts()
    {
        $query = Connection::make()->query("SELECT products.* FROM products ORDER BY id DESC LIMIT 4");
        return $query->fetchAll();
    }

    //формируем строку с позиционными параметрами
    private static function getParams($array)
    {
        return implode(",", array_fill(0, count($array), "?"));
    }

    //получаем товары по указанным категориям
    public static function productsByManyCategories($category_id)
    {
        //формируем параметры для запроса
        $query = Connection::make()->prepare("SELECT products.*, countries.name as country, categories.name as category, brands.name as brand, type_of_goods.name as type, colors.name as color FROM products INNER JOIN countries ON countries.id = products.country_id INNER JOIN categories ON categories.id = products.category_id INNER JOIN brands ON brands.id = products.brand_id INNER JOIN type_of_goods ON type_of_goods.id = products.type_of_good_id INNER JOIN colors ON colors.id = products.color_id WHERE products.category_id = :category_id");
        $query->execute([
            ':category_id' => $category_id
        ]);
        return $query->fetchAll();
    }

    //обновляем количество товара на складе
    public static function updateCount($basket, $conn = null)
    {
        //проверили наличие $conn
        $conn = $conn ?? Connection::make();

        $query = $conn->prepare("UPDATE product_sizes SET count = count-:count WHERE product_id = :product_id AND size_range_id = :size_range_id");
        foreach ($basket as $item) {
            $query->bindValue(':count', $item->count, \PDO::PARAM_INT);
            $query->bindValue(':product_id', $item->product_id, \PDO::PARAM_INT);
            $query->bindValue(':size_range_id', $item->product_size_id, \PDO::PARAM_INT);
            $query->execute();
        }
    }

    public static function update($id, $name, $price, $image, $description, $color_id, $country_id, $category_id,$brand_id,$type_of_good_id)
    {
        $query = Connection::make()->prepare("UPDATE products SET name = :name, price = :price, photo = :image, description = :description, color_id = :color_id, country_id = :country_id, category_id = :category_id, brand_id = :brand_id, type_of_good_id = :type_of_good_id WHERE id=:id");
        $query->execute([
            ':id' => $id,
            ':name' => $name,
            ':price' => $price,
            ':image' => $image,
            ':description' => $description,
            ':color_id' => $color_id,
            ':country_id' => $country_id,
            ':category_id' => $category_id,
            ':brand_id' => $brand_id,
            ':type_of_good_id' => $type_of_good_id,
        ]);
    }

    public static function filter($brand, $category, $size, $types, $color){
        $queryBase = "SELECT DISTINCT products.* FROM `products` LEFT JOIN product_sizes ON product_sizes.product_id = products.id WHERE ";
        $values = [];
        if($brand != ""){
            $queryBase .= " `brand_id`= :brand_id AND ";
            $values["brand_id"] = $brand;
        }
        if($types != []){
            $queryBase .= " `type_of_good_id` IN ( ";
            $fullText = "";
            foreach( $types as $type){
                $text = "type_id".$type;
                $fullText .= " :". $text. ", ";
                $values[$text] = $type;
            }
            $fullText =trim($fullText, ", ");
            $queryBase .= $fullText ;
            $queryBase .= " ) AND";
        }
        if($color != ""){
            $queryBase .= " color_id = :color_id AND  ";
            $values["color_id"] = $color;
        }
        if( $size != ""){
            $queryBase .= " product_sizes.size_range_id = :size_id AND ";
            $values["size_id"] = $size;
        }
        if($category != ''){
            $queryBase .= " `category_id` = :category_id AND ";
            $values["category_id"] = $category;
        }
        $query = Connection::make()->prepare($queryBase. " 1");
        $query->execute($values);
        return $query->fetchAll();
    }

    public static function getFiltersNews($type_of_good_id){
        $query = Connection::make()->prepare("SELECT * FROM `products` WHERE `type_of_good_id` = :type_of_good_id ORDER BY id DESC LIMIT 4");
        $query->execute(["type_of_good_id"=>$type_of_good_id]);
        return $query->fetchAll();
    }
}
