<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SneakerUniverse</title>
    <link type="image/x-icon" href="/upload/titulnik/logo1.svg" rel="shortcut icon">
    <link type="Image/x-icon" href="/upload/titulnik/logo1.svg" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/style.media.css">
    <script src="/assets/js/fetch.js" defer></script>
    <script type="module" src="/assets/js/modals.js"></script>
    <script src="/assets/js/fetchUser.js"></script>
</head>

<body>
    <header>
        <nav class="oneNav">
            <ul class="ulNavOne">
                <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) : ?>
                    <div class="authReg">
                        <a class="nav-a user" href="">
                            <p>Авторизация</p>
                        </a>
                    </div>
                <?php else : ?>
                    <div class="profile_header">
                        <li><a class="a1" href="/app/tables/users/profile.php"><?= $_SESSION['name'] ?? "" ?></a></li>
                        <li><a class="a1" href="/app/tables/users/logout.php"><img class="exit" src="/upload/titulnik/exit.svg" alt=""></a></li>
                    </div>
                <?php endif ?>
                <li><a class="a1" href="/"><img src="/upload/titulnik/logo1.svg" alt="" class="logoImage"></a></li>
                <li class="a1">8 (922) 231-66-43</li>
            </ul>
        </nav>


        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <ul class="ulNavOne">
                    <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) : ?>
                        <div class="authReg">
                            <a class="nav-a user-tertiary" href="">
                                <p>Авторизация</p>
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="profile_header">
                            <li><a class="a1" href="/app/tables/users/profile.php"><?= $_SESSION['name'] ?? "" ?></a></li>
                            <li><a class="a1" href="/app/tables/users/logout.php"><img class="exit" src="/upload/titulnik/exit.svg" alt=""></a></li>
                        </div>
                    <?php endif ?>
                    <li><a class="a1" href="/"><img src="/upload/titulnik/logo1.svg" alt="" class="logoImage"></a></li>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">SneakerUniverse</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <div class="filtrUl-mobile">
                                    <li><a class="a2" href="/app/tables/products/catalog.php">Каталог</a></li>
                                    <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) : ?>
                                        <li class="li_basket-mobile">Корзина</li>
                                    <?php else : ?>
                                        <li class="li_basket-mobile"><a class="a2" href="/app/tables/basket/basket.php">Корзина</li>
                                    <?php endif ?>
                                    <li><a class="a2" href="/#carouselExampleAutoplaying">Бренды</a></li>
                                    <li><a class="a2" href="/#new_products">Новинки</a></li>
                                    <li><a class="a2" href="/#poleznie_soveti">Полезное</a></li>
                                    <li><a class="a2" href="/app/tables/about.php">О нас</a></li>
                                    <li class="a1">8 (922) 231-66-43</li>
                                    </form>
                                </div>
                        </div>
                    </div>
                </ul>
            </div>
        </nav>

        <nav class="twoNav">
            <ul class="ulNavTwo">
                <div class="filtrUl">
                    <li><a class="a2" href="/app/tables/products/catalog.php">Каталог</a></li>
                    <li><a class="a2" href="/#carouselExampleAutoplaying">Бренды</a></li>
                    <li><a class="a2" href="/#new_products">Новинки</a></li>
                    <li><a class="a2" href="/#poleznie_soveti">Полезное</a></li>
                    <li><a class="a2" href="/app/tables/about.php">О нас</a></li>
                </div>
                <?php if (!isset($_SESSION['auth']) || !$_SESSION['auth']) : ?>
                    <li class="li_basket"><img class="basket-no-in" src="/upload/titulnik/cart.png" alt=""></li>
                <?php else : ?>
                    <li class="li_basket"><a class="a2" href="/app/tables/basket/basket.php"><img class="img_basket_header" src="/upload/titulnik/cart.png" alt=""></a></li>
                <?php endif ?>
            </ul>
        </nav>

    </header>

    <div class="modal-wrapper" id="modal-wrapper">
        <div class="modal">
            <div class="modal__div">
                <div class="modal-header">
                    <div class="modal-header-content">
                        <button class="btn-modal-header sign">
                            <h3>Вход</h3>
                        </button>
                        <h3>/</h3>
                        <button class="btn-modal-header reg">
                            <h3>Регистрация</h3>
                        </button>
                    </div>
                </div>
                <div class="modal__close">&times;</div>
                <div class="modal__content">
                    <form class="entrance" action="" method="POST" id="form-auth">
                        <input type="hidden" name="action" value="auth">
                        <input class="entrance-input" type="email" placeholder="Введите логин" name="email">
                        <input class="entrance-input" type="password" placeholder="Введите пароль" name="password">
                        <p class="error-modal"></p>
                        <button class="btn-auth btn-modal" name="btnAuth">
                            <p>Войти</p>
                        </button>
                        <p class="help">Забыли логин / пароль?</p>
                    </form>
                </div>
            </div>
        </div>
    </div>