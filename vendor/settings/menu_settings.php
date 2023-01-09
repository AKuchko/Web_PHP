<?php
require_once('./vendor/database/connect.php');

$USER_ID = $_SESSION['user']['id'];
$user_menu_query = "SELECT `user_menu` FROM `user` WHERE `id` = '$USER_ID'";
$menu_result = mysqli_query($connect, $user_menu_query);
$menu_string = mysqli_fetch_assoc($menu_result)['user_menu'];
$_SESSION['user']['menu'] = json_decode($menu_string, true);