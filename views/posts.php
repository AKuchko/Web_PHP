<?php
require_once('vendor/database/connect.php');
require_once('vendor/gallery_logic/render_posts.php');
?>
<div class="d-flex">
    <div class="d-flex flex-column flex-shrink-0 sticky-top p-3 bg-light h-100" style="width: 280px; top: 108px; z-index: 0;">
        <span class="fs-4 text-center">Actions</span>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <button class="btn btn-primary w-100" aria-current="page" data-toggle="modal" data-target="#myModal">Add</button>
            </li>
            <li class="nav-item">
                <form class="my-2 my-lg-0 d-flex flex-column" action="../vendor/gallery_logic/search_posts.php" method="post">
                    <div class="my-2 d-flex">
                        <input class="form-control mr-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="find">Search</button>
                    </div>
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="reset">Reset</button>
                </form>
            </li>
        </ul>
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
    </div>
    <div>
        <ul class="d-inline-flex flex-wrap p-0">
            <?php while ($row = mysqli_fetch_array($LIMITED_USER_POSTS)): ?>
                <li class="card m-2" style="width: 18rem; height: 450px;">
                    <div style="height: 200px;">
                        <img class="card-img-top h-100" style="object-fit: contain;" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['watermark_image']) ?>" alt="Card image cap">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $row['name'] ?></h5>
                        <p class="card-text" style="overflow: hidden; max-height: 50px;"><?= $row['subscription'] ?></p>
                        <a href="index.php?page=post&post=<?= $row['id'] ?>" class="btn btn-primary" style="margin-top: auto;">Go somewhere</a>
                        <form action="../vendor/gallery_logic/delete_post.php" method="post">
                            <input class="d-none" type="text" value="<?= $row['id'] ?>" name="delete">
                            <button class="btn btn-outline-danger w-100 mt-1">Delete</button>
                        </form>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
        <nav class="pl-2">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="index.php?page=posts&gallery_page=<?php if ($_GET['gallery_page'] > 1) echo $_GET['gallery_page'] - 1; else echo 1?>">Previous</a>
                </li>
                <?php for ($page = 1; $page <= $page_count; $page++): ?>
                    <li class="page-item"><a class="page-link" href="index.php?page=posts&gallery_page=<?= $page ?>"><?= $page ?></a></li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=posts&gallery_page=<?php if ($_GET['gallery_page'] < $page_count) echo $_GET['gallery_page'] + 1; else echo $page_count?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <form action="../vendor/gallery_logic/gallery_post_create.php" method="post" enctype="multipart/form-data" class="w-100">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Label</label>
                        <input type="text" class="form-control" name="label" placeholder="Enter label">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <input type="text" class="form-control" name="desc" placeholder="Enter description">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Choose image</label>
                        <input class="form-control" type="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 my-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>