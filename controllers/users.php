<?php
include('db/db.php');

$error_msg = '';


function auth($user)
{
    $_SESSION['id'] = $user['id_user'];
    header('location: ' . BASE_URL . "personal_account.php");


}


//Регистрация
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-reg'])) {
    $name = trim($_POST['name']);
    $login = trim($_POST['login']);
    $salt = salt();
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);

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

    if ($name === '' || $login === '' || $password === '' || $password_confirm === '') {
        $error_msg = "Не все поля заполнены!";
    } elseif (mb_strlen($name, 'UTF8') < 2) {
        $error_msg = "Имя должно быть длинее одного символа!";
    } elseif ($password !== $password_confirm) {
        $error_msg = "Пароли не совпадают!";
    } else {
        $existence = selectOne('user', ['login' => $login]);
        if ($existence['login'] === $login) {
            $error_msg = "Пользователь с такой почтой уже зарегистрирован!";
        } else {
            $password = trim(md5(md5($password) . $salt));
            $post = [
                'login' => $login,
                'password' => $password,
                'salt' => $salt,
            ];

            $id = insert('user', $post);

            $post_pa = [
                'email' => $login,
                'phone_number' => '',
                'surname' => '',
                'name' => $name,
                'img' => $_POST['img'] = trim($img_name),
                'address' => '',

                'id_user' => $id
            ];

            insert('personal_account', $post_pa);
            $user = selectOne('user', ['id_user' => $id]);

            auth($user);
        }
    }


} else {
    $name = '';
    $login = '';
}

//Авторизация
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-log'])) {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if ($login === '' || $password === '') {
        $error_msg = "Не все поля заполнены!";
    } else {
        $existence = selectOne('user', ['login' => $login]);
        if ($existence && trim($existence['password']) === md5(md5($password) . trim($existence['salt']))) {
            auth($existence);
        } else {
            $error_msg = "Почта или пароль введены неверно!";
        }
    }

} else {
    $login = '';
}