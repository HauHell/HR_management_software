    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <h2 class="mb-2 page-title">Lương Cơ Bản</h2>
          <p class="card-text">Thông tin lương cơ bản tất cả nhân viên trong công ty</p>
          <button type="button" class="btn mb-2 btn-info">
            <a style="color:white; text-decoration: none;" href="<?php echo base_url() ?>/admin/luongcoban/print"><i class="fe fe-24 fe-printer"></i>Print</a>
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
                        <th style="color:gray">Chức Vụ</th>
                        <th style="color:gray">Phụ Cấp</th>
                        <th style="color:gray">Lương Cơ Bản</th>
                        <th style="color:gray">Ngày Thay Đổi</th>
                        <th style="color:gray">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($luongcobans as $luongcoban) {
                      ?>
                        <tr>
                          <td>
                            <p class="mb-0 text-muted"><?= esc($luongcoban['nMaLuongCB']) ?></p>
                          </td>
                          <td>
                            <p class="mb-0 text-muted"><strong><?= esc($luongcoban['vTenNV']) ?></strong></p>
                          </td>
                          <td>
                            <?php foreach ($chucvus as $chucvu) {
                              if ($chucvu['nMaCV'] == $luongcoban['nMaCV']) {

                            ?>


                                <p class="mb-0 text-muted"><?= esc($chucvu['vTenCV']) ?></p>
                            <?php }
                            } ?>
                          </td>
                          <td>
                            <?php foreach ($chucvus as $chucvu) {
                              if ($chucvu['nMaCV'] == $luongcoban['nMaCV']) {

                            ?>
                                <p class="mb-0 text-muted"><?= esc($chucvu['fPhuCap']) ?></p>
                            <?php }
                            } ?>
                          </td>
                          <td>
                            <p class="mb-0 text-muted">

                              <?= esc($luongcoban['fSoTienLuongCB']) ?></p>
                          </td>
                          <td>
                            <p class="mb-0 text-muted"><?= esc($luongcoban['dNgayThayDoi']) ?></p>
                          </td>
                          <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="text-muted sr-only">Action</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#chitietluongcoban<?= esc($luongcoban['nMaLuongCB']) ?>">Chi Tiết</a>
                              <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                    if ($session->get('s_role') == "admin" ) {
                                                                                                      echo "block";
                                                                                                    } else {
                                                                                                      echo "none";
                                                                                                    }
                                                                                                    ?>;" data-target="#xoaluongcoban<?= esc($luongcoban['nMaLuongCB']) ?>">Xóa</a>
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

    <!-- chi tiết thông tin nhân viên modal -->
    <?php foreach ($luongcobans as $luongcoban) { ?>
      <div class="card-body">
        <!-- Extra large modal -->
        <div class="modal fade" id="chitietluongcoban<?= esc($luongcoban['nMaLuongCB']) ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Chi Tiết Lương Cơ Bản</h2>
              </div>
              <div class="row mt-5 align-items-center">
                <div class="col-md-11 text-center mb-6">
                  <div class="avatar avatar-xl">
                    <img src="../../../../assets/avatars/<?= esc($luongcoban['vImage']) ?>" style="height:300px;width:200px;margin-left:30px;margin-bottom:20px;object-fit:contain" alt="...">
                  </div>
                </div>
              </div>
              <form action="" method="post">
                <div class="row my-3 mx-3">

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">ID</div>
                        <div><?= esc($luongcoban['nMaLuongCB']) ?></div>
                      </div>
                    </div>
                  </div> <!-- .col-md-->
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-user fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Nhân Viên</div>
                        <div><?= esc($luongcoban['vTenNV']) ?></div>
                      </div>
                    </div>
                  </div> <!-- .col-md-->
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold"> Chức Vụ</div>
                        <?php foreach ($chucvus as $chucvu) {
                          if ($chucvu['nMaCV'] == $luongcoban['nMaCV']) {

                        ?>
                            <div><?= esc($chucvu['vTenCV']) ?></div>

                      </div>
                    </div>
                  </div> <!-- .col-md-->
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Phụ Cấp</div>
                        <div><?= esc($chucvu['fPhuCap']) ?></div>
                      </div>
                  <?php }
                        } ?>
                    </div>
                  </div> <!-- .col-md-->
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Phòng Ban</div>
                        <?php foreach ($phongbans as $phongban) {
                          if ($phongban['nMaPB'] == $luongcoban['nMaPB']) {

                        ?>
                            <div><?= esc($phongban['vTenPB']) ?></div>
                        <?php }
                        } ?>
                      </div>
                    </div>
                  </div> <!-- .col-md-->

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Ngày Thay Đổi</div>
                        <div><?= esc($luongcoban['dNgayThayDoi']) ?></div>
                      </div>
                    </div>
                  </div> <!-- .col-md-->

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Thâm Niên</div>
                        <div><?= esc($luongcoban['nThamNien']) ?></div>

                      </div>
                    </div>
                  </div> <!-- .col-md-->
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Số Tiền</div>
                        <div style="color: red !important;"><?= esc($luongcoban['fSoTienLuongCB']) ?></div>

                      </div>
                    </div>
                  </div> <!-- .col-md-->

                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <!-- end chi tiết thông tin nhân viên modal -->


    <!-- xóa thông tin nhân viên modal -->
    <?php foreach ($luongcobans as $luongcoban) { ?>
      <div class="card-body">
        <!-- Extra large modal -->
        <div class="col-md-4 mb-4">
          <!-- Modal -->
          <div class="modal fade" id="xoaluongcoban<?= esc($luongcoban['nMaLuongCB']) ?>" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <form action="/admin/luongcoban/xoaluongcoban" method="post">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 style="color:red;font-weight:bold" class="modal-title" id="verticalModalTitle">Thông báo</h5>
                  </div>
                  <div class="modal-body"> Bạn có chắc muốn xóa lương cơ bản nhân viên này! Khi xóa sẽ không thể hoàn tác </div>
                  <input type="hidden" value="<?= esc($luongcoban['nMaLuongCB']) ?>" name="id">
                  <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="xoaluongcoban" class="btn mb-2 btn-primary">Đồng Ý</button>
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