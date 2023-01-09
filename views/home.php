<?php $USER_NAME = $_SESSION['user']['name'] ?>
<div>
    <h1>Welcome back <?= $USER_NAME ?>!</h1>
    <a href="vendor/auth/logout.php">Logout</a>
</div>