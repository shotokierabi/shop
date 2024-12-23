<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

include('path/to/database/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    $productIndex = intval($_POST['id'] ?? 0);

    if ($action === 'increase') {
        $exists = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] === $productIndex) {
                $item['quantity']++;
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            $query = $db->prepare("SELECT id_product AS id, name, price FROM products WHERE id_product = ?");
            $query->execute([$productIndex]);
            $product = $query->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                $product['quantity'] = 1;
                $_SESSION['cart'][] = $product;
            }
        }
    } elseif ($action === 'decrease') {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] === $productIndex && $item['quantity'] > 1) {
                $item['quantity']--;
                break;
            }
        }
    } elseif ($action === 'delete') {
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productIndex) {
            return $item['id'] !== $productIndex;
        });
    }

    header('Content-Type: application/json');
    echo json_encode(['cart' => array_values($_SESSION['cart'])]);
    exit;
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
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .item-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .checkout-button {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Корзина</h1>
        <div id="cart-items"></div>
        <p class="total-price">Итого: <span id="total-price">0</span> ₽</p>
        <a href="Оплата.html" class="checkout-button">Перейти к оплате</a>
    </div>

    <script>
        const cartItemsContainer = document.getElementById('cart-items');
        const totalPriceElement = document.getElementById('total-price');

        function fetchCart() {
            fetch(location.href, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
                .then(response => response.json())
                .then(data => renderCart(data.cart))
                .catch(error => console.error('Ошибка загрузки корзины:', error));
        }

        function renderCart(cart) {
            cartItemsContainer.innerHTML = '';
            let total = 0;

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = '<p>Корзина пуста.</p>';
                totalPriceElement.innerText = 0;
                return;
            }

            cart.forEach(item => {
                total += item.price * item.quantity;
                const itemElement = document.createElement('div');
                itemElement.classList.add('cart-item');
                itemElement.dataset.id = item.id;
                itemElement.innerHTML = `
                    <div>
                        <p>${item.name}</p>
                        <p>${item.price} ₽</p>
                    </div>
                    <div class="item-controls">
                        <button onclick="updateQuantity(${item.id}, 'decrease')">-</button>
                        <span>${item.quantity}</span>
                        <button onclick="updateQuantity(${item.id}, 'increase')">+</button>
                        <button onclick="updateQuantity(${item.id}, 'delete')">Удалить</button>
                    </div>
                `;
                cartItemsContainer.appendChild(itemElement);
            });

            totalPriceElement.innerText = total;
}

        function updateQuantity(id, action) {
            const body = new URLSearchParams({ id, action }).toString();
            fetch(location.href, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body
            }).then(() => fetchCart());
        }

        fetchCart();

    </script>
</body>
</html>
