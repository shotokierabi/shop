<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['index'])) {
    $productIndex = $_POST['index'];
    $_SESSION['cart'][] = [
        'id' => $productIndex,
        'name' => "Товар $productIndex",
        'price' => 500,
        'quantity' => 1
    ];
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            width: 1360px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
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
        .item-quantity {
            font-size: 16px;
        }
        .total-price {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
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
    <div class="container">
        <h1>Корзина</h1>
        <div id="cart-items">
        </div>
        <p class="total-price">Итоговая цена: <span id="total-price">0</span> ₽</p>
        <a href="Оплата.html" class="checkout-button" onclick="saveCart()">Перейти к оплате</a>
    </div>

    <script>
        const cart = {
            items: []
        };

        <?php
        if (isset($_SESSION['cart'])):
            foreach ($_SESSION['cart'] as $item):
        ?>
            cart.items.push({
                id: <?php echo $item['id']; ?>,
                name: "<?php echo $item['name']; ?>",
                price: <?php echo $item['price']; ?>, 
                quantity: <?php echo $item['quantity']; ?>
            });
        <?php endforeach; endif; ?>

        function updateTotalPrice() {
            let total = 0;
            cart.items.forEach(item => {
                total += item.price * item.quantity;
            });
            document.getElementById('total-price').innerText = total;
        }

        function renderCart() {
            const cartItemsContainer = document.getElementById('cart-items');
            cartItemsContainer.innerHTML = '';

            cart.items.forEach(item => {
                const cartItemElement = document.createElement('div');
                cartItemElement.classList.add('cart-item');
                cartItemElement.dataset.id = item.id;
                cartItemElement.innerHTML = `
                    <div class="item-info">
                        <img src="product${item.id}.jpg" alt="Товар ${item.id}">
                        <p class="item-name">${item.name}</p>
                    </div>
                    <div class="item-controls">
                        <button onclick="decreaseQuantity(${item.id})">-</button>
                        <span class="item-quantity" id="quantity-${item.id}">${item.quantity}</span>
                        <button onclick="increaseQuantity(${item.id})">+</button>
                        <button onclick="removeItem(${item.id})">Удалить</button>
                    </div>
                `;
                cartItemsContainer.appendChild(cartItemElement);
            });
        }

        function increaseQuantity(id) {
            const item = cart.items.find(item => item.id === id);
            if (item) item.quantity++;
            document.getElementById(`quantity-${id}`).innerText = item.quantity;
            updateTotalPrice();
        }

        function decreaseQuantity(id) {
            const item = cart.items.find(item => item.id === id);
            if (item && item.quantity > 1) item.quantity--;
            document.getElementById(`quantity-${id}`).innerText = item.quantity;
            updateTotalPrice();
        }

        function removeItem(id) {
            const index = cart.items.findIndex(item => item.id === id);
            if (index > -1) {
                cart.items.splice(index, 1);
                document.querySelector(`.cart-item[data-id="${id}"]`).remove();
            }
            updateTotalPrice();
        }

        function saveCart() {
            const cartData = cart.items.map(item => ({
                id: item.id,
                name: item.name,
                price: item.price,
                quantity: item.quantity,
            }));
            localStorage.setItem('cart', JSON.stringify(cartData));
        }

        renderCart();
        updateTotalPrice();
    </script>
</body>
</html>
