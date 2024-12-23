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
                    <li><a href="#" id= "<?= $c['id_category'] ?>" data-category="<?= $c['name'] ?>"
                            onclick="filterByCategory('<?= $c['id_category'] ?>')"><?= $c['name'] ?></a></li>
                <?php endforeach; ?>
                <li><a href="#" id="category-fruits" data-category="fruits"
                        onclick="filterByCategory('fruits')">Фрукты</a>
                </li>
                <li><a href="#" id="category-vegetables" data-category="vegetables"
                        onclick="filterByCategory('vegetables')">Овощи</a></li>
                <li><a href="#" id="category-confectionery" data-category="confectionery"
                        onclick="filterByCategory('confectionery')">Кондитерка</a></li>
                <li><a href="#" id="category-meat" data-category="meat" onclick="filterByCategory('meat')">Рыба и
                        мясо</a>
                </li>
                <li><a href="#" id="category-dairy" data-category="dairy" onclick="filterByCategory('dairy')">Молочная
                        продукция</a></li>
            </ul>
        </aside>

        <!-- Основной контент с каталогом товаров -->
        <section class="catalog">


            <!-- Добавьте другие товары, если нужно -->
            <?php foreach ($prodAll as $key => $p): ?>
                <div class="product-card" data-category="bread" data-discount=<?= $p['sale'] ?> data-rating=<?= $p['rating'] ?>>
                    <a href="produc_info.php?id=<?= $p['id_product'] ?>">
                        <img src="<?= BASE_URL . 'img/' . trim($p['img']) ?>">
                        <h2><?= $p['name'] ?></h2>
                        <div class="rating">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">☆</span>
                        </div>
                        <p class="price"><?= $p['price'] ?></p>
                        <p class="discount">Скидка 20%!</p>
                    </a>
                    <button class="add-to-cart" onclick="addToCart(1)">Добавить в корзину</button>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
    <script>
        function addToCart(productIndex) {
            fetch('shop_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `index=${encodeURIComponent(productIndex)}`,
            })
            .then(response => {
                if (response.ok) {
                    alert('Товар добавлен в корзину');
                } else {
                    alert('Ошибка при добавлении товара в корзину');
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
        }
    </script>
    <script src="search.js"></script>
    <?php include('footer.php'); ?>

</body>

</html>
