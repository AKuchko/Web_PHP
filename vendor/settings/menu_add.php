<?php
session_start();
require_once('../database/connect.php');

$MENU_NAME  = $_POST['name'];
$MENU_LINK  = $_POST['link'];
$USER_ID    = $_SESSION['user']['id'];

if (!$MENU_NAME || !$MENU_LINK) {
    $_SESSION['error'] = 'Fill all field.';
    header('Location: ../../index.php?page=settings');
}
else {
    $current_list   = $_SESSION['user']['menu'];
    $new_item       = ['name' => $MENU_NAME, 'link' => $MENU_LINK, 'position' => count($current_list) + 1, 'immutable' => false];

    array_push($current_list, $new_item);

    $MENU_STR       = json_encode($current_list);
    
    mysqli_query($connect, "UPDATE `user` SET `user_menu` = '$MENU_STR' WHERE `id` = '$USER_ID'");

    $_SESSION['user']['menu']   = $current_list;
    $_SESSION['message']        = 'Successful added.';

    header('Location: ../../index.php?page=settings');
}