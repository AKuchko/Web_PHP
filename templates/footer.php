<?php require_once('./vendor/settings/menu_settings.php'); ?>
<div>
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">© 2022 Company, Inc</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
      <?php foreach ($_SESSION['user']['menu'] as $item => $value): ?>
      <li class="nav-item"><a href="<?php echo $value['link'] ?>" class="nav-link px-2 text-muted"><?= $value['name'] ?></a></li>
      <?php endforeach; ?>
    </ul>
  </footer>
</div>