<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<form class="insert" action="/app/tables/users/insert.php" method="POST">
    <h2>Регистрация</h2>
    <input type="text" name="name" id="" placeholder="Введите свое имя" class="input-reg-auth" value="<?= $_SESSION['contact']['name'] ?? "" ?>">
    <p class="error"><?= $_SESSION['error']['data']['name'] ?? "" ?></p>

    <div class="div_pol">
        <input type="radio" hidden name="pol" class="radio-pol" id="pol_m" value="мужчина" checked>
        <label for="pol_m" class="label-pol">Мужчина</label>
        <input type="radio" hidden name="pol" class="radio-pol" id="pol_d" value="женщина">
        <label for="pol_d" class="label-pol">Женщина</label>
    </div>

    <input type="email" name="email" placeholder="Введите вашу почту" class="input-reg-auth" value="<?= $_SESSION['contact']['email'] ?? "" ?>">
    <p class="error"><?= $_SESSION['error']['data']['email'] ?? "" ?></p>
    <p class="error"><?= $_SESSION['error']['email'] ?? "" ?></p>

    <input type="phone" name="phone" placeholder="Введите ваш телефон" class="input-reg-auth" value="<?= $_SESSION['contact']['phone'] ?? "" ?>">
    <p class="error"><?= $_SESSION['error']['data']['phone'] ?? "" ?></p>

    <input type="password" name="password" id="password" placeholder="Придумайте пароль" class="input-reg-auth">
    <p class="error"><?= $_SESSION['error']['data']['password'] ?? "" ?></p>

    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Подтверждение пароля" class="input-reg-auth">
    <p class="error"><?= $_SESSION['error']['data']['password_confirmation'] ?? "" ?></p>
    <p class="error"><?= $_SESSION['error']['password'] ?? "" ?></p>
    <p class="error"><?= $_SESSION['error']['reg'] ?? "" ?></p>

    <div class="agreem">
        <label for="agreement">Согласен на обработку персональных данных</label>
        <input type="checkbox" checked name="agreement" id="agreement">
    </div>

    <button name="btnReg" id="btnReg">Зарегистрироваться</button>

</form>

<script>
    document.querySelector('#agreement').addEventListener('change', (e) => {
        document.querySelector('#btnReg').disabled = !e.target.checked
    })
</script>

<?php
unset($_SESSION['error']);
unset($_SESSION['contact']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php";
