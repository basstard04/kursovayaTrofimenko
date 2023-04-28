<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<form class="insert" action="/app/tables/users/auth_check.php" method="POST">
    <h2>Вход</h2>
    <input type="text" name="login" placeholder="Введите логин" class="input-reg-auth">

    <input type="password" name="password" id="password" placeholder="Введите пароль" class="input-reg-auth">

    <?php if (!empty($_SESSION['error'])) : ?>
        <p class="error"><?= $_SESSION['error'] ?></p>
    <?php endif ?>
    <button name="btnAuth" id="btnAuth">Войти</button>
</form>

<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php";
