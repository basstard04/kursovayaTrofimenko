<?php

use App\models\Order;

include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section>
        <div class="admin-container">

            <table class="orders-table">
                <tr class="tr-order">
                    <th>user</th>
                    <th>reason_cancel</th>
                    <th>status</th>
                    <th>total_price</th>
                    <th>total_count</th>
                </tr>
                <?php foreach ($orders as $order) : ?>
                    <tr class="tr-order">
                        <td><?= $order->user ?></td>
                        <td><?= $order->reason_cancel ?></td>
                        <td id="status" data-order-status="<?= $order->id ?>"><?= $order->status ?></td>
                        <td><?= Order::totalPrice($order->id) ?></td>
                        <td><?= Order::totalCount($order->id) ?></td>
                        <td>
                            <form action="/app/admin/tables/show.order.products.php">
                                <input hidden type="text" name="id" value="<?= $order->id ?>">
                                <button name="btn" class="btnOrderer">Посмотреть</button>
                            </form>
                        </td>
                        <td>
                            <form class="updateStatus" action="/app/admin/tables/update.status.php" method="POST">
                                <input hidden type="text" name="id" value="<?= $order->id ?>">
                                <button class="btn-update-order" id="btnUpdateStatus" name="btnUpdateStatus" data-order-update="<?= $order->id ?>">Изменить статус</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>

            <form class="form-check-order" action="/app/admin/tables/order.php">
                <button name="status" class="status" value="all">все</button>

                <?php foreach ($statuses as $status) : ?>
                    <button name="status" class="status" value="<?= $status->id ?>"><?= $status->name ?></button>
                <?php endforeach ?>
            </form>
            <p class="error error-reason_cancel"><?= $_SESSION['error'] ?? "" ?></p>

        </div>

    </section>
</main>


<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadAdmin.js"></script>
<script src="/assets/js/updateStatus.js"></script>
<?php
unset($_SESSION['error']);
unset($_SESSION['status']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer-admin.php";
?>