<?php include('path.php');
include('controllers/prod.php'); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Детали товара</title>
    <link rel="stylesheet" href="product.css">
    <link rel="stylesheet" href="style_a.css">
    <script src="https://kit.fontawesome.com/9454dd7c20.js" crossorigin="anonymous"></script>
</head>

<body>
<?php include('header.php'); ?>
<div class="product-detail">
    <div class="product-info">
        <?php if (isset($_GET['id'])): ?>
            <?php $prod = selectOne('product', ['id_product' => $_GET['id']]); ?>
            <div class="product-image-container">
                <img id="product-image" src="<?= BASE_URL . 'img/' . trim($prod['img']) ?>">
                <!-- Скидка в правом верхнем углу -->
                <?php if ($prod['sale'] > 0): ?>
                    <div class="discount-badge">- <?= $prod['sale'] ?>%</div>
                <?php endif; ?>
            </div>
            <div class="details">
                <h2 id="product-name"><?= $prod['name'] ?></h2>
                <p id="product-description">Производитель: <?= $prod['manufacturer'] ?></p>
                <p id="product-description">Состав: <?= $prod['structure'] ?></p>
                <p id="product-description">Срок хранения: <?= $prod['expiration_date'] ?></p>
                <p id="product-description">Вес: <?= $prod['weight'] ?></p>
                <p id="product-description">Описание: <?= $prod['descriptions'] ?></p>

                <!-- Цена товара -->
                <div class="price-container">
                    <?php if ($prod['sale'] > 0): ?>
                        <p class="old-price"><?= $prod['price'] ?> ₽</p> <!-- Старая цена -->
                    <?php endif; ?>
                    <p class="price"><?= $prod['price'] * (1 - $prod['sale'] / 100) ?> ₽</p> <!-- Новая цена -->
                </div>

                <button id="add-to-cart">Добавить в корзину</button>
            </div>
        <?php endif; ?>
    </div>
</div>


<script src="priceForSale.js"></script>
<?php include('footer.php'); ?>

</body>

</html>