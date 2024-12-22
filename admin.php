<?php include('path.php');
include('controllers/admin.php'); ?>

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
        <div class="container1">
            <div class="personal_account row">
                <div class="col1">
                    <div class="row justify-content-between head">
                        <div class="col but"><a class="button btn" href="<?php echo BASE_URL . '/admin_cotegory.php' ?>"
                                role="button">Категории</a>
                        </div>
                    </div>
                </div>
                <div class="col2">
                    <div class="row50">
                        <div>
                            <h5>Товары</h5>
                        </div>
                        <div class="adbut">
                            <div class="col but">
                            <a class="button btn"
                                href="<?php echo BASE_URL . 'new_prod.php' ?>"
                                role="button">Добавить товар</a>   
                            </div>
                        </div>
                    </div>
                    <div class="prod_body">
                        <div class="rowProd">
                            <div class="col-1">ID</div>
                            <div class="col-2">Название</div>
                            <div class="col-2">Цена</div>
                            <div class="col-2">Скидка</div>
                            <div class="col-2">Вес</div>
                            <div class="col-2">Редактировать</div>
                            <div class="col-end">Удалить</div>
                        </div>
                    </div>
                    <?php foreach ($prodAll as $key => $p): ?>
                        <div class="rowProd1">
                            <div class="col-1"><?= $p['id_product']; ?></div>
                            <div class="col-2 fname_category"><?= $p['name']; ?></div>
                            <div class="col-2 name_category"><?= $p['price']; ?></div>
                            <div class="col-2 lname_category"><?= $p['sale']; ?></div>
                            <div class="col-2 email-category"><?= $p['weight']; ?></div>
                            <div class="col-2 edit_category"><a
                                    href="edit_prod.php?id=<?= $p['id_product']; ?>">Редактировать</a></div>
                            <div class="col-end del_category"><a href="admin.php?del_id=<?= $p['id_product']; ?>">Удалить</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
</body>

</html>