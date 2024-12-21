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
            <h4>Регистрация</h4>
            <form class="form" method="post" action="reg.php">
                <?php if (empty($error_msg)): ?>
                <?php else: ?>
                    <div class="massage error">
                        <p><?= $error_msg ?></p>
                    </div>
                <?php endif ?>
                <div class="input">
                    <input type="text" class="form-control" placeholder="Имя" aria-label="name" name="name"
                        value="<?= $name ?>">
                </div>
                <div class="input">
                    <input type="email" class="form-control" placeholder="E-mail" id="example-login" name="login"
                        value="<?= $login ?>">
                </div>
                <div class="input">
                    <input type="password" class="form-control" placeholder="Пароль" id="example-password"
                        name="password">
                </div>
                <div class="input">
                    <input type="password" class="form-control" placeholder="Повторите пароль"
                        id="example-password-confirm" name="password_confirm">
                </div>
                <div class="btn-cnt">
                    <button type="submit" class="btn" name="submit-reg">Зарегистироваться</button>
                </div>
            </form>
            <P>Уже зарегистрированы? <a href="<?php echo BASE_URL . 'login.php' ?>">Войдите в систему</a>.</P>
        </div>
    </div>
</body>

</html>