<?php 
session_start();
require_once('../database/connect.php');

function cmp($a, $b)
{
    return(ord($a['position']) - ord($b['position']));
}

$MENU_NAME      = $_POST['name'];
$MENU_LINK      = $_POST['link'];
$MENU_POSITION  = $_POST['position'];
$MENU_ROW       = $_POST['row'];
$USER_ID        = $_SESSION['user']['id'];
$TAKEN_POSITION = [];
$current_list   = $_SESSION['user']['menu'];

// foreach ($_SESSION['user']['menu'] as $list => $value)
//     array_push($TAKEN_POSITION, $value['position']);

if (!$MENU_NAME || !$MENU_LINK || !$MENU_POSITION) {
    $_SESSION['error'] = 'Fill all field.';
    header('Location: ../../index.php?page=settings');
}
else if (!$MENU_NAME || !$MENU_LINK || !$MENU_POSITION) {
    $_SESSION['error'] = 'Fill all field.';
    header('Location: ../../index.php?page=settings');
}
// else if (in_array($MENU_POSITION, $TAKEN_POSITION)){
//     $_SESSION['error'] = 'This position has already been taken.';
//     header('Location: ../../index.php?page=settings');
// }
else if (!is_numeric($MENU_POSITION)) {
    $_SESSION['error'] = 'Enter a number in the "position" field.';
    header('Location: ../../index.php?page=settings');
} 

else {
    if (array_key_exists('delete' ,$_POST)) {    
        foreach ($current_list as $row => $value) {
            if ($value['name'] = $MENU_NAME && $value['position'] == $MENU_POSITION)
                unset($current_list[$row]);
        }
        $msg = 'deleted';
    }

    if (array_key_exists('change' ,$_POST)) {
        $current_list[$MENU_ROW] = ['name' => $MENU_NAME, 'link' => $MENU_LINK, 'position' => $MENU_POSITION, 'immutable' => false];
	    usort($current_list, 'cmp');
        $msg = 'updated';
    }

    $_SESSION['user']['menu']   = $current_list;
    $MENU_STR                   = json_encode($current_list);
    mysqli_query($connect, "UPDATE `user` SET `user_menu` = '$MENU_STR' WHERE `id` = '$USER_ID'");

    $_SESSION['message']        = 'Successful ' . $msg . ".";
    header('Location: ../../index.php?page=settings');
}
