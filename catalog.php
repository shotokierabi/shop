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
                    <button class="add-to-cart">Добавить в корзину</button>
                </div>
            <?php endforeach; ?>

            <div class="product-card" data-category="fruits" data-discount="false" data-rating="4.5">
                <img src="img/appleRed.jpg" alt="Яблоко">
                <h2>Яблоко</h2>
                <div class="rating">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">☆</span>
                </div>
                <p class="price">100.99</p>
                <button class="add-to-cart" onclick="addToCart(7)">Добавить в корзину</button>
            </div>

            <div class="product-card" data-category="vegetables" data-discount="false" data-rating="4.5">
                <img src="img/tomato.jpg" alt="Помидор">
                <h2>Помидор</h2>
                <div class="rating">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">☆</span>
                </div>
                <p class="price">90.99</p>
                <button class="add-to-cart" onclick="addToCart(8)">Добавить в корзину</button>
            </div>

            <div class="product-card" data-category="confectionery" data-discount="true" data-rating="5">
                <img src="img/cake.jpg" alt="Кексик">
                <h2>Кексик</h2>
                <div class="rating">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                </div>
                <p class="price">900.99</p>
                <p class="discount">Скидка 3%!</p>
                <button class="add-to-cart" onclick="addToCart(12)">Добавить в корзину</button>
            </div>

            <div class="product-card" data-category="meat" data-discount="false" data-rating="4.5">
                <img src="img/fish.jpg" alt="Рыба">
                <h2>Рыба</h2>
                <div class="rating">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">☆</span>
                </div>
                <p class="price">93.99</p>
                <button class="add-to-cart" onclick="addToCart(10)">Добавить в корзину</button>
            </div>

            <div class="product-card" data-category="meat" data-discount="false" data-rating="4.5">
                <img src="img/mit.jpg" alt="Мясо">
                <h2>Мясо</h2>
                <div class="rating">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">☆</span>
                </div>
                <p class="price">103.99</p>
                <button class="add-to-cart" onclick="addToCart(11)">Добавить в корзину</button>
            </div>

            <div class="product-card" data-category="dairy" data-discount="false" data-rating="4.5">
                <img src="img/milk.jpg" alt="Молоко">
                <h2>Молоко</h2>
                <div class="rating">
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">★</span>
                    <span class="star">☆</span>
                </div>
                <p class="price">180.99</p>
                <button class="add-to-cart" onclick="addToCart(9)">Добавить в корзину</button>
            </div>

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
                    alert('Товар успешно добавлен в корзину или обновлено его количество');
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
