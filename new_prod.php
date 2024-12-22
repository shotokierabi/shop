<?php include('path.php');
include('controllers/new.php'); ?>

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
        <div class="container1 admin">
            <div class="personal_account row">
                <div class="col1">
                    <div class="col but">
                        <a class="button btn" href="<?php echo BASE_URL . 'admin.php' ?>" role="button"><i
                                class="fa-solid fa-chevron-left"></i> Вернуться к списку товаров</a>
                    </div>
                </div>
                <div class="col2_2">
                    <form class="form" action="new_prod.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <h5>Новый товар</h5>
                        <div class="massage error">
                            <?php include('ErrorInfo.php'); ?>
                        </div>
                        <div class="col">
                            <div class="col3">
                                <span class="text-1">Название:</span>
                            </div>
                            <input type="text" class="form-control" name="name" value="<?= $name ?>">
                        </div>
                        <div class="row_admin">
                            <div class="col">
                                <div class="col3">
                                    <span class="text-1"> Цена:</span>
                                </div>
                                <input type="text" class="form-control" name="price" value="<?= $price ?>">
                            </div>
                            <div class="col"></div>
                            <div class="col">
                                <div class="col3">
                                    <span class="text-1">Скидка:</span>
                                </div>
                                <input type="text" class="form-control" name="sale" value="<?= $sale ?>">
                            </div>
                            <div class="col"></div>
                            <div class="col">
                                <div class="col3">
                                    <span class="text-1">Вес:</span>
                                </div>
                                <input type="text" class="form-control" name="weight" value="<?= $weight ?>">
                            </div>
                            <div class="col"></div>
                            <div class="col">
                                <div class="col3">
                                    <span class="text-1">Рейтинг:</span>
                                </div>
                                <input type="text" class="form-control" name="rating" value="<?= $rating ?>">
                            </div>
                        </div>
                        <div class="row1">
                            <div class="col">
                                <div class="col3">
                                    <span class="text-1">Производитель:</span>
                                </div> <input type="text" class="form-control" name="manufacturer"
                                    value="<?= $manufacturer ?>">
                            </div>
                            <div class="col"></div>
                            <div class="col">
                                <div class="col3">
                                    <span class="text-1">Срок хранения:</span>
                                </div>
                                <input type="text" class="form-control" name="expiration_date"
                                    value="<?= $expiration_date ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="col3">
                                <span class="text-1">Состав:</span>
                            </div>
                            <textarea name="structure" type="text" class="form-control" rows="10" cols="155"
                                id="exampleInputDop"><?= $structure ?></textarea>
                        </div>
                        <div class="col">
                            <div class="col3">
                                <span class="text-1">Описание:</span>
                            </div>
                            <textarea name="descriptions" type="text" class="form-control" rows="10" cols="155"
                                id="exampleInputDop"><?= $descriptions ?></textarea>
                        </div>
                        <div class="col">
                            <div class="col3">
                                <span class="text-1">Изображение:</span>
                            </div>
                            <input class="form-control" type="file" id="formFile" accept="img/*" name="img"
                                value="<?= $img ?>">
                        </div>
                        <div class="col but">
                            <button class="button btn" name="new_prod" type="submit">Сохранить
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