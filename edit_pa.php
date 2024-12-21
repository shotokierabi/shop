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
        <div class="container personal-acc">
            <div class="personal_account row">
                <div class="col1">
                    <div class="col but">
                        <a class="button btn" href="<?php echo BASE_URL . 'personal_account.php' ?>" role="button"><i
                                class="fa-solid fa-chevron-left"></i> Вернуться
                            в личный кабинет</a>
                    </div>
                </div>
                <div class="col2_2">
                    <form class="form" action="edit_pa.php" method="post">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <h5>Личный кабинет</h5>
                        <div class="massage error">
                            <?php include('ErrorInfo.php'); ?>
                        </div>
                        <div class="row1">
                            <div class="col">
                                <div class="col3">
                                    <span class="text-1"> Фамилия:</span>
                                </div>
                                <input type="text" class="form-control" name="surname" value="<?= $surname ?>">
                            </div>
                            <div class="col"></div>
                            <div class="col">
                                <div class="col3">
                                    <span class="text-1">Имя:</span>
                                </div>
                                <input type="text" class="form-control" name="name" value="<?= $name ?>">
                            </div>
                        </div>
                        <div class="row1">
                            <div class="col">
                                <div class="col3">
                                    <span class="text-1">Email:</span>
                                </div> <input type="email" class="form-control" name="email" value="<?= $email ?>">
                            </div>
                            <div class="col"></div>
                            <div class="col">
                                <div class="col3">
                                    <span class="text-1">Номер телефона:</span>
                                </div>
                                <input type="text" class="form-control" name="phone_number"
                                    value="<?= $phone_number ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="col3">
                                <span class="text-1">Адрес:</span>
                            </div>
                            <input type="text" class="form-control" name="address" value="<?= $address ?>">
                        </div>
                        <div class="col but">
                            <button class="button btn" name="edit_acc" type="submit">Сохранить
                                изменения</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>