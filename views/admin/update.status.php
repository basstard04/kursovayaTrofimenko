<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section class="update-status">
        <form class="form-update-status" action="/app/admin/tables/update.status.check.php" method="POST">
            <div class="form-header-admin">
                <h3>Изменение статуса</h3>
            </div>
            <div class="form-update-status-content">
                <div>
                    <label for="">Текущий статус:</label>
                    <input name="old-status" disabled type="text" value="<?= $order->status ?>">
                </div>
                <input type="hidden" name="id" value="<?= $order->id ?>">
                <br>
                <?php if ($order->status == "Принято") : ?>
                    <input type="hidden" name="status-id" value="2">
                    <button class="btn-update-status" name="assembly">
                        <p>В обработке</p>
                    </button>
                    <input type="hidden" name="canceled-id" value="5">
                    <button class="btn-update-status" name="canceled">
                        <p>Отменить</p>
                    </button>
                    <br>
                    <br>
                    <textarea name="reason_cancel" id="" cols="40" rows="10" class="textarea_admin" placeholder="Укажите причину отмены"></textarea>
                    <p class="error"><?= $_SESSION['error'] ?? "" ?></p>
                <?php elseif ($order->status == "В обработке") : ?>
                    <input type="hidden" name="status-id" value="3">
                    <button class="btn-update-status" name="on-the-way">
                        <p>Доставляется</p>
                    </button>
                <?php elseif ($order->status == "Доставляется") : ?>
                    <input type="hidden" name="status-id" value="4">
                    <button class="btn-update-status" name="delivered">
                        <p>Готово к выдаче</p>
                    </button>
                <?php endif ?>
            </div>

        </form>
    </section>
</main>

<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.admin.php";
?>