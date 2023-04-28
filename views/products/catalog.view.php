<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<main>
    <!-- пол -->
    <section class="catalog-view">
        <div class="catalog_pol">
            <?php foreach ($categories as $category) : ?>
                <!-- <form action="/app/tables/products/catalog.php" method="POST"> -->
                <input type="hidden" name="btn-id" value="<?= $category->id ?>">
                <input type="radio" style="display: none" name="btn-category" id="category<?= $category->id ?>" value="<?= $category->id ?>" <?= isset($_POST["btn-id"]) && $_POST["btn-id"] == $category->id ? "checked" : "" ?> class="btn_category_a filter">
                <label for="category<?= $category->id ?>" class="btn_category_pol"><?= $category->name ?></label>
                </input>
                <!-- </form> -->
            <?php endforeach ?>
        </div>
    </section>

    <section class="tip_obuvi_catalog">
        <div class="tip_obuvi_filter">
            <?php foreach ($type_of_goods as $type_of_good) : ?>
                <input id="<?= $type_of_good->name ?>" hidden name="type" type="checkbox" class="btn_tip_obuvi filter" value="<?= $type_of_good->id ?>"></input>
                <label class="label-type" for="<?= $type_of_good->name ?>"><?= $type_of_good->name ?></label>
            <?php endforeach ?>
        </div>
    </section>

    <section class="filter_catalog">
        <select class="filter" id="brand_selector">
            <option selected value="">Все бренды</option>
            <?php foreach ($brands as $brand) : ?>
                <option <?= isset($_GET["brandId"]) && $_GET["brandId"] == $brand->id ? "selected" : "" ?> value="<?= $brand->id ?>"><?= $brand->name ?></option>
            <?php endforeach ?>
        </select>

        <select class="filter" id="color_selector">
            <option selected value="">Все цвета</option>
            <?php foreach ($colors as $color) : ?>
                <option value="<?= $color->id ?>"><?= $color->name ?></option>
            <?php endforeach ?>
        </select>

        <select class="filter" id="size_selector">
            <option selected value="">Все размеры</option>
            <?php foreach ($size_ranges as $size_range) : ?>
                <option value="<?= $size_range->id ?>"><?= $size_range->RUS ?></option>
            <?php endforeach ?>
        </select>
    </section>

    <section>
        <div class="main_div_catalog">
            <div class="catalog_product-conteiner">
                <?php foreach ($products as $product) : ?>
                    <div class="catalog_product">
                        <a class="catalog-product-a" href="/app/tables/products/show.php?id=<?= $product->id ?>">
                            <img class="product-img" src="/upload/product/<?= $product->photo ?>" alt="<?= $product->photo ?>">
                            <p class="catalog_p_productNew_name"><?= $product->name ?></p>
                        </a>
                        <div class="price-basket">
                            <p class="catalog_p_productNew_price"><?= (int)$product->price ?>₽</p>
                            <a class="catalog-product-a" href="/app/tables/products/show.php?id=<?= $product->id ?>">
                                <img class="btn-basket" src="/upload/titulnik/info.png" alt="basket">
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <div id="stranici">

    </div>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadProducts.js"></script>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php"; ?>
