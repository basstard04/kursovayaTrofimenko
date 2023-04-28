<?php

namespace App\models;

use App\helpers\Connection;

class Type_of_goods
{
    public static function all(){
        $query = Connection::make()->query("SELECT * FROM type_of_goods");
        return $query->fetchAll();
    }
}