<?php
include(SITE_ROOT . '/db/db.php');
if (!$_SESSION) {
    header('location: ' . BASE_URL . 'login.php');
}

$prodAll = selectAll('product');
$error_msg = [];

//Добавление
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_prod'])) {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $sale = trim($_POST['sale']);
    $weight = trim($_POST['weight']);
    $structure = trim($_POST['structure']);
    $manufacturer = trim($_POST['manufacturer']);
    $descriptions = trim($_POST['descriptions']);
    $expiration_date = trim($_POST['expiration_date']);
    $rating = trim($_POST['rating']);

    if (!empty($_FILES['img']['name'])) {
        $img_name = trim(trim(time()) . '_' . $_FILES['img']['name']);
        $fileTMPName = $_FILES['img']['tmp_name'];
        $destination = ROOT_PATH . "\img\\" . $img_name;

        if (move_uploaded_file($fileTMPName, $destination)) {
            $_POST['img'] = trim($img_name);
        } else {
            array_push($error_msg, 'Ошибка загрузки изображения на сервер!');
        }
    } else {
        $img_name = trim('prod.png');
        $_POST['img'] = trim($img_name);
    }


    $post = [
        'name' => $name,
        'price' => $price,
        'sale' => $sale,
        'weight' => $weight,
        'structure' => $structure,
        'manufacturer' => $manufacturer,
        'descriptions' => $descriptions,
        'expiration_date' => $expiration_date,
        'img' => trim($_POST[TRIM('img')]),
        'rating' => $rating
    ];

    insert('product', $post);
    header('location: ' . BASE_URL . 'admin.php');

} else {
    $name = '';
    $price = '';
    $sale = '';
    $weight = '';
    $structure = '';
    $manufacturer = '';
    $descriptions = '';
    $expiration_date = '';
    $rating = '';

}