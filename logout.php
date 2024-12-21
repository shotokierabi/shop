<?php
session_start();

include('path.php');

unset($_SESSION['id']);
unset($_SESSION['firstName']);
unset($_SESSION['user_mode']);
unset($_SESSION['admin']);

header('location: ' . BASE_URL);