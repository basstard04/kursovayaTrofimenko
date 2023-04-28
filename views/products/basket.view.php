<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

<main>
    <section class="basket">
        <div class="main-basket">
            <div class="h2_delete">
                <div>
                    <h2 class="h2_basket">Корзина</h2>
                </div>
                <div><button class="clear">Очистить всю корзину</button></div>
            </div>
            <hr>
            <div class="basket-products">
                <?php foreach ($productInBasket as $product) : ?>
                    <div class="basket-position">
                        <div class="basket-img">
                            <img class="img-in-basket" src="/upload/product/<?= $product->photo ?>" alt="<?= $product->name ?>">
                        </div>
                        <div class="basket-product-info">
                            <p class="product_name_basket"><?= $product->name ?></p>
                            <!-- <input type="hidden" class="size_ids" value="<?= $product->product_size_id ?>"> -->
                            <p>RUS: <?= $product->RUS ?> (US: <?= $product->US ?> , EUR: <?= $product->EUR ?>)</p>
                            <p>Цвет: <?= $product->color ?></p>
                            <p class="price"><?= (int)$product->price ?>₽</p>

                            <div class="count_products">
                                <button class="btn-product-basket minus" data-product-id="<?= $product->product_id ?>" data-size-id="<?= $product->product_size_id ?>">-</button>
                                <p class="count" id="count-<?= $product->product_id ?>-<?= $product->product_size_id ?>"><?= $product->count ?>шт.</p>
                                <button class="btn-product-basket plus" data-product-id="<?= $product->product_id ?>" data-size-id="<?= $product->product_size_id ?>">+</button>
                            </div>
                            <p class="sumProduct" id="sumPrice-<?= $product->product_id ?>-<?= $product->product_size_id ?>" data-price-position="<?= $product->product_id ?>"><?= (int)$product->price_position ?>₽</p>
                            <img class="btn-delete delete" src="/upload/titulnik/trash.svg" alt="trash" data-product-id="<?= $product->product_id ?>" data-size-id="<?= $product->product_size_id ?>">
                        </div>
                        <hr>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="basket-info">
            <div class="itog">
                <h4>Оформите заказ:</h4>
                <p class="totalCount">Товары в заказе: <?= (int)$totalCount ?>шт.</p>
                <p class="totalPrice">Итог: <?= (int)$totalPrice ?>₽</p>
            </div>

            <form action="/app/tables/basket/order.php" method="POST">
                <button class="btn_zakaz">Оформить заказ</button>
            </form>
        </div>
    </section>
    <section class="basket-null">
        <p class="messageOne"><?= $_SESSION['basket'] ?? '' ?></p>
        <p class="messageTwo"><?= $_SESSION['basket'] ?? '' ?></p>
    </section>
</main>

</div>
<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/loadProductsInBasket.js"></script>
<?php unset($_SESSION['basket']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php"; ?>