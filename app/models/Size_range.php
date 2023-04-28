<?php

namespace App\models;

use App\helpers\Connection;

class Size_range
{
    public static function all(){
        $query = Connection::make()->query("SELECT * FROM size_ranges");
        return $query->fetchAll();
    }

    public static function search($product_id, $country){
        $query = Connection::make()->prepare("SELECT id, " . $country . " FROM product_sizes INNER JOIN size_ranges ON size_ranges.id = product_sizes.size_range_id WHERE product_sizes.product_id = :product_id AND count > 0");
        $query -> execute([
            ':product_id' => $product_id
        ]);
        return $query->fetchAll();
    }
}
