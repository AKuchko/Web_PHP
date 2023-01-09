<?php
require_once('../database/connect.php');

$id = $_POST['delete'];
mysqli_query($connect, "DELETE FROM `web`.`gallery` WHERE `id` = '$id'");
header('Location: ../../index.php?page=posts');
?>