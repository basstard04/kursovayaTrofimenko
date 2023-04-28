<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/app/config/db.php";
include $_SERVER['DOCUMENT_ROOT'] . "/app/helpers/Connection.php";
include $_SERVER['DOCUMENT_ROOT'] . "/app/models/User.php";
include $_SERVER['DOCUMENT_ROOT'] . "/app/models/Category.php";
include $_SERVER['DOCUMENT_ROOT'] . "/app/models/Brand.php";
include $_SERVER['DOCUMENT_ROOT'] . "/app/models/Soviet.php";
include $_SERVER['DOCUMENT_ROOT'] . "/app/models/Product.php";
include $_SERVER['DOCUMENT_ROOT'] . "/app/models/Type_of_goods.php";
include $_SERVER['DOCUMENT_ROOT'] . "/app/models/Color.php";
include $_SERVER['DOCUMENT_ROOT'] . "/app/models/Size_range.php";

include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Basket.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Order.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/Admin.php";
