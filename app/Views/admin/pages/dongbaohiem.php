<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <h2 class="mb-2 page-title"><?= $title ?></h2>
      <p class="card-text">Thông tin đóng bảo hiểm của tất cả nhân viên trong công ty </p>
      <button type="button" class="btn mb-2 btn-info">
        <a style="color:white; text-decoration: none;" href="<?php echo base_url() ?>/admin/dongbaohiem/print"><i class="fe fe-24 fe-printer"></i>Print</a>
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
                    <th style="color:gray">BHYT</th>
                    <th style="color:gray">BHTN</th>
                    <th style="color:gray">BHXH</th>
                    <th style="color:gray">Số Tiền</th>
                    <th style="color:gray">Ngày Đóng</th>

                    <th style="color:gray">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dongbaohiems as $dongbaohiem) { ?>
                    <tr>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($dongbaohiem['nID']) ?></p>
                      </td>
                      <?php foreach ($nhanviens as $nhanvien) {
                        if ($dongbaohiem['nMaNV'] == $nhanvien['nMaNV']) {

                      ?>
                          <td>
                            <p class="mb-0 text-muted"><strong><?= esc($nhanvien['vTenNV']) ?></strong></p>
                          </td>
                          <td>
                            <p class="mb-0 text-muted"><?= esc($nhanvien['vBHYT']) ?></p>
                          </td>
                          <td>
                            <p class="mb-0 text-muted"><?= esc($nhanvien['vBHTN']) ?></p>
                          </td>
                          <td>
                            <p class="mb-0 text-muted"><?= esc($nhanvien['vBHXH']) ?></p>
                          </td>
                      <?php }
                      } ?>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($dongbaohiem['nTienDongBH']) ?></p>
                      </td>

                      <td>
                        <p class="mb-0 text-muted"><?= esc($dongbaohiem['dThoiGianDong']) ?></p>
                      </td>


                      <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                if ($session->get('s_role') == "admin") {
                                                                                                  echo "block";
                                                                                                } else {
                                                                                                  echo "none";
                                                                                                }
                                                                                                ?>;" data-target="#xoadongbaohiem<?= esc($dongbaohiem['nID']) ?>">Xóa</a>
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

<!-- xóa thông tin nhân viên modal -->
<?php foreach ($dongbaohiems as $dongbaohiem) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="col-md-4 mb-4">
      <!-- Modal -->
      <div class="modal fade" id="xoadongbaohiem<?= esc($dongbaohiem['nID']) ?>" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form action="/admin/dongbaohiem/xoadongbaohiem" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:red;font-weight:bold" class="modal-title" id="verticalModalTitle">Thông báo</h5>
              </div>
              <div class="modal-body"> Bạn có chắc muốn xóa thông tin đóng bảo hiểm này! Khi xóa sẽ không thể hoàn tác </div>
              <input class="form-control" type="hidden" name="id" value="<?= esc($dongbaohiem['nID']) ?>">
              <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="submit" name="xoadongbaohiem" class="btn mb-2 btn-primary">Đồng Ý</button>
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