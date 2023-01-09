<?php
session_start();

require_once('../database/connect.php');

$POST_NAME = $_POST['label'];
$POST_DESCRIPTION = $_POST['desc'];
$POST_IMAGE = $_FILES['file'];
$USER_ID = $_SESSION['user']['id'];

if (!$POST_NAME || !$POST_DESCRIPTION || !$POST_IMAGE['name']) {
    $_SESSION['error'] = 'Fill all fields';
    header('Location: ../../index.php?page=gallery');
}
else if (!in_array(pathinfo($POST_IMAGE['name'], PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg'])) {
    $_SESSION['error'] = 'Incorrect file';
    header('Location: ../../index.php?page=gallery');
}
else {
    // Watermark
    move_uploaded_file($POST_IMAGE['tmp_name'], 'origin.png');

    if (in_array(pathinfo($POST_IMAGE['name'], PATHINFO_EXTENSION), ['jpeg', 'jpg', 'JPEG', 'JPG'])) {
        $origin_obj = imagecreatefromjpeg('origin.png');
    }
    else if (in_array(pathinfo($POST_IMAGE['name'], PATHINFO_EXTENSION), ['png', 'PNG'])) {
        $origin_obj = imagecreatefrompng('origin.png');
    }

    $watermark = imagecreatefrompng('../../assets/images/coin.png');

    $margin_r = 20;
    $margin_b = 20;

    $watermark_width = imagesx($watermark);
    $watermark_height = imagesy($watermark);

    $destination_x = imagesx($origin_obj) - $watermark_width;
    $destination_y = imagesy($origin_obj) - $watermark_height;

    imagecopy($origin_obj,  $watermark, $destination_x, $destination_y, 0, 0, $watermark_width, $watermark_height);
    imagepng($origin_obj, 'output.png');
    imagedestroy($origin_obj);
    imagedestroy($watermark);
    
    $FILE_CONTENT_ORIGIN = addslashes(file_get_contents('origin.png'));
    $FILE_CONTENT_WATERMARK = addslashes(file_get_contents('output.png'));

    mysqli_query($connect, "INSERT INTO `gallery` (`id`, `user_id`, `name`, `subscription`, `image`, `watermark_image`) 
    VALUES (NULL, '$USER_ID', '$POST_NAME', '$POST_DESCRIPTION', '$FILE_CONTENT_ORIGIN', '$FILE_CONTENT_WATERMARK')");

    unlink('output.png');
    unlink('origin.png');

    header('Location: ../../index.php?page=posts');
}
?>