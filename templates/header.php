<?php
require_once('./vendor/settings/menu_settings.php');
if (isset($_GET['page']))
  $current_page = $_GET['page'];
?>
<nav class="navbar navbar-expand-lg navbar-light w-100 bg-light position-fixed" style="top: 0; z-index:1;">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php foreach ($_SESSION['user']['menu'] as $item => $value): ?>
      <li class="nav-item <?php if ($current_page == strtolower($value['name'])) echo 'active' ?>">
        <a class="nav-link" href="<?php echo $value['link'] ?>"><?= $value['name'] ?></a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</nav>