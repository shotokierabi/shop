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
    <div class="container-fluid">
        <div class="container">
            <div class="personal_account row">
                <div class="col1">
                    <div class="col but">
                        <a class="button btn" href="<?php echo BASE_URL . 'personal_account.php' ?>" role="button"><i
                                class="fa-solid fa-chevron-left"></i> Вернуться
                            в личный кабинет</a>
                    </div>
                </div>
                <div class="col2_2">
                    <form action="pass.php" method="post">
                        <input type="hidden" name="id" value="<?= $id; ?>">

                        <h5>Изменение пароля</h5>
                        <div class="massage error">
                            <?php include('ErrorInfo.php'); ?>
                        </div>
                        <div class="col">
                            <div class="col3">
                                <span class="text-1"> Старый пароль:</span>
                            </div>
                            <input type="password" class="form-control" placeholder="Старый пароль"
                                id="example-password" name="password_old">
                        </div>
                        <div class="col">
                            <div class="col3">
                                <span class="text-1">Новый пароль:</span>
                            </div>
                            <input type="password" class="form-control" placeholder="Новый пароль" id="example-password"
                                name="password">
                        </div>
                        <div class="col">
                            <div class="col3">
                                <span class="text-1">Повторите пароль:</span>
                            </div>
                            <input type="password" class="form-control" placeholder="Повторите новый пароль"
                                id="example-password" name="password_confirm">
                        </div>
                        <div class="col but">
                            <button class="button btn" name="edit_sudent_pass" type="submit">Сохранить
                                изменения</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>