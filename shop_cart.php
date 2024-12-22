<? include('path.php');
include('controllers/cart.php'); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
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
            width: 1200px;
            margin: 0 auto;
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

        .cart-empty {
            text-align: center;
            font-size: 18px;
            color: #888;
            margin: 50px 0;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            background-color: #fdfdfd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .item-info img {
            width: 80px;
            height: 80px;
            border-radius: 5px;
            object-fit: cover;
        }

        .item-name {
            font-size: 18px;
            font-weight: bold;
            color: #555;
        }

        .item-price {
            font-size: 16px;
            color: #28a745;
            font-weight: bold;
        }

        .item-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .item-controls button {
            background-color: #ff6b6b;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .item-controls button:hover {
            background-color: #ff4c4c;
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
            background-color: #007bff;
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
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="container">
        <h1>Корзина</h1>
        <div id="cart-items" class="cart-empty">
            Ваша корзина пуста.
        </div>
        <p class="total-price" id="total-price">Итоговая цена: 0 ₽</p>
        <a href="payment.php" class="checkout-button" onclick="saveCart()">Перейти к оплате</a>
    </div>

    <script>
        async function loadCartItems() {
            const response = await fetch('controllers/cart.php');
            const data = await response.json();

            const cartItemsContainer = document.getElementById('cart-items');
            cartItemsContainer.innerHTML = '';

            let totalPrice = 0;

            if (data.length === 0) {
                cartItemsContainer.innerHTML = `<p class="cart-empty">Ваша корзина пуста.</p>`;
                return;
            }

            data.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');

                totalPrice += item.price * item.quantity;

                cartItem.innerHTML = `
                    <div class="item-info">
                        <img src="${item.img}" alt="${item.name}">
                        <div>
                            <p class="item-name">${item.name}</p>
                            <p class="item-quantity">Количество: ${item.quantity}</p>
                        </div>
                    </div>
                    <div class="item-controls">
                        <p class="item-price">${item.price} ₽</p>
                    </div>
                `;
                cartItemsContainer.appendChild(cartItem);
            });

            document.getElementById('total-price').innerText = `Итоговая цена: ${totalPrice.toFixed(2)} ₽`;
        }

        loadCartItems();
    </script>
    <?php include('footer.php'); ?>
</body>

</html>