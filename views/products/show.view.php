<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<main>
    <section class="show-product">
        <div class="div-img-show-product"><img src="/upload/product/<?= $product->photo ?>" class="img-show-product" alt="<?= $product->photo ?>"></div>
        <div class="show-product-info">
            <img src="/upload/brand/<?= $product->brand_photo ?>" alt="<?= $product->brand_photo ?>">
            <p class="product_name"><?= $product->name ?></p>
            <p class="product_price"><?= (int)$product->price ?>₽</p>
            <hr>
            <form action="/app/tables/products/size_range.php">
                <input type="hidden" name="id" value="<?= $product->id ?>">
                <p class="product_sizes">Выберите размер:
                    
                    <input hidden checked value="rus" name="size" id="rus" type="radio" class="btn_sizes">
                    <label for="rus" class="btn_sizes_label">RUS</label>
                    
                    <input hidden value="US" name="size" id="us" type="radio" class="btn_sizes">
                    <label for="us" class="btn_sizes_label">US</label>
                    
                    <input hidden value="EUR" name="size" id="eur" type="radio" class="btn_sizes">
                    <label for="eur" class="btn_sizes_label">EUR</label>
                </p>
                <div class="sizes"></div>
            </form>
            <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) : ?>
                <button class="btn_Inbasket_nezareg">Добавить в корзину</button>
            <?php else : ?>
                <button class="btn_Inbasket" id="btn-<?= $product->id ?>" data-btn-id="<?= $product->id ?>">Добавить в корзину</button>
            <?php endif ?>

        </div>
    </section>
    <hr>
    <section class="show-info">
        <h2>Описание товара</h2>
        <p class="product-description"><?= $product->description ?></p>
        <h2>Характеристика товара</h2>
        <p class="product-har-ka"><img src="/upload/titulnik/Star.svg" alt="">Категория: <?= $product->type_of_good ?></p>
        <p class="product-har-ka"><img src="/upload/titulnik/Star.svg" alt="">Страна производитель: <?= $product->country ?></p>
        <p class="product-har-ka"><img src="/upload/titulnik/Star.svg" alt="">Цвет: <?= $product->color ?></p>
    </section>
</main>

<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadSize.js"></script>
<script src="/assets/js/loadProductsInBasket2.js"></script>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php"; ?>