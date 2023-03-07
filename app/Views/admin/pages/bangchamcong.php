    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <p id="addbutton" data-toggle="modal" style="display:<?php $session = session();
                                                                if ($session->get('s_role') == "admin" || $session->get('s_role') == "nhansu") {
                                                                  echo "block";
                                                                } else {
                                                                  echo "none";
                                                                }
                                                                ?>;" data-target="#thembangchamcong"><i id="iconadd" class="fe fe-24 fe-edit-2"></i></p>
          <h2 class="mb-2 page-title"><?php echo $title ?></h2>
          <p class="card-text">Thông tin chấm công tất cả nhân viên trong công ty</p>
          <button type="button" class="btn mb-2 btn-info">
            <a style="color:white; text-decoration: none;" href="<?php echo base_url() ?>/admin/bangchamcong/print"><i class="fe fe-24 fe-printer"></i>Print</a>
          </button>
          <div class="row my-4">
            <!-- Small table -->
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-body">
                  <!-- table -->
                  <table class="table datatables" id="dataTable-1">
                    <thead>
                      <tr>
                        <th style="color:gray">Mã Chấm Công</th>
                        <th style="color:gray">Tên Nhân Viên</th>
                        <th style="color:gray">Số Ngày Công</th>
                        <th style="color:gray">Số Ngày Nghĩ</th>
                        <th style="color:gray">Số Giờ Tăng Ca</th>
                        <th style="color:gray">Ngày Chấm Công</th>
                        <th style="color:gray">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($chamcongs as $chamcong) { ?>
                        <tr>
                          <td>
                            <p class="mb-0 text-muted"><?= esc($chamcong['nMaChamCong']) ?></p>
                          </td>
                          <td>
                            <p class="mb-0 text-muted"><strong><?= esc($chamcong['vTenNV']) ?></strong></p>
                          </td>
                          <td>
                            <p class="mb-0 text-muted"><?= esc($chamcong['fSoNgayCong']) ?></p>
                          </td>
                          <td>
                            <p class="mb-0 text-muted"><?= esc($chamcong['fSoNgayNghi']) ?></p>
                          </td>
                          <td>
                            <p class="mb-0 text-muted"><?= esc($chamcong['fGioTangCa']) ?></p>
                          </td>
                          <td>
                            <p class="mb-0 text-muted"><?= esc($chamcong['dNgayThang']) ?></p>
                          </td>

                          <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                    if ($session->get('s_role') == "admin" || $session->get('s_role') == "nhansu") {
                                                                                                      echo "block";
                                                                                                    } else {
                                                                                                      echo "none";
                                                                                                    }
                                                                                                    ?>;" data-target="#suabangchamcong<?= esc($chamcong['nMaChamCong']) ?>">Sửa</a>
                              <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                    if ($session->get('s_role') == "admin" ) {
                                                                                                      echo "block";
                                                                                                    } else {
                                                                                                      echo "none";
                                                                                                    }
                                                                                                    ?>;" data-target="#xoabangchamcong<?= esc($chamcong['nMaChamCong']) ?>">Xóa</a>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div> <!-- simple table -->
          </div> <!-- end section -->
        </div> <!-- .col-12 -->
      </div> <!-- .row -->
    </div> <!-- .container-fluid -->

    <!-- thêm bảng chấm công modal -->
    <div class="card-body">
      <!-- Extra large modal -->
      <div class="modal fade" id="thembangchamcong" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Thêm Bảng Chấm Công</h2>
            </div>
            <form action="/admin/bangchamcong/thembangcong" method="post">
              <div class="row my-3 mx-3">

                <div class="col-md-3 my-3">
                  <div class="row">
                    <div class="col-2">
                      <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                    </div>
                    <div class="col-10">
                      <div style="font-weight:bold">Mã Nhân Viên</div>
                      <select class="form-control" name="manhanvien" id="example-select">
                        <?php foreach ($chuachamcongs as $chuachamcong) { ?>
                          <option value="<?php echo $chuachamcong['nMaNV'] ?>"><?php echo $chuachamcong['vTenNV'] ?></option>
                        <?php
                        } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- .col-md-->
                <div class="col-md-3 my-3">
                  <div class="row">
                    <div class="col-2">
                      <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                    </div>
                    <div class="col-10">
                      <div style="font-weight:bold">Số Ngày Công</div>
                      <input class="form-control" onchange="KiemTraNgayCong()" id="ngaycong" name="songaycong" type="number" value="">
                    </div>
                  </div>
                </div> <!-- .col-md-->
                <div class="col-md-3 my-3">
                  <div class="row">
                    <div class="col-2">
                      <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                    </div>
                    <div class="col-10">
                      <div style="font-weight:bold">Số Giờ Tăng Ca</div>
                      <input class="form-control" name="giotangca" type="number" value="">
                    </div>
                  </div>
                </div> <!-- .col-md-->

                <div class="col-md-3 my-3">
                  <div class="row">
                    <div class="col-2">
                      <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                    </div>
                    <div class="col-10">
                      <div style="font-weight:bold">Số Ngày Nghỉ</div>
                      <input class="form-control" id="ngaynghi" onchange="KiemTraNgayChamCong()" name="songaynghi" type="number" value="">
                    </div>
                  </div>
                </div> <!-- .col-md-->

                <div class="col-md-3 my-3">
                  <div class="row">
                    <div class="col-2">
                      <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                    </div>
                    <div class="col-10">
                      <div style="font-weight:bold">Ngày Chấm Công</div>
                      <input class="form-control" disabled type="date" value="<?php
                                                                              date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                              echo $date = date('Y-m-d'); ?>">
                      <input class="form-control" name="ngaythang" type="hidden" value="<?php
                                                                                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                                        echo $date = date('Y-m-d'); ?>">
                    </div>
                  </div>
                </div> <!-- .col-md-->

                <div class="col-md-3 my-3">
                  <div class="row">
                    <div class="col-2">
                      <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                    </div>
                    <div class="col-10">
                      <div style="font-weight:bold">Ghi Chú</div>
                      <input class="form-control" name="ghichu" type="text" value="">
                    </div>
                  </div>
                </div> <!-- .col-md-->

                <div style="display:none;position:absolute;margin:auto;left:35%;z-index:1000;top:42%" class="alert alert-danger" id="wanringngaycong" role="alert">
                  Số ngày công không được lớn hơn số ngày công quy định!
                </div>
                <div style="display:none;position:absolute;margin:auto;left:35%;z-index:1000;top:42%" class="alert alert-danger" id="wanringngaynghi" role="alert">
                  Số ngày nghỉ không hợp lệ!
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>

                <button type="submit" name="thembangchamcong" class="btn mb-2 btn-primary" <?php $thang = getdate();
                                                                                            if ($thang['mday'] < 4) {
                                                                                              echo "disabled";
                                                                                            }
                                                                                            if (count($chuachamcongs) == 0) {
                                                                                              echo "disabled";
                                                                                            }
                                                                                            ?>>Đồng Ý</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- end thêm bảng chấm công modal -->
    <!-- sủa bảng chấm công modal -->
    <?php foreach ($chamcongs as $chamcong) { ?>
      <div class="card-body">
        <!-- Extra large modal -->
        <div class="modal fade" id="suabangchamcong<?= esc($chamcong['nMaChamCong']) ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Sửa Bảng Chấm Công</h2>
              </div>
              <form action="/admin/bangchamcong/suabangcong" method="post">
                <div class="row my-3 mx-3">

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Tên Nhân Viên</div>
                        <input class="form-control" require type="text" disabled='false' value="<?= esc($chamcong['vTenNV']) ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Số Ngày Công</div>
                        <input class="form-control" require type="number" name="songaycong" value="<?= esc($chamcong['fSoNgayCong']) ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Số Giờ Tăng Ca</div>
                        <input class="form-control" require type="number" name="giotangca" value="<?= esc($chamcong['fGioTangCa']) ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Số Ngày Nghỉ</div>
                        <input class="form-control" require type="number" name="songaynghi" value="<?= esc($chamcong['fSoNgayNghi']) ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Ngày Chấm Công</div>
                        <input class="form-control" require type="date" name="ngaythang" value="<?= esc($chamcong['dNgayThang']) ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Ghi Chú</div>
                        <input class="form-control" require type="text" name="ghichu" value="<?= esc($chamcong['vGhiChuC']) ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->
                </div>

                <input class="form-control" require type="hidden" name="machamcong" value="<?= esc($chamcong['nMaChamCong']) ?>">

                <div class="modal-footer">
                  <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
                  <button type="submit" name="" class="btn mb-2 btn-primary">Đồng Ý</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <!-- end sửa bảng chấm công modal -->
    <!-- xóa bảng chấm công modal -->
    <?php foreach ($chamcongs as $chamcong) { ?>
      <div class="card-body">
        <!-- Extra large modal -->
        <div class="col-md-4 mb-4">
          <!-- Modal -->
          <div class="modal fade" id="xoabangchamcong<?= esc($chamcong['nMaChamCong']) ?>" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <form action="/admin/bangchamcong/xoabangcong" method="post">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 style="color:red;font-weight:bold" class="modal-title" id="verticalModalTitle">Thông báo</h5>
                  </div>
                  <div class="modal-body"> Bạn có chắc muốn xóa bảng chấm công nhân viên này! Khi xóa sẽ không thể hoàn tác </div>
                  <input type="hidden" name="machamcong" value="<?= esc($chamcong['nMaChamCong']) ?>">
                  <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="xoabangchamcong" class="btn mb-2 btn-primary">Đồng Ý</button>
                  </div>
                </div>
              </form>
            </div>
          </div>


        </div>
      </div>
    <?php } ?>
    <!-- end xóa thông tin nhân viên modal -->


    <style>
      #addbutton {
        border-radius: 15px;
        background-color: #2E8B57;
        width: 60px;
        height: 50px;
        line-height: 60px;
        margin-left: 70%;
        position: fixed;
        z-index: 1000;
        display: block;
      }

      #iconadd {
        color: white;
        margin-left: 15px;
      }

      #addbutton:hover #iconadd {
        font-size: 27px;
        margin-left: 25px;
        transition: 0.3s;
      }

      #addbutton:hover {
        background-color: #008000;
      }
    </style>
    <script>
      function KiemTraNgayCong() {
        var effect = document.getElementById('ngaycong');

        var ngaycong = effect.value;
        $.ajax({
          url: "<?php echo base_url() . "/admin/bangchamcong/kiemtrangaycong" ?>",
          method: "POST",
          data: {
            ngaycong: ngaycong
          },
          success: function(res) {
            <?php $thang = getdate();
            $d = cal_days_in_month(CAL_GREGORIAN, $thang['mon'], date('Y'));
            if ($d == 31) {
              $ngaycongtoida = 27;
            } else if ($d == 30) {
              $ngaycongtoida = 26;
            } else if ($d == 29) {
              $ngaycongtoida = 25;
            } else {
              $ngaycongtoida = 24;
            }
            ?>
            if (res > <?php echo $ngaycongtoida ?>) {
              $("#wanringngaycong").css("display", "block");
              setTimeout(function() {
                $("#wanringngaycong").css("display", "none");
              }, 4000);
              $('#ngaycong').val(<?php echo $ngaycongtoida ?>);
              return;
            }

          }

        })

      }

      function KiemTraNgayChamCong() {
        var effect = document.getElementById('ngaynghi');
        var ngaynghi = effect.value;
        var effect = document.getElementById('ngaycong');
        var ngaycong = effect.value;
        $.ajax({
          url: "<?php echo base_url() . "/admin/bangchamcong/kiemtrangaynghi" ?>",
          method: "POST",
          data: {
            ngaynghi: ngaynghi
          },
          success: function(res) {
            <?php $thang = getdate();
            $d = cal_days_in_month(CAL_GREGORIAN, $thang['mon'], date('Y'));
            if ($d == 31) {
              $ngaycongtoida = 27;
            } else if ($d == 30) {
              $ngaycongtoida = 26;
            } else if ($d == 29) {
              $ngaycongtoida = 25;
            } else {
              $ngaycongtoida = 24;
            }
            ?>
            if ((res + ngaycong) > <?php echo $ngaycongtoida ?>) {
              $("#wanringngaynghi").css("display", "block");
              setTimeout(function() {
                $("#wanringngaynghi").css("display", "none");
              }, 4000);
              $('#ngaynghi').val(<?php echo $ngaycongtoida ?> - ngaycong);
              return;
            }

          }

        })

      }
    </script>