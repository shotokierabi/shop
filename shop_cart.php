<?php
include('path.php');
session_start();

// Инициализация корзины, если её нет
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Обновление количества товара
if (isset($_POST['update_quantity'])) {
    $id = $_POST['id'];
    $quantity = max(1, (int)$_POST['quantity']); // Минимум 1

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $id) {
            $item['quantity'] = $quantity;
            break;
        }
    }
    unset($item); // Разорвать ссылку на последний элемент
}

// Удаление товара из корзины
if (isset($_POST['remove'])) {
    $id = $_POST['remove'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($id) {
        return $item['id'] != $id;
    });
}

// Очистка корзины
if (isset($_POST['clear'])) {
    $_SESSION['cart'] = [];
}

// Рассчет итоговой суммы
$total = array_reduce($_SESSION['cart'], function ($sum, $item) {
    return $sum + $item['price'] * $item['quantity'];
}, 0);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="style_a.css">
</head>

<body>
<?php include('header.php'); ?>

<div class="container">
    <h1>Корзина</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>Ваша корзина пуста</p>
    <?php else: ?>
        <div class="cart-items">
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="cart-item">
                    <img src="<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="cart-item-img">
                    <div class="cart-item-details">
                        <h2><?= htmlspecialchars($item['name']) ?></h2>
                        <form method="post" class="update-quantity-form">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <label>
                                Количество:
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1">
                            </label>
                            <button type="submit" name="update_quantity">Обновить</button>
                        </form>
                        <p>Цена: <?= $item['price'] * $item['quantity'] ?> ₽</p>
                        <form method="post">
                            <button type="submit" name="remove" value="<?= $item['id'] ?>">Удалить</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary">
            <p><strong>Итого:</strong> <?= $total ?> ₽</p>
            <button class="checkout-btn" onclick="alert('Функция оплаты пока не реализована')">Оплатить</button>
        </div>
        <form method="post">
            <button type="submit" name="clear" class="clear-cart-btn">Очистить корзину</button>
        </form>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>
</body>

</html>
