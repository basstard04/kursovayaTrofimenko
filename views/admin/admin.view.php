<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section>
        <form class="insertAdmin" action="/app/admin/tables/auth.check.admin.php" method="POST">
            <h2>Вход</h2>
            <input type="text" name="email" placeholder="Введите логин" value="<?= $_SESSION["info"]["email"] ?? "" ?>">

            <input type="password" name="password" id="password" placeholder="Введите пароль">

            <?php if (!empty($_SESSION['error'])) : ?>
                <p class="error"><?= $_SESSION['error'] ?></p>
            <?php endif ?>
            <button name="btnAdmin" id="btnAdmin" class="btnAdmin">Войти</button>
        </form>
    </section>
</main>


<?php
unset($_SESSION['error']);
unset($_SESSION["info"]);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer-admin.php";
?>