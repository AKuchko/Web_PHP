<?php
session_start();
require_once('../database/connect.php');
require_once('./user_info.php');

$USER_NAME              = mysqli_real_escape_string($connect, $_POST['nickname']);
$USER_EMAIL             = mysqli_real_escape_string($connect, $_POST['email']);
$USER_PASSWORD          = mysqli_real_escape_string($connect, $_POST['password']);
$USER_PASSWORD_CONFIRM  = mysqli_real_escape_string($connect, $_POST['repeat_password']);

if (!$USER_NAME || !$USER_EMAIL || !$USER_PASSWORD || !$USER_PASSWORD_CONFIRM) {
    $_SESSION['error'] = 'Fill all fields';
    header('Location: ../../register.php');
}

else if ($USER_PASSWORD != $USER_PASSWORD_CONFIRM) {
    $_SESSION['error'] = 'Passwords do not match';
    header('Location: ../../register.php');
}

else {
    $USER_PASSWORD = md5($USER_PASSWORD);
    $DEFAULT_MENU = json_encode([
        1 => ['name' => 'Home', 'link' => 'index.php?page=home', 'position' => 1, 'immutable' => true],
        2 => ['name' => 'Posts', 'link' => 'index.php?page=posts', 'position' => 2, 'immutable' => true],
        3 => ['name' => 'Settings', 'link' => 'index.php?page=settings', 'position' => 3, 'immutable' => true],
        4 => ['name' => 'Disabled', 'link' => '#', 'position' => 4, 'immutable' => false],
    ]);
    mysqli_query($connect, "INSERT INTO `user` (`id`, `email`, `password`, `name`, `user_menu`) 
                            VALUES (NULL, '$USER_EMAIL', '$USER_PASSWORD', '$USER_NAME', '$DEFAULT_MENU')");
    
    $_SESSION['message'] = 'Successfully registered!';
    header('Location: ../../login.php');
}