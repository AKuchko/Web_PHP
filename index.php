<?php 
session_start();
if (!$_SESSION['user']['id']) {
    header('Location: login.php');
}
require_once('templates/head.php');

$PAGE = $_GET['page'];
if (!$PAGE)
    $PAGE = 'home';
?>
<body>
    <?php require_once('templates/header.php'); ?>
    <main style="margin: 100px 40px; min-height: calc(100vh - 300px);">
        <?php if (isset($_GET['page'])) require_once("views/$PAGE.php") ?>
    </main>
    <?php require_once('templates/footer.php'); ?>
</body>
</html>