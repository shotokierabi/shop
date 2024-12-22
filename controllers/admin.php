<?php
include(SITE_ROOT . '/db/db.php');
if (!$_SESSION) {
    header('location: ' . BASE_URL . 'login.php');
}

$prodAll = selectAll('product');
$error_msg = [];

//Редактирование товара
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $prod = selectOne('product', ['id_product' => $id]);
    $id = $prod['id_product'];
    $name = $prod['name'];
    $price = $prod['price'];
    $sale = $prod['sale'];
    $weight = $prod['weight'];
    $structure = $prod['structure'];
    $manufacturer = $prod['manufacturer'];
    $descriptions = $prod['descriptions'];
    $expiration_date = $prod['expiration_date'];
    $img = $prod['img'];
    $rating = $prod['rating'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_prod'])) {


    $id = $_POST['id'];
    $prod = selectOne('product', ['id_product' => $id]);
    $id = $prod['id_product'];

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
        'id_product' => $id,
        'name' => $name,
        'price' => $price,
        'sale' => $sale,
        'weight' => $weight,
        'structure' => $structure,
        'manufacturer' => $manufacturer,
        'descriptions' => $descriptions,
        'expiration_date' => $expiration_date,
        'img' => $_POST['img'],
        'rating' => $rating
    ];

    update('product', 'id_product', $id, $post);
    header('location: ' . BASE_URL . 'admin.php');
}

//Удаление 
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {

    $id = $_GET['del_id'];
    $prod = selectOne('product', ['id_product' => $id]);
    $id = $prod['id_product'];

    deleteAll('product', 'id_product', $id);
    header('location: ' . BASE_URL . 'admin.php');

}
