<?php include('path.php');
include('controllers/checkout.php'); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оплата</title>
    <link rel="stylesheet" href="style_a.css">
    <script src="https://kit.fontawesome.com/9454dd7c20.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 20px;
            color: #555;
            margin-bottom: 10px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-info {
            display: flex;
            align-items: center;
        }

        .item-info img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 5px;
        }

        .item-name {
            font-size: 18px;
            margin: 0;
        }

        .item-price {
            font-size: 16px;
            color: #555;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .total-price {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
            color: #333;
        }

        .checkout-button {
            display: block;
            text-align: center;
            margin: 30px auto 0;
            background-color: #28a745;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .checkout-button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="container">
        <h1>Оплата</h1>

        <!-- Список товаров -->
        <div class="section">
            <h2>Список товаров</h2>
            <div id="cart-items">
                <!-- Товары из корзины будут подгружаться сюда -->
            </div>
        </div>

        <!-- Способ оплаты -->
        <div class="section">
            <h2>Способ оплаты</h2>
            <div class="form-group">
                <label for="payment-method">Выберите способ оплаты:</label>
                <select id="payment-method" name="payment-method">
                    <option value="card">Карта</option>
                    <option value="cash">Наличные</option>
                    <option value="online">Онлайн оплата</option>
                </select>
            </div>
        </div>

        <!-- Адрес доставки -->
        <div class="section">
            <h2>Адрес доставки</h2>
            <div class="form-group">
                <label for="delivery-address">Введите адрес:</label>
                <input type="text" id="delivery-address" name="delivery-address" placeholder="Введите адрес доставки">
            </div>
        </div>

        <!-- Время доставки -->
        <div class="section">
            <h2>Время доставки</h2>
            <div class="form-group">
                <label for="delivery-time">Выберите время:</label>
                <input type="datetime-local" id="delivery-time" name="delivery-time">
            </div>
        </div>

        <!-- Итоговая цена -->
        <p class="total-price">Итоговая цена: <span id="total-price">0</span> ₽</p>

        <!-- Кнопка оплаты -->
        <a href="#" class="checkout-button" onclick="confirmPayment()">Оплатить</a>
    </div>

    <script>
        async function loadCartItems() {
            const response = await fetch('cart.php'); // Получение данных из корзины
            const data = await response.json();

            const cartItemsContainer = document.getElementById('cart-items');
            const totalPriceElement = document.getElementById('total-price');
            let totalPrice = 0;

            if (data.error) {
                cartItemsContainer.innerHTML = `<p>${data.error}</p>`;
            } else {
                cartItemsContainer.innerHTML = '';
                data.forEach(item => {
                    const cartItem = document.createElement('div');
                    cartItem.classList.add('cart-item');
                    cartItem.innerHTML = `
                        <div class="item-info">
                            <img src="${item.img}" alt="${item.name}">
                            <p class="item-name">${item.name}</p>
                        </div>
                        <p class="item-price">${item.price} ₽</p>
                    `;
                    cartItemsContainer.appendChild(cartItem);
                    totalPrice += item.price * item.quantity;
                });
                totalPriceElement.textContent = totalPrice.toFixed(2);
            }
        }

        function confirmPayment() {
            alert('Оплата успешно завершена!');
        }

        loadCartItems();
    </script>
    <?php include('footer.php'); ?>
</body>

</html>