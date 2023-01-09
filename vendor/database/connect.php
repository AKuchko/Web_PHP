<?php
$DB_USER = 'webuser';
$DB_PASS = 'pass';
$DB_NAME = 'web';

$connect = mysqli_connect('127.0.0.1', $DB_USER, $DB_PASS, $DB_NAME);

if (!$connect) {
    die('Error; db');
}