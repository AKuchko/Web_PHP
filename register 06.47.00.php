<?php
session_start();
if ($_SESSION['user']['id']) {
    header('Location: /');
}
require_once('templates/head.php'); 
?>
<body class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh">
    <h1 class="mb-5">Register form</h1>
    <form style="width: 33%;" action="vendor/auth/signup.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="nickname" aria-describedby="emailHelp" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Repeat Password</label>
            <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary w-100 my-3">Submit</button>
        <a href="login.php">Already have an account?</a>
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