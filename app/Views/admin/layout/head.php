<a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
  <i class="fe fe-x"><span class="sr-only"></span></i>
</a>
<nav class="vertnav navbar navbar-light">
  <!-- nav bar -->
  <div class="w-100 mb-4 d-flex">
    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="<?php echo base_url() ?>/admin">
      <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
        <g>
          <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
          <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
          <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
        </g>
      </svg>
    </a>
  </div>
  <ul class="navbar-nav flex-fill w-100 mb-2">
    <li class="nav-item dropdown">
      <a href="<?php echo base_url() ?>/admin" aria-expanded="false" class=" nav-link">
        <i class="fe fe-home fe-16"></i>
        <span class="ml-3 item-text">Trang Chủ</span>
      </a>

    </li>
  </ul>


  <p class="text-muted nav-heading mt-4 mb-1">
    <span>Chức Năng</span>
  </p>
  <ul class="navbar-nav flex-fill w-100 mb-2">
    <!-- nhan vien -->
    <a  href="<?php echo base_url() ?>/admin/nhanvien" aria-expanded="false" class=" nav-link">
      <i class="fe fe-user fe-16"></i>
      <span class="ml-3 item-text">Nhân Viên</span>
    </a>
    <!-- end nhan vien -->
    <!-- phong ban -->
    <a href="<?php echo base_url() ?>/admin/phongban" aria-expanded="false" class=" nav-link">
      <i class="fe fe-grid fe-16"></i>
      <span class="ml-3 item-text">Phòng Ban</span>
    </a>
    <!-- end phong ban -->
    <!-- chuc vu -->
    <a href="<?php echo base_url() ?>/admin/chucvu" aria-expanded="false" class=" nav-link">
      <i class="fe fe-layout fe-16"></i>
      <span class="ml-3 item-text">Chức Vụ</span>
    </a>
    <!-- end chuc vu -->
    <!-- phan cong -->
    <a href="<?php echo base_url() ?>/admin/phancong" aria-expanded="false" class=" nav-link">
      <i class="fe fe-box fe-16"></i>
      <span class="ml-3 item-text">Phân Công</span>
    </a>
    <!-- end phan cong -->
    <!-- luong -->
    <li class="nav-item dropdown">
      <a href="#tables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
        <i class="fe fe-layers fe-16"></i>
        <span class="ml-3 item-text">Lương</span>
      </a>
      <ul class="collapse list-unstyled pl-4 w-100" id="tables">
        <li class="nav-item">
          <a class="nav-link pl-3" href="<?php echo base_url() ?>/admin/luongcoban"><span class="ml-1 item-text">Lương Cơ Bản</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link pl-3" href="<?php echo base_url() ?>/admin/bangluong"><span class="ml-1 item-text">Bảng Lương</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link pl-3" href="<?php echo base_url() ?>/admin/bangchamcong"><span class="ml-1 item-text">Bảng Chấm Công</span></a>
        </li>
      </ul>
    </li>
    <!-- end luong -->
    <!-- bao hiem -->
    <a href="<?php echo base_url() ?>/admin/dongbaohiem" aria-expanded="false" class=" nav-link">
      <i class="fe fe-book fe-16"></i>
      <span class="ml-3 item-text">Đóng Bảo Hiểm</span>
    </a>
    <!-- end bao hiem -->
    <!-- doanh thu -->
    <a href="<?php echo base_url() ?>/admin/doanhthu" aria-expanded="false" class=" nav-link">
      <i class="fe fe-pie-chart fe-16"></i>
      <span class="ml-3 item-text">Doanh Thu</span>
    </a>
    <!-- end doanh thu -->
    <!-- tài khoản -->
    <a style="display:<?php $session = session();
                      if ($session->get('s_role') == "admin") {
                        echo "block";
                      }
                      else{
                        echo "none";
                      }
                      ?>;" href="<?php echo base_url() ?>/admin/taikhoan" aria-expanded="false" class=" nav-link">
      <i class="fe fe-shield fe-16"></i>
      <span class="ml-3 item-text">Tài Khoản</span>
    </a>
    <!-- end tài khoản -->




</nav>