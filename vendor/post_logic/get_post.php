<?php
require_once('./vendor/auth/user_info.php');
if (isset($_GET['post']))
$POST_ID = $_GET['post'];
$USER_ID = $_SESSION['user']['id'];
$SELECTED_POST = mysqli_query($connect, "SELECT * FROM `gallery` WHERE `user_id` = '$USER_ID' AND `id` = '$POST_ID'");
$POST_INFO = mysqli_fetch_assoc($SELECTED_POST);