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
            <?php if (isset($_SESSION['id'])): ?>
                <?php $prod = selectOne('product', ['id_product' => $id]); ?>
                    <div class="product-image-container">
                        <img id="product-image" src="" alt="Изображение товара">
                        <div id="discount-badge" class="discount-badge">Скидка 20%</div> <!-- Скидка в правом верхнем углу -->
                    </div>
                    <div class="details">
                        <h2 id="product-name"><?=$p['name']?></h2>
                        <p id="product-description">Описание товара</p>
                        <p id="product-price">Цена: 500 ₽</p>
                        <button id="add-to-cart">Добавить в корзину</button>
                    </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include('footer.php'); ?>

</body>

</html>