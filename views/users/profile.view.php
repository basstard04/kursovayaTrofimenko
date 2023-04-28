<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/header.php"; ?>

    <h2 class="profile_name">Профиль</h2>
    <div class="profile">
        <div class="navigation-profile">
            <form action="/app/tables/users/profile.php" method="POST">
                <button name="info" class="btn_profile">
                    <h4>Личные данные</h4>
                </button>
            </form>
            <hr>
            <form action="/app/tables/users/profile.order.php" method="POST">
                <button name="profile-order" class="btn_profile">
                    <h4>Заказы</h4>
                </button>
            </form>
        </div>
        <div class="profile-info">
            <h4 class="profile-h4">Имя: <p class="profile_p"><?= $user->name ?></p>
            </h4>
            <h4 class="profile-h4">Email: <p class="profile_p"><?= $user->email ?></p>
            </h4>
            <h4 class="profile-h4">Пол: <p class="profile_p"><?= $user->gender ?></p>
            </h4>
            <h4 class="profile-h4">Телефон: <p class="profile_p"><?= $user->phone ?></p>
            </h4>
        </div>
    </div>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/views/templates/footer.php"; ?>