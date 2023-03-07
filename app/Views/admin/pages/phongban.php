<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <p id="addbutton" data-toggle="modal" style="display:<?php $session = session();
                                                            if ($session->get('s_role') == "admin" || $session->get('s_role') == "nhansu") {
                                                              echo "block";
                                                            } else {
                                                              echo "none";
                                                            }
                                                            ?>;" data-target="#themphongban"><i id="iconadd" class="fe fe-24 fe-edit-2"></i></p>
      <h2 class="mb-2 page-title"><?= $title ?></h2>
      <p class="card-text">Thông tin tất cả phòng ban trong công ty</p>
      <button type="button" class="btn mb-2 btn-info">
        <a style="color:white; text-decoration: none;" href="<?php echo base_url() ?>/admin/phongban/print"><i class="fe fe-24 fe-printer"></i>Print</a>
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
                    <th style="color:gray">Mã Phòng Ban</th>
                    <th style="color:gray">Tên Phòng Ban</th>
                    <th style="color:gray">Địa Chỉ</th>
                    <th style="color:gray">Ghi Chú</th>
                    <th style="color:gray">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($phongbans as $phongban) { ?>
                    <tr>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($phongban['nMaPB']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><strong><?= esc($phongban['vTenPB']) ?></strong></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($phongban['vDiaChi']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($phongban['vGhiChu']) ?></p>
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
                                                                                                ?>;" data-target="#suaphongban<?= esc($phongban['nMaPB']) ?>">Sửa</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                if ($session->get('s_role') == "admin") {
                                                                                                  echo "block";
                                                                                                } else {
                                                                                                  echo "none";
                                                                                                }
                                                                                                ?>;" data-target="#xoaphongban<?= esc($phongban['nMaPB']) ?>">Xóa</a>
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
  <div class="modal fade" id="themphongban" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Thêm Phòng Ban</h2>
        </div>
        <form action="/admin/phongban/themphongban" method="post">
          <div class="row my-3 mx-3">

            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Tên Phòng Ban</div>
                  <input class="form-control" required name="ten" type="text" value="">
                </div>
              </div>
            </div> <!-- .col-md-->

            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Địa chỉ</div>
                  <input class="form-control" required name="diachi" type="text" value="">
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
            <button type="submit" name="xoanhanvien" class="btn mb-2 btn-primary">Đồng Ý</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end thêm thông tin nhân viên modal -->

<!-- sủa thông tin nhân viên modal -->
<?php foreach ($phongbans as $phongban) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="modal fade" id="suaphongban<?= esc($phongban['nMaPB']) ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px">Sửa Phòng Ban</h2>
          </div>
          <form action="/admin/phongban/suaphongban" method="post">
            <div class="row my-3 mx-3">

              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Tên Phòng Ban</div>
                    <input class="form-control" name="ten" type="text" value="<?= esc($phongban['vTenPB']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->

              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Địa chỉ</div>
                    <input class="form-control" type="text" name="diachi" value="<?= esc($phongban['vDiaChi']) ?>">
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
                    <input class="form-control" type="text" name="ghichu" value="<?= esc($phongban['vGhiChu']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->

              <input class="form-control" type="hidden" name="ma" value="<?= esc($phongban['nMaPB']) ?>">
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
<?php foreach ($phongbans as $phongban) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="col-md-4 mb-4">
      <!-- Modal -->
      <div class="modal fade" id="xoaphongban<?= esc($phongban['nMaPB']) ?>" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form action="/admin/phongban/xoaphongban" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:red;font-weight:bold" class="modal-title" id="verticalModalTitle">Thông báo</h5>
              </div>
              <div class="modal-body"> Bạn có chắc muốn xóa phòng ban này! Khi xóa sẽ không thể hoàn tác </div>
              <input class="form-control" type="hidden" name="ma" value="<?= esc($phongban['nMaPB']) ?>">
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