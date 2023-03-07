<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <p id="addbutton" data-toggle="modal" style="display:<?php $session = session();
                                                            if ($session->get('s_role') == "admin" || $session->get('s_role') == "nhansu") {
                                                              echo "block";
                                                            } else {
                                                              echo "none";
                                                            }
                                                            ?>;" data-target="#themphancong"><i id="iconadd" class="fe fe-24 fe-edit-2"></i></p>
      <h2 class="mb-2 page-title">Phân Công</h2>
      <p class="card-text">Thông tin phân công trong công ty</p>
      <button type="button" class="btn mb-2 btn-info">
        <a style="color:white; text-decoration: none;" href="<?php echo base_url() ?>/admin/phancong/print"><i class="fe fe-24 fe-printer"></i>Print</a>
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
                    <th style="color:gray">Mã Nhân Viên</th>
                    <th style="color:gray">Mã Chức Vụ</th>
                    <th style="color:gray">Mã Phòng Ban</th>
                    <th style="color:gray">Thời Gian</th>
                    <th style="color:gray">Trạng Thái</th>

                    <th style="color:gray">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($phancongs as $phancong) { ?>
                    <tr>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($phancong['nID']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><strong><?= esc($phancong['vTenNV']) ?></strong></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($phancong['vTenCV']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($phancong['vTenPB']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($phancong['dThoiGian']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?php if ($phancong['bTrangThai'] == 1) {
                                                      echo "Đang Làm";
                                                    } else {
                                                      echo "Nghỉ Việc";
                                                    }
                                                    ?></p>
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
                                                                                                ?>;" data-target="#suaphancong<?= esc($phancong['nID']) ?>">Sửa</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                if ($session->get('s_role') == "admin") {
                                                                                                  echo "block";
                                                                                                } else {
                                                                                                  echo "none";
                                                                                                }
                                                                                                ?>;" data-target="#xoaphancong<?= esc($phancong['nID']) ?>">Xóa</a>
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


<!-- thêm phân công modal -->

<div class="card-body">
  <!-- Extra large modal -->
  <div class="modal fade" id="themphancong" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Thêm Phân Công</h2>
        </div>
        <form action="/admin/phancong/themphancong" id="myForm" method="post">
          <div class="row my-3 mx-3">
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-user fe-24 text-primary"></i>
                </div>

                <div class="col-10">

                  <div style="font-weight:bold;">Nhân Viên</div>
                  <select class="form-control" name="manhanvien" id="example-select">
                    <?php foreach ($nhanviens as $nhanvien) { ?>
                      <option value="<?php echo $nhanvien['nMaNV'] ?>"><?php echo $nhanvien['vTenNV'] ?></option>

                    <?php
                    } ?>
                  </select>

                </div>

              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold;">Chức Vụ</div>
                  <select class="form-control" name="machucvu" id="example-select">
                    <option value="<?= esc($phancong['nMaCV']) ?>" selected><?= esc($phancong['vTenCV']) ?></option>
                    <?php foreach ($chucvus as $chucvu) {
                      if ($chucvu['nMaCV'] != $phancong['nMaCV'] && $chucvu['vTenCV'] != $phancong['vTenCV']) {
                    ?>
                        <option value="<?= esc($chucvu['nMaCV']) ?>"> <?= esc($chucvu['vTenCV']) ?></option>
                    <?php }
                    } ?>
                  </select>
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold;">Phòng Ban</div>
                  <select class="form-control" name="maphongban" id="example-select">
                    <option value="<?= esc($phancong['nMaPB']) ?>" selected><?= esc($phancong['vTenPB']) ?></option>
                    <?php foreach ($phongbans as $phongban) {
                      if ($phongban['nMaPB'] != $phancong['nMaPB'] && $phongban['vTenPB'] != $phancong['vTenPB']) {
                    ?>
                        <option value="<?= esc($phongban['nMaPB']) ?>"> <?= esc($phongban['vTenPB']) ?></option>
                    <?php }
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
                  <div style="font-weight:bold">Thời Gian</div>
                  <input class="form-control" name="thoigian" type="date" value="<?php
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
                  <div style="font-weight:bold;">Trạng Thái</div>
                  <select class="form-control" name="trangthai" id="example-select">
                    <option <?php if ($phancong['bTrangThai'] == 1) {
                              echo "Selected";
                            } ?> value="1">Đang Làm</option>
                    <option <?php if ($phancong['bTrangThai'] == 0) {
                              echo "Selected";
                            } ?> value="0">Nghỉ Việc</option>
                  </select>
                </div>
              </div>
            </div> <!-- .col-md-->
            <input class="form-control" type="hidden" value="<?= esc($phancong['nID']) ?>" name="id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
            <button type="submit" name="xoanhanvien" class="btn mb-2 btn-primary">Đồng Ý</button>
          </div>
        </form>
      </div>

    </div>
  </div>

  <!-- end phân công modal -->

  <!-- sủa phân công modal -->
  <?php foreach ($phancongs as $phancong) { ?>
    <div class="card-body">
      <!-- Extra large modal -->
      <div class="modal fade" id="suaphancong<?= esc($phancong['nID']) ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Sửa Phân Công</h2>
            </div>
            <form action="/admin/phancong/suaphancong" method="post">
              <div class="row my-3 mx-3">
                <div class="col-md-3 my-3">
                  <div class="row">
                    <div class="col-2">
                      <i style="color: grey !important;" class="fe fe-user fe-24 text-primary"></i>
                    </div>
                    <div class="col-10">
                      <div style="font-weight:bold;">Nhân Viên</div>
                      <input class="form-control" type="text" disabled value="<?= esc($phancong['vTenNV']) ?>">
                      <input class="form-control" type="hidden" name="manhanvien" value="<?= esc($phancong['nMaNV']) ?>">
                    </div>
                  </div>
                </div> <!-- .col-md-->
                <div class="col-md-3 my-3">
                  <div class="row">
                    <div class="col-2">
                      <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                    </div>
                    <div class="col-10">
                      <div style="font-weight:bold;">Chức Vụ</div>
                      <select class="form-control" name="machucvu" id="example-select">
                        <option value="<?= esc($phancong['nMaCV']) ?>" selected><?= esc($phancong['vTenCV']) ?></option>
                        <?php foreach ($chucvus as $chucvu) {
                          if ($chucvu['nMaCV'] != $phancong['nMaCV'] && $chucvu['vTenCV'] != $phancong['vTenCV']) {
                        ?>
                            <option value="<?= esc($chucvu['nMaCV']) ?>"> <?= esc($chucvu['vTenCV']) ?></option>
                        <?php }
                        } ?>
                      </select>
                    </div>
                  </div>
                </div> <!-- .col-md-->
                <div class="col-md-3 my-3">
                  <div class="row">
                    <div class="col-2">
                      <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                    </div>
                    <div class="col-10">
                      <div style="font-weight:bold;">Phòng Ban</div>
                      <select class="form-control" name="maphongban" id="example-select">
                        <option value="<?= esc($phancong['nMaPB']) ?>" selected><?= esc($phancong['vTenPB']) ?></option>
                        <?php foreach ($phongbans as $phongban) {
                          if ($phongban['nMaPB'] != $phancong['nMaPB'] && $phongban['vTenPB'] != $phancong['vTenPB']) {
                        ?>
                            <option value="<?= esc($phongban['nMaPB']) ?>"> <?= esc($phongban['vTenPB']) ?></option>
                        <?php }
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
                      <div style="font-weight:bold">Thời Gian</div>
                      <input class="form-control" type="date" name="thoigian" value="<?= esc($phancong['dThoiGian']) ?>">
                    </div>
                  </div>
                </div> <!-- .col-md-->

                <div class="col-md-3 my-3">
                  <div class="row">
                    <div class="col-2">
                      <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                    </div>
                    <div class="col-10">
                      <div style="font-weight:bold;">Trạng Thái</div>
                      <select class="form-control" name="trangthai" id="example-select">
                        <option <?php if ($phancong['bTrangThai'] == 1) {
                                  echo "Selected";
                                } ?> value="1">Đang Làm</option>
                        <option <?php if ($phancong['bTrangThai'] == 0) {
                                  echo "Selected";
                                } ?> value="0">Nghỉ Việc</option>
                      </select>
                    </div>
                  </div>
                </div> <!-- .col-md-->
                <input class="form-control" type="hidden" value="<?= esc($phancong['nID']) ?>" name="id">
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
  <!-- end phân công modal -->
  <!-- xóa phân công modal -->
  <?php foreach ($phancongs as $phancong) { ?>
    <div class="card-body">
      <!-- Extra large modal -->
      <div class="col-md-4 mb-4">
        <!-- Modal -->
        <div class="modal fade" id="xoaphancong<?= esc($phancong['nID']) ?>" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="/admin/phancong/xoaphancong" method="post">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 style="color:red;font-weight:bold" class="modal-title" id="verticalModalTitle">Thông báo</h5>
                </div>
                <div class="modal-body"> Bạn có chắc muốn xóa phân công nhân viên này! Khi xóa sẽ không thể hoàn tác </div>
                <input type="hidden" value="<?= esc($phancong['nID']) ?>" name="id">
                <input type="hidden" value="<?= esc($phancong['nMaNV']) ?>" name="manhanvien">
                <div class="modal-footer">
                  <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
                  <button type="submit" name="xoaphongban" class="btn mb-2 btn-primary">Đồng Ý</button>
                </div>
              </div>
            </form>
          </div>
        </div>


      </div>
    </div>
  <?php } ?>
  <!-- end phân công modal -->


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
    $(function() {
      // when select changes
      $('#chucvuselector').on('change', function() {

        // create data from form input(s)
        let formData = $('#myForm').serialize();

        // send data to your endpoint
        $.ajax({
          url: '/selected/chucvu',
          method: 'post',
          data: formData,
          dataType: 'json', // we expect a json response
          success: function(response) {
            // whatever you want to do here. Let's console.log the response
            alert(response); // should show your ['success'=> $request->id]
          }
        });
      });
    });
  </script>