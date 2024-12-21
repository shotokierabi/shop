<?php if (count($error_msg) > 0): ?>
    <?php foreach ($error_msg as $error): ?>
        <li><?= $error; ?></li>
    <?php endforeach; ?>
<?php endif ?>