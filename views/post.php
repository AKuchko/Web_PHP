<?php
require_once('./vendor/database/connect.php');
require_once('./vendor/post_logic/get_post.php');
?>

<div class="card mb-3">
    <div style="height: 500px;">
        <img class="card-img-top" style="object-fit: contain ;height: 100%" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($POST_INFO['image']) ?>" alt="Card image cap">
    </div>
    <div class="card-body">
        <h5 class="card-title"><?= $POST_INFO['name'] ?></h5>
        <p class="card-text"><?= $POST_INFO['subscription'] ?></p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
</div>
