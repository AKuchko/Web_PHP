<?php
session_start();
if ($_SESSION['user']['id']) {
    header('Location: /');
}
require_once('templates/head.php'); 
?>
<body class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh">
    <h1 class="mb-5">Reset password</h1>
    <form style="width: 33%;" action="vendor/mailer/send_mail.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <button type="submit" class="btn btn-primary w-100 my-3">Login</button>
        <div class="d-flex">
            <a href="login.php">Login</a>
            <a class="ml-auto" href="register.php">Register.</a>
        </div>
        <?php 
            if ($_SESSION['error']) {
                echo '<div class="alert alert-danger mt-3 w-100" role="alert">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            if ($_SESSION['message']) {
                echo '    <div class="alert alert-success mt-3 w-100" role="alert">' . $_SESSION['message'] . '</div>';
                unset($_SESSION['message']);
            }
        ?>
    </form>
</body>
</html>