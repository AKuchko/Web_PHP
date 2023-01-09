<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['error']);
unset($_SESSION['message']);
header('Location: ../../login.php');