<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<main>

<div class="container-tit">
    <section class="titulnik">
        <div class="text_titulnik">
            <h2 class="h2_tit">SneakerUniverse</h2>
            <p class="p_tit">Крупнейший интернет-магазин спортивной обуви</p>
        </div>
    </section>
</div>

<!-- вывод категорий -->
<div class="container-category" id="container-category">
    <?php foreach ($categories as $category) : ?>
        <form action="/app/tables/products/catalog.php" method="POST">
            <input type="hidden" name="btn-id" value="<?= $category->id ?>">
            <button name="btn-category" class="btn-category">
                <p class="category_name"><?= $category->name ?></p>
                <img class="category_img" src="/upload/titulnik/<?= $category->photo ?>" alt="">
            </button>
        </form>
    <?php endforeach ?>
</div>

<br>
<hr>
<!-- слайдер -->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($brandsreform as $key => $arr) : ?>
            <div class="carousel-item <?= $key == "st1" ? 'active' : '' ?>">
                <?php foreach ($arr as $key => $value) : ?>
                    <a href="/app/tables/products/catalog.php?brandId=<?= $value->id ?>"><img class="imgSlider" src="/upload/brand/<?= $value->photo ?>" class="d-block w-100" alt="<?= $value->photo ?>"></a>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden"></span>
    </button>
</div>
<hr>
<br>

<!-- Новинки -->
<h2 id="new_products">Новинки</h2>
<div class="new_type">
    <?php foreach ($type_of_goods as $type_of_good) : ?>
        <input type="hidden" name="btn-id" value="<?= $type_of_good->id ?>">
        <input type="radio" value="<?= $type_of_good->id ?>" data-id="<?= $type_of_good->id ?>" name="btn-category" class="btn_new filter" id="radio-<?= $type_of_good->id ?>">
        <label class="btn_new_label" for="radio-<?= $type_of_good->id ?>"><?= $type_of_good->name ?></label>
    <?php endforeach ?>
</div>

<div class="product-conteiner">
    <?php foreach ($products as $product) : ?>
        <div class="product_new">
            <a class="catalog-product-a" href="/app/tables/products/show.php?id=<?= $product->id ?>">
                <img src="/upload/product/<?= $product->photo ?>" alt="<?= $product->photo ?>">
                <p class="p_productNew_name"><?= $product->name ?></p>
                <p class="p_productNew_price"><?= (int)$product->price ?>₽</p>
            </a>
        </div>
    <?php endforeach ?>
</div>
<hr>

<!-- Полезные советы -->
<h2 id="poleznie_soveti">Полезные советы</h2>
<form action="/app/tables/soveti.php" method="POST" class="conteiner-soveti">
    <?php foreach ($soviets as $soviet) : ?>
        <button name="btn-answer" class="btn_soveti" value="<?= $soviet->id ?>">
            <p class="soveti_name"><?= $soviet->name ?></p>
            <img class="soveti_img" src="/upload/titulnik/<?= $soviet->photo ?>" alt="<?= $soviet->photo ?>">
        </button>
    <?php endforeach ?>
</form>

</main>
<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/main.js"></script>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php"; ?>