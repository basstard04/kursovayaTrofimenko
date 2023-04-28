<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section>
        <div class="admin-container">
            <div class="admin-content-products">
                <form class="form-products" action="/app/admin/tables/product.check.php" method="POST" enctype="multipart/form-data">
                    <h3>Добавить новый продукт</h3>
                    <input type="text" name="name" placeholder="Name" value="<?= $_SESSION['product']['name'] ?? "" ?>">
                    <p class="error"><?= $_SESSION['error']['name'] ?? "" ?></p>

                    <input type="text" name="price" placeholder="Price" value="<?= $_SESSION['product']['price'] ?? "" ?>">
                    <p class="error"><?= $_SESSION['error']['price'] ?? "" ?></p>

                    <textarea name="description" id="" cols="20" rows="10" placeholder="description"></textarea>

                    <select name="color_id" id="">
                        <?php foreach ($colors as $color) : ?>
                            <option value="<?= $color->id ?>"><?= $color->name ?></option>
                        <?php endforeach ?>
                    </select>
                    <p class="error"><?= $_SESSION['error']['color'] ?? "" ?></p>

                    <select name="country_id" id="">
                        <?php foreach ($countries as $country) : ?>
                            <option value="<?= $country->id ?>"><?= $country->name ?></option>
                        <?php endforeach ?>
                    </select>
                    <select name="category_id" id="">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php endforeach ?>
                    </select>
                    <select name="brand_id" id="">
                        <?php foreach ($brands as $brand) : ?>
                            <option value="<?= $brand->id ?>"><?= $brand->name ?></option>
                        <?php endforeach ?>
                    </select>
                    <select name="type_of_good_id" id="">
                        <?php foreach ($type_of_goodes as $type_of_good) : ?>
                            <option value="<?= $type_of_good->id ?>"><?= $type_of_good->name ?></option>
                        <?php endforeach ?>
                    </select>

                    <label for="image">Загрузите фотографию</label>
                    <input type="file" name="image">
                    <p><?= $_SESSION['error']['file'] ?? "" ?></p>
                    <p class="error"><?= $_SESSION['error']['image'] ?? "" ?></p>

                    <button name="btnAddProduct" id="btnAddProduct">Добавить</button>
                </form>

                <div class="button-product-admin">
                    <input type="hidden" name="category_id" value="all">
                    <button name="btn-category" class="btn-category-admin" data-category-id="all">
                        <p>Все</p>
                    </button>
                    <?php foreach ($categories as $category) : ?>
                        <input type="hidden" name="category_id" value="<?= $category->id ?>">
                        <button name="btn-category" class="btn-category-admin" data-category-id="<?= $category->id ?>">
                            <p><?= $category->name ?></p>
                        </button>
                    <?php endforeach ?>
                </div>

                <table class="tableProd">
                    <tr class="tr-product">
                        <td>изображение</td>
                        <td>название</td>
                        <td>цена</td>
                        <td>цвет</td>
                        <td>страна</td>
                        <td>категория</td>
                        <td>бренд</td>
                        <td colspan="2">действия</td>
                    </tr>
                    <tbody class="products-table">

                    </tbody>
                </table>
            </div>

        </div>
    </section>
</main>



<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadProductsInAdmin.js"></script>
<script src="/assets/js/loadAdmin.js"></script>
<?php
unset($_SESSION['error']);
unset($_SESSION['product']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer-admin.php";
?>