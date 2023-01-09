<?php
require_once('vendor/settings/menu_settings.php');
require_once('./vendor/auth/user_info.php');
?>
<h1>Settings</h1>
<div class="d-flex mt-5 h-100">
    <div class="card">
        <div class="card-body text-center">
            <img src="https://www.nicepng.com/png/detail/115-1150821_default-avatar-comments-sign-in-icon-png.png" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?= $USER_NAME ?></h5>
            <p class="text-muted mb-1"><?= $USER_EMAIL ?></p>
        </div>
    </div>
    <div style="flex-grow: 1;">
        <div class="mx-5 text-left">
            <h5 class="mb-3">Menu settings</h5>
            <ul style="max-height: calc(100% - 510px); overflow: scroll;">
                <?php foreach ($_SESSION['user']['menu'] as $row => $menu_item): ?>
                    <li>
                        <?php if (!$menu_item['immutable']): ?>
                            <form action="../vendor/settings/menu_update.php" method="post" class="d-flex mb-3">
                                <input type="text" class="invisible d-none" name="row" value="<?= $row ?>">
                                <?php foreach ($menu_item as $key => $value): ?>
                                    <?php if ($key != 'immutable'): ?>
                                        <div class="input-group mx-2">
                                            <span class="input-group-text" id="basic-addon1" style="border-radius: 0.25rem 0 0 0.25rem; border-width: 1px 0 1px 1px;"><?= $key ?></span>
                                            <input type="text" class="form-control" name="<?= $key ?>" value="<?= $value ?>" aria-describedby="basic-addon1">
                                        </div>
                                    <?php endif; ?> 
                                <?php endforeach; ?>
                                <button class="btn btn-outline-primary mx-2 my-sm-0" type="submit" name="change" style="min-width: 85px;">Change</button>
                                <button class="btn btn-outline-danger" type="submit" name="delete">Delete</button>
                            </form>
                        <?php else: ?>
                            <p><?= $menu_item['name'] ?></p>
                        <?php endif?>
                    </li>
                <?php endforeach; ?>
                <li>
                    <form action="../vendor/settings/menu_add.php" method="post" class="d-flex">
                        <div class="input-group mx-2">
                            <span class="input-group-text" id="basic-addon1" style="border-radius: 0.25rem 0 0 0.25rem; border-width: 1px 0 1px 1px;">Name</span>
                            <input type="text" class="form-control" name="name" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mx-2">
                            <span class="input-group-text" id="basic-addon1" style="border-radius: 0.25rem 0 0 0.25rem; border-width: 1px 0 1px 1px;">Link</span>
                            <input type="text" class="form-control" name="link" aria-describedby="basic-addon1">
                        </div>
                        <button class="btn btn-outline-primary ml-2 my-sm-0" type="submit" style="min-width: 85px;">Add</button>
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
    </div>
</div>