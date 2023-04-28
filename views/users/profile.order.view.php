<?php
use App\models\User;
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php";
?>

<h2 class="profile_name">Профиль</h2>
<div class="profile">
    <div class="navigation-profile">
        <form action="/app/tables/users/profile.php" method="POST">
            <button name="profile-info" class="btn_profile">
                <h4>Личные данные</h4>
            </button>
        </form>
        <hr>
        <form action="/app/tables/users/profile.order.php" method="POST">
            <button name="profile-order" class="btn_profile">
                <h4>Заказы</h4>
            </button>
        </form>
    </div>
    <div class="profile-info">
        <?php foreach ($orders as $order) : ?>
            <p>Дата заказа: <?= $order->data_order ?></p>
            <p>Статус заказа: <?= $order->status ?></p>
            <p>Пункт выдачи: <?= $order->delivery ?></p>
            <p>Способ оплаты: <?= $order->payment_method ?></p>
            <hr>
            <h5>Товары в заказе: </h5>
            <?php foreach (User::productByOrderUser($order->id) as $product) : ?>
                <img src="/upload/product/<?= $product->photo ?>" class="img-profile">
                <p><?= $product->name ?></p>
                <p>Цена товара: <?= $product->price ?></p>
                <p>Размер RUS: <?= $product->size ?></p>
                <hr> <br>
            <?php endforeach ?>
        <?php endforeach ?>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php"; ?>