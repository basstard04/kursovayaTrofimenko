<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section class="add_newAdmin">
        <form action="/app/admin/tables/addAdmin.check.php" method="POST" class="form_newAdmin">
            <h3>Добавление новых администраторов</h3>
            <input type="text" name="name" placeholder="Имя">
            <div class="div_pol">
                <input type="radio" hidden name="pol" class="radio-pol" id="pol_m" value="мужчина" checked>
                <label for="pol_m" class="label-pol">Мужчина</label>
                <input type="radio" hidden name="pol" class="radio-pol" id="pol_d" value="женщина">
                <label for="pol_d" class="label-pol">Женщина</label>
            </div>
            <input type="email" name="email" placeholder="Email">
            <input type="phone" name="phone" placeholder="Телефон">
            <input type="password" name="password" placeholder="Пароль">
            <p><?= $_SESSION['error'] ?? "" ?></p>
            <button class="btn_add_admin" name="btn-addAdmin">
                <p>Добавить</p>
            </button>
        </form>

        <table class="table-admin-add">
            <h5 class="h5_admin">Наши администраторы</h5>
            <tr class="tr-product">
                <td>Имя</td>
                <td>Пол</td>
                <td>Email</td>
                <td>Телефон</td>
            </tr>
            <tr>
                <?php foreach ($admins as $admin) : ?>
                    <td><?= $admin->name ?></td>
                    <td><?= $admin->gender ?></td>
                    <td><?= $admin->email ?></td>
                    <td><?= $admin->phone ?></td>
            </tr>
        <?php endforeach ?>
        </table>
    </section>
</main>


<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer-admin.php";
?>