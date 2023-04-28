<?php

use App\models\Order;

include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section>
        <div class="container-order">
            <p>Итого: <?= $totalPrice * $totalCount ?? "" ?> ₽</p>
            <p>order_id: <?= $info->id ?></p>
            <p>user: <?= $info->user ?></p>
            <p>login: <?= $info->login ?></p>

            <table class="table-product-order">
                <tr>
                    <th>name</th>
                    <th>count</th>
                    <th>price</th>
                </tr>

                <?php foreach ($productsInOrder as $product) : ?>
                    <tr class="tr-orders">
                        <td><?= $product->name ?></td>
                        <td><?= $product->count ?></td>
                        <td><?= $product->price ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </section>
</main>



<?php
unset($_SESSION['update']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer-admin.php";
?>