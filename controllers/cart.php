<?php
include (SITE_ROOT . '/db/db.php');

// Получение ID текущего пользователя из сессии (например, id_user)
$id_user = $_SESSION['id'];
$error_msg = '';

// Проверка существования корзины для данного пользователя
$shopping_cart = selectOne('shopping_cart', ['id_pa' => $id_user]);

// Получение товаров в корзине
$id_sc = $shopping_cart['id_sc'];
$products_in_cart = selectAll('product_shop_cart', ['id_sc' => $id_sc]);

// Добавление информации о каждом товаре
$products = [];
foreach ($products_in_cart as $product_in_cart) {
    $product = selectOne('product', ['id_product' => $product_in_cart['id_product']]);
    $products[] = [
        'name' => $product['name'],
        'price' => $product['price'],
        'quantity' => $product_in_cart['id_product'], // количество товаров
        'img' => $product['img']
    ];
}

// Возврат JSON-ответа
echo json_encode($products);