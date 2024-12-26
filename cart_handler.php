<?php
session_start();

// Инициализация корзины
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Получение данных из запроса
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $id = $data['id'];
    $name = $data['name'];
    $price = $data['price'];
    $img = $data['img'];

    // Проверка, есть ли товар в корзине
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $id) {
            $item['quantity'] += 1; // Увеличиваем количество
            $found = true;
            break;
        }
    }

    // Если товар не найден, добавляем новый
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'img' => $img,
            'quantity' => 1, // Начальное количество
        ];
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Некорректные данные']);
}
?>
