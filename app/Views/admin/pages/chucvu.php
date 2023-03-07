<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <p id="addbutton" data-toggle="modal" style="display:<?php $session = session();
                                                            if ($session->get('s_role') == "admin" || $session->get('s_role') == "nhansu") {
                                                              echo "block";
                                                            } else {
                                                              echo "none";
                                                            }
                                                            ?>;" data-target="#themchucvu"><i id="iconadd" class="fe fe-24 fe-edit-2"></i></p>
      <h2 class="mb-2 page-title"><?= $title ?></h2>
      <p class="card-text">Thông tin tất cả chức vụ có trong công ty</p>
      <button type="button" class="btn mb-2 btn-info">
        <a style="color:white; text-decoration: none;" href="<?php echo base_url() ?>/admin/chucvu/print"><i class="fe fe-24 fe-printer"></i>Print</a>
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
                    <th style="color:gray">Mã Chức Vụ</th>
                    <th style="color:gray">Tên Chức Vụ</th>
                    <th style="color:gray">Phụ Cấp</th>
                    <th style="color:gray">Lương Chức Vụ</th>
                    <th style="color:gray">Ghi Chú</th>
                    <th style="color:gray">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($chucvus as $chucvu) { ?>
                    <tr>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($chucvu['nMaCV']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><strong><?= esc($chucvu['vTenCV']) ?></strong></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($chucvu['fPhuCap']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted" style="color:red !important"><?= esc($chucvu['nLuongCV']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($chucvu['vGhiChu']) ?></p>
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
                                                                                                ?>;" data-target="#suachucvu<?= esc($chucvu['nMaCV']) ?>">Sửa</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                if ($session->get('s_role') == "admin") {
                                                                                                  echo "block";
                                                                                                } else {
                                                                                                  echo "none";
                                                                                                }
                                                                                                ?>;" data-target="#xoachucvu<?= esc($chucvu['nMaCV']) ?>">Xóa</a>
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

  <div class="modal fade" id="themchucvu" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Thêm Chức Vụ</h2>
        </div>
        <form action="/admin/chucvu/themchucvu" method="post">
          <div class="row my-3 mx-3">
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Tên Chức Vụ</div>
                  <input class="form-control" type="text" name="ten" value="">
                </div>
              </div>
            </div> <!-- .col-md-->

            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Phụ Cấp</div>
                  <input class="form-control" type="number" name="phucap" value="">
                </div>
              </div>
            </div> <!-- .col-md-->

            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Lương Chức Vụ</div>
                  <input class="form-control" type="number" name="luongcv" value="">
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
                  <input class="form-control" type="text" name="ghichu" value="">
                </div>
              </div>
            </div> <!-- .col-md-->


          </div>
          <div class="modal-footer">
            <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
            <button type="submit" name="themchucvu" class="btn mb-2 btn-primary">Đồng Ý</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end thêm thông tin nhân viên modal -->
<!-- sủa thông tin nhân viên modal -->
<?php foreach ($chucvus as $chucvu) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="modal fade" id="suachucvu<?= esc($chucvu['nMaCV']) ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Sửa Chức Vụ</h2>
          </div>
          <form action="/admin/chucvu/suachucvu" method="post">
            <div class="row my-3 mx-3">
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Tên Chức Vụ</div>
                    <input class="form-control" name="ten" type="text" value="<?= esc($chucvu['vTenCV']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->

              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Phụ Cấp</div>
                    <input class="form-control" type="number" name="phucap" value="<?= esc($chucvu['fPhuCap']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->

              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Lương CV</div>
                    <input class="form-control" type="number" name="luongcv" value="<?= esc($chucvu['nLuongCV']) ?>">
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
                    <input class="form-control" type="text" name="ghichu" value="<?= esc($chucvu['vGhiChu']) ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <input class="form-control" type="hidden" name="ma" value="<?= esc($chucvu['nMaCV']) ?>">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
              <button type="submit" name="suachucvu" class="btn mb-2 btn-primary">Đồng Ý</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<!-- end sửa thông tin nhân viên modal -->
<!-- xóa thông tin nhân viên modal -->
<?php foreach ($chucvus as $chucvu) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="col-md-4 mb-4">
      <!-- Modal -->
      <div class="modal fade" id="xoachucvu<?= esc($chucvu['nMaCV']) ?>" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form action="/admin/chucvu/xoachucvu" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:red;font-weight:bold" class="modal-title" id="verticalModalTitle">Thông báo</h5>
              </div>
              <div class="modal-body"> Bạn có chắc muốn xóa chức vụ này! Khi xóa sẽ không thể hoàn tác </div>
              <input class="form-control" type="hidden" name="ma" value="<?= esc($chucvu['nMaCV']) ?>">
              <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="submit" name="xoachucvu" class="btn mb-2 btn-primary">Đồng Ý</button>
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