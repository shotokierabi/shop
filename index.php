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
            <a href="catalog.php" ><button class="button">Купить сейчас</button></a>
        </div>
    </div>

    <!-- О компании -->
    <div class="about">
        <h2>О компании</h2>
        <p>Добро пожаловать в наш магазин продуктов!

            Мы рады предложить вам широкий ассортимент качественных продуктов питания по доступным ценам. У нас вы
            найдете все, что нужно для вашего стола — от свежих овощей и фруктов до деликатесов и напитков. Мы заботимся
            о том, чтобы каждый товар в нашем магазине был свежим и вкусным, а процесс покупки — быстрым и удобным.

            </p>
    </div>

    <!-- Генеральный директор -->
    <div class="director">
        <h3>Сведения о генеральном директоре</h3>
        <div class="director-content">
            <div class="director-photo">
                <img src="img/boss.jpg" alt="Фотография генерального директора"/>
            </div>
            <div class="director-info">
                <p>Наш генеральный директор - Ремез Алексей. Очень ответственный человек, который всегда обращает
                    внимания на маленькие детали. С ним наш магазин будет процветать.</p>
            </div>
        </div>
    </div>

</div>
<?php include('footer.php'); ?>
</body>

</html>