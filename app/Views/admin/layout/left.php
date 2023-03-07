<button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
  <i class="fe fe-menu navbar-toggler-icon"></i>
</button>
<form class="form-inline mr-auto searchform text-muted">
  <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
</form>
<ul class="nav">
  <li class="nav-item">
    <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
      <i class="fe fe-sun fe-16"></i>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php $session = session();

      if (empty($session->get('s_username'))) {
      ?>
        <script>
          window.location.assign("/admin/login")
        </script>
      <?php
      } else {

      ?>
        <span class="avatar avatar-sm mt-2">
          <img src="../../../../assets/avatars/<?php echo $session->get('s_image'); ?>" alt="..." class="avatar-img rounded-circle">
        </span>
    </a>
    <div style="color:red !important;text-transform:capitalize;text-align:center;font-weight:800">
      <?php echo $session->get('s_username'); ?>
    </div>
  <?php } ?>
  <div class="dropdown-menu dropdown-menu-right" style="z-index: 10000;" aria-labelledby="navbarDropdownMenuLink">
    <a class="dropdown-item" data-toggle="modal" data-target="#profile" href="#">Profile</a>
    <a class="dropdown-item" href="/admin/login">Logout</a>
  </div>
  </li>
</ul>

