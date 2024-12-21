<?php include('path.php');
include('controllers/users.php'); ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop</title>
    <link rel="stylesheet" href="style_a.css">
    <script src="https://kit.fontawesome.com/9454dd7c20.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="back-reg"></div>
    <div class="container reg-1">
        <div class="container reg-2">
            <div class="home">
                <a type="button" href="<?php echo BASE_URL ?>" aria-label="Закрыть"><i
                        class="fa-solid fa-xmark"></i></a>
            </div>
            <h4>Авторизация</h4>
            <form class="form" method="post" action="login.php">
                <?php if (empty($error_msg)): ?>
                <?php else: ?>
                    <div class="massage error">
                        <p><?= $error_msg ?></p>
                    </div>
                <?php endif ?>
                <div class="input">
                    <input type="email" class="form-control" placeholder="E-mail" id="example-login" name="login">
                </div>
                <div class="input">
                    <input type="password" class="form-control" placeholder="Пароль" id="example-password"
                        name="password">
                </div>
                <div class="btn-cnt">
                    <button type="submit" class="btn" name="submit-log">Войти</button>
                </div>
            </form>
            <P>Нет аккаунта? <a href="<?php echo BASE_URL . 'reg.php' ?>">Зарегестрируйтесь сейчас!</a></P>
        </div>
    </div>
</body>

</html>