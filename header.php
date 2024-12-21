<!DOCTYPE html>
<html lang="ru">

<head>
</head>

<body>
    <header class="container-fluid">
        <div class="container1">
            <div class="row">
                <div class="col">
                    <h1 class="logo">
                        <a href="<?php echo BASE_URL ?>">Shop</a>
                    </h1>
                </div>
                <div class="col">
                    <div class="menu">
                        <ul>
                            <li><a href="<?php echo BASE_URL ?>">Главная</a></li>
                            <li><a href="<?php echo BASE_URL . 'catalog.php' ?>">Каталог</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col3">
                    <div class="auth">
                        <?php if (isset($_SESSION['id'])): ?>
                            <a href="<?php echo BASE_URL . 'shop_cart.php' ?>"><i class="fa-solid fa-cart-shopping"></i></a>
                            <a href="<?php echo BASE_URL . 'personal_account.php' ?>"><i class="fa-solid fa-user"></i></a>
                            <a href="<?php echo BASE_URL . 'logout.php' ?>"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        <?php else: ?>
                            <a href="<?php echo BASE_URL . 'login.php' ?>"><i class="fa-solid fa-user"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>

</html>