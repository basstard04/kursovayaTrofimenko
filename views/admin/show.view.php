<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.admin.php"; ?>

<main>
    <section>
        <div class="container">
            <form class="product-update" action="/app/admin/tables/update.product.php" method="POST" enctype="multipart/form-data">

                <input name="id" type="hidden" placeholder="id" value="<?= $product->id ?>">

                <input name="name" type="text" placeholder="Name" value="<?= $product->name ?>">
                <p class="error"><?= $_SESSION['update']['name'] ?? "" ?></p>

                <input name="price" type="text" placeholder="Price" value="<?= $product->price ?>">
                <p class="error"><?= $_SESSION['update']['price'] ?? "" ?></p>

                <textarea name="description" id="" cols="30" rows="10"><?= $product->description ?></textarea>

                <input name="old-color" disabled type="text" value="<?= $product->color ?>">       

                <select name="color_id" id="">
                    <?php foreach ($colors as $color) : ?>
                        <option value="<?= $color->id ?>"><?= $color->name ?></option>
                    <?php endforeach ?>
                </select>

                <input name="old-country" disabled type="text" value="<?= $product->country ?>">

                <select name="country_id" id="">
                    <?php foreach ($countries as $country) : ?>
                        <option value="<?= $country->id ?>"><?= $country->name ?></option>
                    <?php endforeach ?>
                </select>

                <input name="old-category" disabled type="text" value="<?= $product->category ?>">

                <select name="category_id" id="">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php endforeach ?>
                </select>

                <input name="old-brand" disabled type="text" value="<?= $product->brand ?>">

                <select name="brand_id" id="">
                    <?php foreach ($brands as $brand) : ?>
                        <option value="<?= $brand->id ?>"><?= $brand->name ?></option>
                    <?php endforeach ?>
                </select>

                <input name="old-type_of_good" disabled type="text" value="<?= $product->type_of_good ?>">

                <select name="type_of_good_id" id="">
                    <?php foreach ($type_of_goodes as $type_of_good) : ?>
                        <option value="<?= $type_of_good->id ?>"><?= $type_of_good->name ?></option>
                    <?php endforeach ?>
                </select>

                <input type="text" name="imageOld" placeholder="Image" value="<?= $product->photo ?>">
                <input name="image" type="file">
                <p class="error"><?= $_SESSION['update']['image'] ?? "" ?></p>

                <button name="btn-update" class="btn-update">Изменить</button>
            </form>
        </div>
    </section>
</main>



<?php
unset($_SESSION['update']);
include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer-admin.php";
?>