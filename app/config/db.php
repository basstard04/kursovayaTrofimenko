<?php

const CONFIG_CONECTION = [
    'host' => 'localhost',
    'dbname' => 'SportSneakers',
    'login' => 'root',
    'password' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]
];
