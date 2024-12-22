<?php
include(SITE_ROOT . '/db/db.php');

// Получение данных заказа из POST-запроса
$id_user = $_SESSION['id'];
$address = $_POST['address'];
$delivery_time = $_POST['delivery_time'];
$payment_method = $_POST['payment_method'];

// Проверка корзины пользователя
$shopping_cart = selectOne('shopping_cart', ['id_pa' => $id_user]);


// Создание записи доставки
$delivery_id = insert('delivery', [
    'id_sc' => $shopping_cart['id_sc'],
    'address' => $address,
    'time' => $delivery_time
]);

$final_prices_new = 0;

$final_prices = [
    'id_pa' => $id_user,
    'final_prices' => $final_prices_new
];

// Обновление статуса корзины (например, подтверждение)
update('shopping_cart', 'id_sc', $shopping_cart['id_sc'], $final_prices);

echo json_encode(['success' => 'Заказ успешно подтвержден.']);