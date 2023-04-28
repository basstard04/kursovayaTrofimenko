<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<main>
    <h2 class="h2_order">Оформление заказа</h2>
    <section class="order">
        <form action="/app/tables/basket/order_check.php" method="POST">
            <h4>Контактная информация</h4>
            <p><?= $info->name ?></p>
            <p><?= $info->email ?></p>
            <p><?= $info->phone ?></p>
            <h4>Пункт выдачи</h4>
            <select name="delivery_id">
                <?php foreach ($deliveries as $delivery) : ?>
                    <option value="<?= $delivery->id ?>"><?= $delivery->address ?></option>
                <?php endforeach ?>
            </select>
            <h4>Способ оплаты</h4>
            <input checked type="radio" name="radio" id="receiving" value="Наличными">
            <label for="receiving">Наличными</label>
            <input type="radio" name="radio" id="card_payment" value="По карте">
            <label for="card_payment">По карте</label>

            <h4>Итог: <?= (int)$totalPrice ?>₽</h4>
            <p>Товары в заказе: <?= $totalCount ?>шт.</p>

            <button name="btn-order" class="btn-order">Оформить</button>
        </form>

    </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php"; ?>