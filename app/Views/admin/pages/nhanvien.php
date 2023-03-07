<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <p id="addbutton" data-toggle="modal" style="display:<?php $session = session();
                                                            if ($session->get('s_role') == "admin" || $session->get('s_role') == "nhansu") {
                                                              echo "block";
                                                            } else {
                                                              echo "none";
                                                            }
                                                            ?>;" data-target="#themnhanvien"><i id="iconadd" class="fe fe-24 fe-edit-2"></i></p>
      <h2 class="mb-2 page-title"><?= $title ?></h2>
      <p class="card-text">Thông tin toàn bộ nhân viên trong công ty</p>
      <button type="button" class="btn mb-2 btn-info">
        <a style="color:white; text-decoration: none;" href="<?php echo base_url() ?>/admin/nhanvien/print"><i class="fe fe-24 fe-printer"></i>Print</a>
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
                    <th style="color:gray"></th>
                    <th style="color:gray">Mã Nhân Viên</th>
                    <th style="color:gray">Tên Nhân Viên</th>
                    <th style="color:gray">Giới Tính</th>
                    <th style="color:gray">Số Điện Thoại</th>
                    <th style="color:gray">Phòng Ban</th>
                    <th style="color:gray">Ngày Vào Làm</th>
                    <th style="color:gray">Action</th>
                  </tr>

                </thead>
                <tbody>
                  <?php

                  use App\Controllers\Admin\ChucVu;

                  foreach ($nhanviens as $nhanvien) { ?>
                    <tr <?php if ($nhanvien['bTinhTrangLamViec'] == 0) {  ?> style="background-color:<?php echo "#FF0000";
                                                                                                    } ?>">
                      <td>
                        <div class="avatar avatar-md">
                          <img src="../../../../assets/avatars/<?= esc($nhanvien['vImage']) ?>" alt="..." class="avatar-img rounded-circle">
                        </div>
                      </td>

                      <td>
                        <p class="mb-0 text-muted"><?= esc($nhanvien['nMaNV']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><strong><?= esc($nhanvien['vTenNV']) ?></strong></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted">
                          <?php
                          if ($nhanvien['bGioiTinh'] == 1) {
                            echo "Nam";
                          } else {
                            echo "Nữ";
                          }

                          ?>
                        </p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($nhanvien['nSdt']) ?></p>
                      </td>

                      <td>
                        <?php foreach ($phongbans as $phongban) {
                          if ($phongban['nMaPB'] == $nhanvien['nMaPB']) { ?>
                            <p class="mb-0 text-muted"><?= esc($phongban['vTenPB']) ?></p>
                        <?php }
                        } ?>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($nhanvien['dNgayVaoLam']) ?></p>
                      </td>

                      <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#chitietnhanvien<?= esc($nhanvien['nMaNV']) ?>">Chi Tiết</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                if ($session->get('s_role') == "admin" || $session->get('s_role') == "nhansu") {
                                                                                                  echo "block";
                                                                                                } else {
                                                                                                  echo "none";
                                                                                                }
                                                                                                ?>;" data-target="#suanhanvien<?= esc($nhanvien['nMaNV']) ?>">Sửa</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                if ($session->get('s_role') == "admin") {
                                                                                                  echo "block";
                                                                                                } else {
                                                                                                  echo "none";
                                                                                                }
                                                                                                ?>;" data-target="#xoanhanvien<?= esc($nhanvien['nMaNV']) ?>">Xóa</a>

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


