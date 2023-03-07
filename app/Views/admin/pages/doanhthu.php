<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <p id="addbutton" data-toggle="modal" style="display:<?php $session = session();
                                                            if ($session->get('s_role') == "admin" || $session->get('s_role') == "ketoan") {
                                                              echo "block";
                                                            } else {
                                                              echo "none";
                                                            }
                                                            ?>;" data-target="#themdoanhthu"><i id="iconadd" class="fe fe-24 fe-edit-2"></i></p>
      <h2 class="mb-2 page-title"><?= $title ?></h2>
      <p class="card-text">Thông tin danh thu tất cả nhân viên trong công ty</p>
      <button type="button" class="btn mb-2 btn-info">
        <a style="color:white; text-decoration: none;" href="<?php echo base_url() ?>/admin/doanhthu/print"><i class="fe fe-24 fe-printer"></i>Print</a>
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
                    <th style="color:gray">ID</th>
                    <th style="color:gray">Nhân Viên</th>
                    <th style="color:gray">SL Sản Phẩm</th>
                    <th style="color:gray">Doanh Thu</th>
                    <th style="color:gray">Ngày Tháng</th>
                    <th style="color:gray">Ghi Chú</th>
                    <th style="color:gray">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($doanhthus as $doanhthu) { ?>
                    <tr>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($doanhthu['nMaDT']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><strong><?= esc($doanhthu['vTenNV']) ?></strong></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($doanhthu['nSLSP']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><strong style="color:red !important"><?= esc($doanhthu['fDoanhThu']) ?></strong></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($doanhthu['dNgayThang']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($doanhthu['vGhiChuD']) ?></p>
                      </td>
                      <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                if ($session->get('s_role') == "admin" || $session->get('s_role') == "ketoan") {
                                                                                                  echo "block";
                                                                                                } else {
                                                                                                  echo "none";
                                                                                                }
                                                                                                ?>;" data-target="#suadoanhthu<?= esc($doanhthu['nMaDT']) ?>">Sửa</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                if ($session->get('s_role') == "admin" ) {
                                                                                                  echo "block";
                                                                                                } else {
                                                                                                  echo "none";
                                                                                                }
                                                                                                ?>;" data-target="#xoadoanhthu<?= esc($doanhthu['nMaDT']) ?>">Xóa</a>
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


<!-- thêm thông tin nhân viên modal -->
<div class="card-body">
  <!-- Extra large modal -->
  <div class="modal fade" id="themdoanhthu" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Thêm Doanh Thu Cho Nhân Viên</h2>
        </div>
        <form action="/admin/doanhthu/themdoanhthu" method="post">
          <div class="row my-3 mx-3">

            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold;">Nhân Viên</div>
                  <select class="form-control" name="manhanvien" id="example-select">
                    <?php foreach ($chuadoanhthus as $chuadoanhthu) { ?>
                      <option value="<?php echo $chuadoanhthu['nMaNV'] ?>"><?php echo $chuadoanhthu['vTenNV'] ?></option>

                    <?php
                    } ?>
                  </select>
                </div>
              </div>
            </div> <!-- .col-md-->

            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">SL Sản Phẩm</div>
                  <input class="form-control" name="slsp" type="number" value="">
                </div>
              </div>
            </div> <!-- .col-md-->

            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Doanh Thu</div>
                  <input class="form-control" style="color: red !important;" name="doanhthu" type="number" value="">
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Ngày Tháng</div>
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


          </div>
          <div class="modal-footer">
            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
            <?php
            $temp = 0;
            foreach ($chuadoanhthus as $chuadoanhthu) {
              if ($chuadoanhthu['nMaNV'] != "") {
                $temp = $temp + 1;
              }
            }
            ?>
            <button type="submit" <?php if ($temp == 0) {
                                    echo "disabled";
                                  } else {
                                    echo "";
                                  } ?> class="btn mb-2 btn-primary">Đồng Ý</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end thêm thông tin nhân viên modal -->

<!-- sủa thông tin nhân viên modal -->
<?php foreach ($doanhthus as $doanhthu) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="modal fade" id="suadoanhthu<?= esc($doanhthu['nMaDT']) ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Sửa Doanh Thu Cho Nhân Viên</h2>
          </div>
          <form action="/admin/doanhthu/suadoanhthu" method="post">
            <div class="row my-3 mx-3">

              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Nhân Viên</div>
                    <input class="form-control" disabled type="text" value="<?= esc($doanhthu['vTenNV']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->

              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">SL Sản Phẩm</div>
                    <input class="form-control" name="slsp" type="number" value="<?= esc($doanhthu['nSLSP']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->

              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Doanh Thu</div>
                    <input class="form-control" style="color: red !important;" name="doanhthu" type="number" value="<?= esc($doanhthu['fDoanhThu']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Ngày Tháng</div>
                    <input class="form-control" disabled type="date" value="<?= esc($doanhthu['dNgayThang']) ?>">
                    <input class="form-control" name="ngaythang" type="hidden" value="<?= esc($doanhthu['dNgayThang']) ?>">

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
                    <input class="form-control" name="ghichu" type="text" value="<?= esc($doanhthu['vGhiChuD']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->

              <input class="form-control" type="hidden" name="id" value="<?= esc($doanhthu['nMaDT']) ?>">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
              <button type="submit" name="xoanhanvien" class="btn mb-2 btn-primary">Đồng Ý</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<!-- end sửa thông tin nhân viên modal -->

<!-- xóa thông tin nhân viên modal -->
<?php foreach ($doanhthus as $doanhthu) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="col-md-4 mb-4">
      <!-- Modal -->
      <div class="modal fade" id="xoadoanhthu<?= esc($doanhthu['nMaDT']) ?>" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form action="/admin/doanhthu/xoadoanhthu" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:red;font-weight:bold" class="modal-title" id="verticalModalTitle">Thông báo</h5>
              </div>
              <div class="modal-body"> Bạn có chắc muốn xóa doanh thu của nhân viên này! Khi xóa sẽ không thể hoàn tác </div>
              <input class="form-control" type="hidden" name="id" value="<?= esc($doanhthu['nMaDT']) ?>">
              <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="submit" name="xoadoanhthu" class="btn mb-2 btn-primary" <?php $thang = getdate();
                                                                                      if ($thang['mday'] < 4) {
                                                                                        echo "disabled";
                                                                                      }
                                                                                      if (count($chuadoanhthus) == 0) {
                                                                                        echo "disabled";
                                                                                      }
                                                                                      ?>>Đồng Ý</button>
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