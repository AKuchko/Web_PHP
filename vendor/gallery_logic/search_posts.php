<?php
session_start();

$DESIRED_VALUE = $_POST['search'];

if (array_key_exists('find', $_POST)) {
    if (!$DESIRED_VALUE) {
        $_SESSION['error'] = 'Type something...';
        header('Location: ../../index.php?page=posts');
    }
    $_SESSION['sort_value'] = $DESIRED_VALUE;
}
if (array_key_exists('reset', $_POST))
    unset($_SESSION['sort_value']);

header('Location: ../../index.php?page=posts');   
?>