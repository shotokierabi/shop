<?php include('path.php');
include('controllers/prod.php'); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="catalog.css">
    <link rel="stylesheet" href="style_a.css">
    <script src="https://kit.fontawesome.com/9454dd7c20.js" crossorigin="anonymous"></script>
</head>

<body>
<?php include('header.php'); ?>
<div class="search-filter">
    <input type="text" id="search" placeholder="Поиск по названию товара" oninput="filterProducts()">
    <label for="discount-filter" class="discount-label">
        <input type="checkbox" id="discount-filter" onclick="filterProducts()">
        <span class="checkmark"></span>
        Товары со скидкой
    </label>
</div>

<div class="container">
    <!-- Боковая панель с категориями -->
    <aside class="sidebar">
        <h2>Категории</h2>
        <ul>
            <li><a href="#" id="category-all" data-category="all" onclick="filterByCategory('all')">Все товары</a>
            </li>
            <?php foreach ($categoryAll as $key => $c): ?>
                <li><a href="#" id="<?= $c['id_category'] ?>" data-category="<?= $c['name'] ?>"
                       onclick="filterByCategory('<?= $c['id_category'] ?>')"><?= $c['name'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <!-- Основной контент с каталогом товаров -->
    <section class="catalog">
        <?php foreach ($prodAll as $key => $p): ?>
            <div class="product-card" data-discount=<?= $p['sale'] ?> data-price=<?= $p['price'] ?>>
                <a href="produc_info.php?id=<?= $p['id_product'] ?>" class="product-link">
                    <img src="<?= BASE_URL . 'img/' . trim($p['img']) ?>">
                    <h2><?= $p['name'] ?></h2>
                    <div class="rating">
                        <?php
                        $rating = $p['rating']; // Рейтинг товара
                        for ($i = 1; $i <= 5; $i++) {
                            // Если рейтинг больше или равен текущей звезде, ставим заполненную звезду
                            if ($i <= $rating) {
                                echo '<span class="star filled">★</span>';
                            } else {
                                echo '<span class="star">☆</span>';
                            }
                        }
                        ?>
                    </div>
                    <!-- Цена товара -->
                    <div class="price-container">
                        <p class="old-price">3</p> <!-- Старая цена (если есть скидка) -->
                        <p class="price">3</p> <!-- Новая цена -->
                    </div>

                    <!-- Скидка в правом верхнем углу -->
                    <div class="discount" style="display: none;"></div>
                </a>
                    <button class="add-to-cart"
                            onclick="addToCart(<?= $p['id_product'] ?>, '<?= htmlspecialchars($p['name']) ?>',
                            <?= $p['price'] ?>, '<?= BASE_URL . 'img/' . trim($p['img']) ?>')">
                        Добавить в корзину
                    </button>


            </div>
        <?php endforeach; ?>
    </section>
</div>
<script src="search.js"></script>
<script src="priceForSale.js"></script>
<script src="addCart.js"></script>
<?php include('footer.php'); ?>

</body>

</html>
