<?php
$USER_ID = $_SESSION['user']['id'];

if (isset($_GET['gallery_page'])) 
    $current_gall_page = $_GET['gallery_page'];
else
    $current_gall_page = 1;

$posts_limit = 10;
$start_post = ($current_gall_page - 1) * $posts_limit;


if ($_SESSION['sort_value']) {
    $USER_ID = $_SESSION['user']['id'];
    $value = $_SESSION['sort_value'];
    $ALL_USERS_POSTS = mysqli_query($connect, "SELECT * FROM `gallery` WHERE `user_id` = '$USER_ID' AND (`name` LIKE '%$value%' OR `subscription` LIKE '%$value%')");
    $LIMITED_USER_POSTS = mysqli_query($connect, "SELECT * FROM `gallery` WHERE `user_id` = '$USER_ID' AND (`name` LIKE '%$value%' OR `subscription` LIKE '%$value%') LIMIT " . $start_post . " , " . $posts_limit);
}
else {
    $ALL_USERS_POSTS = mysqli_query($connect, "SELECT * FROM `gallery` WHERE `user_id` = '$USER_ID'");
    $LIMITED_USER_POSTS = mysqli_query($connect, "SELECT * FROM `gallery` WHERE `user_id` = '$USER_ID' LIMIT " . $start_post . " , " . $posts_limit);
}

$posts_count = mysqli_num_rows($ALL_USERS_POSTS);
$page_count = ceil($posts_count / $posts_limit);

if ($current_gall_page < 1)
    $current_gall_page = 1;
else if ($current_gall_page > $page_count)
    $current_gall_page = $page_count;