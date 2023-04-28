<?php

use App\models\Soviet;

include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

// if (isset($_POST['btn-sovet1.png'])) {
//     $soviets = Soviet::sovietsByAnswer($_POST['id-sovet1.png']);
//     var_dump("1");
// }

// if (isset($_POST['btn-sovet2.png'])) {
//     $soviets = Soviet::sovietsByAnswer($_POST['id-sovet2.png']);
//     var_dump("2");
// }

// if (isset($_POST['btn-sovet3.png'])) {
//     $soviets = Soviet::sovietsByAnswer($_POST['id-sovet3.png']);
//     var_dump("3");
// }

$soviets = Soviet::sovietsByAnswer($_POST['btn-answer']);
$question = Soviet::questionById($_POST['btn-answer']);

include $_SERVER['DOCUMENT_ROOT'] . "/views/products/soveti.view.php";
