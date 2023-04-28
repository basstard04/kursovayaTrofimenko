<?php

namespace App\models;

use App\helpers\Connection;

class Category
{
    public static function all()
    {
        $query = Connection::make()->query("SELECT id, name, photo FROM categories LIMIT 3");
        return $query->fetchAll();
    }
}
