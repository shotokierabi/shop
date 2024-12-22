<?php include('path.php');
include('controllers/account.php'); ?>

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
    <?php include('header.php'); ?>
    <!--MAIN-->
    <div class="container-fluid">
        <div class="container1 ">
            <?php foreach ($UserAll as $key => $u): ?>
                <?php if ($u['id_user'] === $_SESSION['id']): ?>
                    <div class="personal_account row">
                        <div class="col1">
                            <div class="col but">
                                <a class="button btn" href="edit_pa.php?id= <?= $u['id_pa'] ?>" role="button">Редактировать
                                    профиль</a>
                            </div>
                            <div class="col but">
                                <a class="button btn" href="pass.php?id= <?= $u['id_user'] ?>" role="button">Изменить
                                    пароль</a>
                            </div>
                            <div class="col but btn-del">
                                <a class="button btn-del" href="edit_pa.php?del_id= <?= $u['id_pa'] ?>" role="button">Удалить
                                    аккаунт</a>
                            </div>
                            <div class="col but">
                                <a class="button btn" href="<?php echo BASE_URL . 'logout.php' ?>" role="button">Выйти</a>
                            </div>
                        </div>
                        <div class="col2">
                            <h5>Личный кабинет</h5>
                            <div class="row2">
                                <div class="col2_1">
                                    <div class="avatar">
                                        <img src="<?= BASE_URL . 'img/avatar/' . trim($u['img']) ?>">
                                    </div>
                                </div>
                                <div class="col2_2">
                                    <div class="col">
                                         <h6><?= $u['surname'] ?> <?= $u['name'] ?></h6>
                                    </div>
                                    <div class="col">
                                        <span class="text-1">Email:</span> <?= $u['email'] ?>
                                    </div>
                                    <div class="col">
                                        <span class="text-1">Номер телефона:</span> <?= $u['phone_number'] ?>
                                    </div>
                                    <div class="col">
                                        <span class="text-1">Адрес:</span> <?= $u['address'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>