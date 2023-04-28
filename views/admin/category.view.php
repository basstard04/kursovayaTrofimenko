<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>
<main>
    <section>
        <div class="admin-container">
            <div class="admin-content">
                <form class="form-category" action="/app/admin/tables/category.check.php" method="POST" >
                    <h3>Работа с категориями</h3> <br>
                    <input name="name" class="input-admin-category" type="text" placeholder="Введите название категории">
                    <p class="error"><?= $_SESSION['error'] ?? "" ?></p> <br>

                    <button name="btnAddCategory" id="btnAddCategory" class="btnAdmin">Добавить</button>
                </form>
                <table class="categories-table">
                    <?php foreach ($categories as $category) : ?>
                        <tr class="category">
                            <td><?= $category->id ?></td>
                            <td><?= $category->name ?></td>
                            <td><img class="btn-delete delete-category" src="/upload/titulnik/trash.svg" alt="trash" data-product-id="<?= $category->id ?>"></td>
                            <td><img class="btn-info info-category" src="/upload/titulnik/information-sign.png" alt="info" data-category-id="<?= $category->id ?>"></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>

            <table class="products-table">
                <tbody class="products-table">

                </tbody>
            </table>

        </div>
    </section>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadAdmin.js"></script>
<?php
unset($_SESSION['error']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer-admin.php";
?>