<!-- thông tin chi tiết nhân viên modal -->
<?php foreach ($nhanviens as $nhanvien) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="modal fade" id="chitietnhanvien<?= esc($nhanvien['nMaNV']) ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Thông Tin</h2>
          </div>
          <div class="row mt-5 align-items-center">
            <div class="col-md-6 text-center mb-6">
              <div class="avatar avatar-xl">
                <img src="../../../../assets/avatars/<?= esc($nhanvien['vImage']) ?>" alt="..." style="height:300px;width:200px;margin-left:30px;margin-bottom:20px;object-fit:contain">
              </div>
            </div>
            <div class="col">
              <div class="row align-items-center">
                <div class="col-md-7">
                  <h4 class="mb-1"><?= esc($nhanvien['vTenNV']) ?></h4>
                  <?php
                  $temp = 0;
                  foreach ($chucvus as $chucvu) {
                    if ($nhanvien['nMaCV'] == $chucvu['nMaCV']) {


                  ?>
                      <p class="small mb-3" style="font-weight: bold;"><?php echo $chucvu['vTenCV'];
                                                                      }
                                                                    }
                                                                        ?><span class="badge badge-dark"><?= esc($nhanvien['vDiaChi']) ?></span></p>
                      <div><?= esc($nhanvien['vGhiChu']) ?></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 mb-12">
            <div class="card shadow">
              <div class="card-body">
                <ul class="nav nav-pills col-md-3 mb-4 nav-fill mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="thongtin" data-toggle="pill" href="#thongtin<?php echo $nhanvien['nMaNV'] ?>" role="tab" aria-controls="pills-home" aria-selected="true">Thông tin</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="phancong" data-toggle="pill" href="#quatrinhcv<?php echo $nhanvien['nMaNV'] ?>" role="tab" aria-controls="pills-profile" aria-selected="false">Quá trình công việc</a>
                  </li>

                </ul>
                <div class="tab-content mb-1" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="thongtin<?php echo $nhanvien['nMaNV'] ?>" role="tabpanel" aria-labelledby="thongtin">
                    <div class="row my-3 mx-3">
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-user fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">Mã Nhân Viên</div>
                            <div><?= esc($nhanvien['nMaNV']) ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-calendar fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold;">Ngày Sinh</div>
                            <div><?= esc($nhanvien['dNgaySinh']) ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">Giới Tính</div>
                            <div>
                              <?php
                              if ($nhanvien['bGioiTinh'] == 1) {
                                echo "Nam";
                              } else {
                                echo "Nữ";
                              }
                              ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-phone fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">Số Điện Thoại</div>
                            <div><?= esc($nhanvien['nSdt']) ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">CMND/CCCD</div>
                            <div><?= esc($nhanvien['nCCCD']) ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-calendar fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">Ngày Vào Làm</div>
                            <div><?= esc($nhanvien['dNgayVaoLam']) ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-info fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">Tình Trạng Làm Việc</div>
                            <div>
                              <?php
                              if ($nhanvien['bTinhTrangLamViec'] == 1) {
                                echo "Đang làm";
                              } else {
                                echo "Nghỉ việc";
                              }
                              ?>
                            </div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-award fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">Trình Độ Học Vấn</div>
                            <div><?= esc($nhanvien['vTrinhDoHocVan']) ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-alert-triangle fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">Tịnh Trạng Hôn Nhân</div>
                            <div><?= esc($nhanvien['vTinhTrangHonNhan']) ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">BHYT</div>
                            <div><?= esc($nhanvien['vBHYT']) ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">BHTN</div>
                            <div><?= esc($nhanvien['vBHTN']) ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">BHXH</div>
                            <div><?= esc($nhanvien['vBHXH']) ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-briefcase fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">Phòng Ban</div>
                            <?php
                            $temp = 0;
                            foreach ($phancongs as $phancong) {
                              if ($nhanvien['nMaNV'] == $phancong['nMaNV']) {
                                $temp = $phancong['nMaPB'];
                              }
                            }
                            $cv = "Chưa Có Phòng Ban";
                            foreach ($phongbans as $phongban) {
                              if ($phongban['nMaPB'] == $temp) {
                                $cv = $phongban['vTenPB'];
                              }
                            }
                            ?>
                            <div><?php echo $cv ?></div>

                          </div>
                        </div>
                      </div> <!-- .col-md-->
                      <div class="col-md-3 my-3">
                        <div class="row">
                          <div class="col-2">
                            <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                          </div>
                          <div class="col-10">
                            <div style="font-weight:bold">Trình Độ Chuyên Môn</div>
                            <div><?= esc($nhanvien['vTrinhDoChuyenMon']) ?></div>
                          </div>
                        </div>
                      </div> <!-- .col-md-->
                    </div>
                  </div>
                  <div class="tab-pane fade" id="quatrinhcv<?php echo $nhanvien['nMaNV'] ?>" role="tabpanel" aria-labelledby="phancong">
                    <?php foreach (array_reverse($nhanvien['getchucvu']) as $nhanvien) {
                      foreach ($chucvus as $chucvu) {
                        if ($chucvu['nMaCV'] == $nhanvien['nMaCV']) {

                    ?>
                          <div class="alert alert-success" role="alert"> <?php echo $chucvu['vTenCV'];
                                                                        }
                                                                      } ?> <span style="color:red;text-align:center">Ngày Phân Công:<?php echo $nhanvien['dThoiGian'] ?> </span></div>
                        <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Đóng</button>
          </div>
        </div>

      </div>
    </div>
  </div>
<?php } ?>
<!-- end thông tin chi tiết nhân viên modal -->
<!-- thêm thông tin nhân viên modal -->
<div class="card-body">

  <!-- Extra large modal -->

  <div class="modal fade" id="themnhanvien" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Thêm Nhân Viên</h2>
        </div>
        <form method="post" action="/admin/nhanvien/themnhanvien" enctype="multipart/form-data">
          <div class="row mt-5 align-items-center">
            <div class="col-md-6 text-center mb-6">
              <div class="avatar avatar-xl">
                <img src="../../../../assets/avatars/tam.png" alt="..." id="myimage" style="height:300px;width:200px;margin-left:30px;margin-bottom:20px;object-fit:contain">
                <input style="margin-left: 10px;font-size:10px;margin-top:10px;" size="" onchange="onFileSelected2(event,'myimage')" name="image" type="file">
              </div>
            </div>
            <div class="col">
              <div class="row align-items-center">
                <div class="col-md-10">
                  <h4 class="mb-1">Tên Nhân Viên <input class="form-control" type="text" name="ten" value=""></h4>
                  <!-- <div class="card-title" style="font-weight:bold">Chức Vụ
                    <input class="form-control" name="chucvu" type="text" value="">
                  </div>
                  <div class="card-title" style="font-weight:bold">Địa Chỉ
                    <input class="form-control" name="diachi" type="text" value="">
                  </div>
                  <div>
                    <div class="card-title" style="font-weight:bold">Ghi Chú</div>
                    <textarea style="height: 100px;" class="form-control" name="ghichu" type="text" value=""></textarea>
                  </div> -->

                </div>

              </div>

            </div>
          </div>
          <div class="row my-3 mx-3">


            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-calendar fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold;">Ngày Sinh</div>
                  <input class="form-control" name="ngaysinh" type="date" value="2013-01-08">
                </div>
              </div>
            </div> <!-- .col-md-->

            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold;">Giới Tính</div>
                  <select class="form-control" name="gioitinh" id="example-select">
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>

                  </select>
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-phone fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Số Điện Thoại</div>
                  <input class="form-control" name="sodienthoai" id="custom-phone">
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">CMND/CCCD</div>
                  <input class="form-control" name="cccd" type="text" value="">
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-calendar fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Ngày Vào Làm</div>
                  <input class="form-control" name="ngayvaolam" type="date" value="2013-01-08">
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-info fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold;">Tình Trạng Làm Việc</div>
                  <select class="form-control" name="tinhtranglamviec" id="example-select">
                    <option value="1">Đang Làm</option>
                    <option value="0">Nghĩ Việc</option>
                  </select>
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-award fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Trình Độ Học Vấn</div>
                  <input class="form-control" name="trinhdohocvan" type="text" value="">
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-alert-triangle fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Tịnh Trạng Hôn Nhân</div>
                  <input class="form-control" name="tinhtranghonnhan" type="text" value="">
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">BHYT</div>
                  <input class="form-control" name="bhyt" type="text" value="">
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">BHTN</div>
                  <input class="form-control" name="bhtn" type="text" value="">
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">BHXH</div>
                  <input class="form-control" name="bhxh" type="text" value="">
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-briefcase fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Địa chỉ</div>
                  <input class="form-control" name="diachi" type="text" value="">
                </div>
              </div>
            </div>
            <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-briefcase fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Ghi chú</div>
                  <input class="form-control" name="ghichu" type="text" value="">
                </div>
              </div>
            </div>
            <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Trình Độ Chuyên Môn</div>
                  <input class="form-control" name="trinhdochuyenmon" type="text" value="">
                </div>
              </div>
            </div> <!-- .col-md-->


          </div>
          <div class="modal-footer">
            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
            <button type="submit" class="btn mb-2 btn-primary">Đồng Ý</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end thêm thông tin nhân viên modal -->
