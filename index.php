<?php include('path.php'); 
include('controllers/account.php'); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Магазин продуктов</title>
    <link rel="stylesheet" href="style_a.css">
    <link rel="stylesheet" href="home.css">
    <script src="https://kit.fontawesome.com/9454dd7c20.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="container">
        <!-- Баннер с скидкой -->
        <div class="banner">
            <div class="banner-text">
                <h1>Скидка на Мандарины!</h1>
                <p>Только до конца месяца — скидка 20% на все мандарины!</p>
                <button class="button">Купить сейчас</button>
            </div>
        </div>

        <!-- О компании -->
        <div class="about">
            <h2>О компании</h2>
            <p>збс компания</p>
        </div>

        <!-- Генеральный директор -->
        <div class="director">
            <h3>Сведения о генеральном директоре</h3>
            <p>Наш генеральный директор - Ремез. Позже тут появится его фотография</p>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>