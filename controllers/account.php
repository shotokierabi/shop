<?php
include (SITE_ROOT . '/db/db.php');
include('path.php');
if (!$_SESSION) {
    header('location: ' . BASE_URL . '/login.php');
} 

$error_msg = [];
$id = '';
$id_session = $_SESSION['id'];

$UserAll = selectAll('personal_account');

//Редактирование профиля
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $pa = selectOne('personal_account', ['id_pa' => $id]);
    $id = $pa['id_pa'];
    $email = $pa['email'];
    $phone_number = $pa['phone_number'];
    $surname = $pa['surname'];
    $name = $pa['name'];
    $img = $pa['img'];
    $address = $pa['address'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_acc'])) {

    if (!empty($_FILES['img']['name'])) {
        $img_name = trim(trim(time()) . '_' . $_FILES['img']['name']);
        $fileTMPName = $_FILES['img']['tmp_name'];
        $destination = ROOT_PATH . "\img\avatar\\" . $img_name;

        if (move_uploaded_file($fileTMPName, $destination)) {
            $_POST['img'] = trim($img_name);
        } else {
            array_push($error_msg, 'Ошибка загрузки изображения на сервер!');
        }
    } else {
        $img_name = trim('ava.png');
        $_POST['img'] = trim($img_name);
    }

    $id = $_POST['id'];
    $pa = selectOne('personal_account', ['id_pa' => $id]);
    $id = $pa['id_pa'];
    $id_user = $pa['id_user'];
    $user = selectOne('user', ['id_user' => $id_user]);

    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $surname = trim($_POST['surname']);
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $salt = $user['salt'];
    $password = $user['password'];


    if ($name === '') {
        array_push($error_msg, "Не все поля заполнены!");
    } elseif (mb_strlen($name, 'UTF8') < 2) {
        array_push($error_msg, "Имя должно быть длинее одного символа!");
    } else {
        $existence = selectOne('user', ['login' => $email]);
        
        if ($existence['login'] === $email && $existence['id_user'] !== $id_user) {
            array_push($error_msg, "Пользователь с такой почтой уже зарегистрирован!");
        } else {
            $post = [
                'login' => $email,
                'password' => $password,
                'salt' => $salt
            ];

            update('user', 'id_user', $id_user, $post);

            $post_pa = [
                'id_user' => $id_user,
                'email' => $email,
                'phone_number' => $phone_number,
                'surname' => $surname,
                'name' => $name,
                'img' => trim($_POST[TRIM('img')]),
                'address' => $address
            ];

            update('personal_account', 'id_pa', $id, $post_pa);
            header('location: ' . BASE_URL . 'personal_account.php');
        }
    }
}

//Редактирование пароля
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_pass'])) {
    $id = $_SESSION['id'];
    $user = selectOne('user', ['id_user' => $id]);

    $email = $user['login'];
    $password = $user['password'];

    $password_old = trim($_POST['password_old']);
    $password_new = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);

    if ($password_old === '' || $password_new === '' || $password_confirm === '') {
        array_push($error_msg, "Не все поля заполнены!");
    } elseif ($password_new !== $password_confirm) {
        array_push($error_msg, "Новый и проверочный пороли не совпадают!");
    } elseif ($password_new === $password_old) {
        array_push($error_msg, "Старый и новый пароли совпадают!");
    } else {
        $existence = selectOne('user', ['login' => $email]);
        if ($existence && trim($existence['password']) === md5(md5($password_old) . trim($existence['salt']))) {
            $salt = salt();
            $password_new = trim(md5(md5($password_new) . $salt));
            $post = [
                'login' => $email,
                'password' => $password_new,
                'salt' => $salt
            ];

            update('user', 'id_user', $id, $post);
            header('location: ' . BASE_URL . 'personal_account.php');

        } else {
            array_push($error_msg, "Что-то пошло не так!");
        }
    }
}

//Удаление
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    deleteAll('personal_account', 'id_pa', $id);
    header('location: ' . BASE_URL . 'logout.php');
}