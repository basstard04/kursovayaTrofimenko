<?php

namespace App\models;

use App\helpers\Connection;

class Soviet
{
    public static function all()
    {
        $query = Connection::make()->query("SELECT * FROM soveti_question");
        return $query->fetchAll();
    }

    public static function sovietsByAnswer($id)
    {
        $query = Connection::make()->prepare("SELECT soveti_answers.* FROM soveti_answers INNER JOIN soveti_question ON soveti_question.id = soveti_answers.soveti_question_id WHERE soveti_question.id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetchAll();
    }

    public static function questionById($id)
    {
        $query = Connection::make()->prepare("SELECT * FROM soveti_question WHERE id = :id");
        $query->execute([
            ':id' => $id
        ]);
        return $query->fetch();
    }
}
