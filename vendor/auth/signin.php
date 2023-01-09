<?php
session_start();
require_once('../database/connect.php');

$USER_EMAIL             = $_POST['email'];
$USER_PASSWORD          = md5($_POST['password']);

$candidate = mysqli_query($connect, "SELECT * FROM `user` WHERE `email` = '$USER_EMAIL' AND `password` = '$USER_PASSWORD'");

if (!$USER_EMAIL || !$USER_PASSWORD) {
    $_SESSION['error'] = 'Fill all fields';
    header('Location: ../../login.php');
}

else if (mysqli_num_rows($candidate) == 0) {
    $_SESSION['error'] = 'Wrong email or password';
    header('Location: ../../login.php');
}

else {
    $user = mysqli_fetch_assoc($candidate);

    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
    ];
    header('Location: ../../index.php?page=home');
}