<!-- sủa thông tin nhân viên modal -->
<?php foreach ($nhanviens as $nhanvien) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="modal fade" id="suanhanvien<?= esc($nhanvien['nMaNV']) ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Sửa Thông Tin</h2>
          </div>
          <form action="/admin/nhanvien/suanhanvien" method="post" enctype="multipart/form-data">
            <div class="row mt-5 align-items-center">
              <div class="col-md-6 text-center mb-6">
                <div class="avatar avatar-xl">
                  <img src="../../../../assets/avatars/<?= esc($nhanvien['vImage']) ?>" id="myimage2<?= esc($nhanvien['nMaNV']) ?>" alt="..." style="height:300px;width:200px;margin-left:30px;margin-bottom:20px;object-fit:contain">
                  <input style="margin-left: 10px;font-size:10px;margin-top:10px;" onchange="onFileSelected2(event, 'myimage2<?= esc($nhanvien['nMaNV']) ?>')" name="image" type="file">
                  <input style="margin-left: 10px;font-size:10px;margin-top:10px;" value="<?= esc($nhanvien['vImage']) ?>" name="oldimage" type="hidden">
                </div>
              </div>
              <div class="col">
                <div class="row align-items-center">
                  <div class="col-md-10">
                    <h4 class="mb-1">Tên<input class="form-control" type="text" name="ten" value="<?= esc($nhanvien['vTenNV']) ?>"></h4>
                  </div>

                </div>

              </div>
            </div>
            <div class="row my-3 mx-3">
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-calendar fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold;">Ngày Sinh</div>
                    <input class="form-control" type="date" name="ngaysinh" value="<?= esc($nhanvien['dNgaySinh']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->

              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold;">Giới Tính</div>

                    <select class="form-control" name="gioitinh" id="example-select">

                      <option <?php if ($nhanvien['bGioiTinh'] == 1) {
                                echo "Selected";
                              } ?> value="1">Nam
                      </option>
                      <option <?php if ($nhanvien['bGioiTinh'] == 0) {
                                echo "Selected";
                              } ?> value="0">Nữ
                      </option>

                    </select>

                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-phone fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Số Điện Thoại</div>
                    <input class="form-control" name="sodienthoai" value="<?= esc($nhanvien['nSdt']) ?>" id="custom-phone">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">CMND/CCCD</div>
                    <input class="form-control" value="<?= esc($nhanvien['nCCCD']) ?>" type="text" name="cccd">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-calendar fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Ngày Vào Làm</div>
                    <input class="form-control" name="ngayvaolam" type="date" value="<?= esc($nhanvien['dNgayVaoLam']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-info fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold;">Tình Trạng Làm Việc</div>
                    <select class="form-control" name="tinhtranglamviec" id="example-select">
                      <option <?php if ($nhanvien['bTinhTrangLamViec'] == 1) {
                                echo "Selected";
                              } ?> value="1">Đang Làm</option>
                      <option <?php if ($nhanvien['bTinhTrangLamViec'] == 0) {
                                echo "Selected";
                              } ?> value="0">Nghỉ Việc</option>
                    </select>
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-award fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Trình Độ Học Vấn</div>
                    <input class="form-control" type="text" name="trinhdohocvan" value="<?= esc($nhanvien['vTrinhDoHocVan']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-alert-triangle fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Tình Trạng Hôn Nhân</div>
                    <input class="form-control" type="text" name="tinhtranghonnhan" value="<?= esc($nhanvien['vTinhTrangHonNhan']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">BHYT</div>
                    <input class="form-control" name="bhyt" type="text" value="<?= esc($nhanvien['vBHYT']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">BHTN</div>
                    <input class="form-control" name="bhtn" type="text" value="<?= esc($nhanvien['vBHTN']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">BHXH</div>
                    <input class="form-control" name="bhxh" type="text" value="<?= esc($nhanvien['vBHXH']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-briefcase fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Địa chỉ</div>
                    <input class="form-control" type="text" name="diachi" value="<?= esc($nhanvien['vDiaChi']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-calendar fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold;">Ghi chú</div>
                    <input class="form-control" type="text" name="ghichu" value="<?= esc($nhanvien['vGhiChu']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Trình Độ Chuyên Môn</div>
                    <input class="form-control" type="text" name="trinhdochuyenmon" value="<?= esc($nhanvien['vTrinhDoChuyenMon']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->

              <input type="hidden" name="ma" value="<?= esc($nhanvien['nMaNV']) ?>">
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
<?php foreach ($nhanviens as $nhanvien) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="col-md-4 mb-4">
      <!-- Modal -->
      <div class="modal fade" id="xoanhanvien<?= esc($nhanvien['nMaNV']) ?>" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form method="post" action="/admin/nhanvien/xoanhanvien">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:red;font-weight:bold" class="modal-title" id="verticalModalTitle">Thông báo</h5>
              </div>
              <div class="modal-body"> Bạn có chắc muốn xóa nhân viên này! Khi xóa sẽ không thể hoàn tác </div>
              <input type="hidden" name="ma" value="<?= esc($nhanvien['nMaNV']) ?>">
              <input value="<?= esc($nhanvien['vImage']) ?>" name="image" type="hidden">

              <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="submit" name="xoanhanvien" class="btn mb-2 btn-primary">Đồng Ý</button>
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
  //   function onFileSelected(event) {
  //   var selectedFile = event.target.files[0];
  //   var reader = new FileReader();

  //   var imgtag = document.getElementById("myimage");
  //   imgtag.title = selectedFile.name;

  //   reader.onload = function(event) {
  //     imgtag.src = event.target.result;
  //   };

  //   reader.readAsDataURL(selectedFile);
  // }

  function onFileSelected2(event, id) {
    var selectedFile = event.target.files[0];
    var reader = new FileReader();

    var imgtag = document.getElementById(id);
    imgtag.title = selectedFile.name;

    reader.onload = function(event) {
      imgtag.src = event.target.result;
    };

    reader.readAsDataURL(selectedFile);
  }

  // var loadFile = function(event) {
  //     var reader = new FileReader();
  //     reader.onload = function(){
  //       var output = document.getElementById('output');
  //       output.src = reader.result;
  //     };
  //     reader.readAsDataURL(event.target.files[0]);
  //   };
</script>