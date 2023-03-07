<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <p id="addbutton" data-toggle="modal" data-target="#themtaikhoan"><i id="iconadd" class="fe fe-24 fe-edit-2"></i></p>
      <h2 class="mb-2 page-title"><?= $title ?></h2>
      <p class="card-text">Thông tin toàn bộ tài khoản trong công ty</p>

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
                    <th style="color:gray">ID</th>
                    <th style="color:gray">UserName</th>
                    <th style="color:gray">Email</th>
                    <th style="color:gray">Password</th>
                    <th style="color:gray">Role</th>
                    <th style="color:gray">Action</th>
                  </tr>

                </thead>
                <tbody>
                  <?php

                  use App\Controllers\Admin\ChucVu;

                  foreach ($taikhoans as $taikhoan) { ?>
                    <tr>
                      <td>
                        <div class="avatar avatar-md">
                          <img src="../../../../assets/avatars/<?= esc($taikhoan['vImageLogin']) ?>" alt="..." class="avatar-img rounded-circle">
                        </div>
                      </td>

                      <td>
                        <p class="mb-0 text-muted"><?= esc($taikhoan['nID']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><strong><?= esc($taikhoan['vUserName']) ?></strong></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($taikhoan['vEmail']) ?> </p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($taikhoan['vPassword']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($taikhoan['vRole']) ?></p>
                      </td>

                      <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#suataikhoan<?= esc($taikhoan['nID']) ?>">Sửa</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#xoataikhoan<?= esc($taikhoan['nID']) ?>">Xóa</a>

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

  <div class="modal fade" id="themtaikhoan" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Thêm Tài Khoản</h2>
        </div>
        <form method="post" action="/admin/taikhoan/themtaikhoan" enctype="multipart/form-data">
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
                  <h4 class="mb-1">UserName <input class="form-control" required type="text" name="username" value=""></h4>
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
                  <div style="font-weight:bold;">Email</div>
                  <input class="form-control" name="mail" required type="mail">
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-phone fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold">Password</div>
                  <input class="form-control" name="password" type="password" id="custom-phone">
                </div>
              </div>
            </div> <!-- .col-md-->
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                </div>
                <div class="col-10">
                  <div style="font-weight:bold;">Role</div>

                  <select class="form-control" name="role" id="example-select">
                    <option value="admin">Admin
                    </option>
                    <option value="giamdoc">Giám Đốc
                    </option>
                    <option value="nhansu">Nhân Sự
                    </option>
                    <option value="ketoan">Kế Toán
                    </option>
                  </select>

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
<!-- sủa thông tin tài khoản modal -->
<?php foreach ($taikhoans as $taikhoan) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="modal fade" id="suataikhoan<?= esc($taikhoan['nID']) ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Sửa Thông Tin</h2>
          </div>
          <form action="/admin/taikhoan/suataikhoan" method="post" enctype="multipart/form-data">
            <div class="row mt-5 align-items-center">
              <div class="col-md-6 text-center mb-6">
                <div class="avatar avatar-xl">
                  <img src="../../../../assets/avatars/<?= esc($taikhoan['vImageLogin']) ?>" id="myimage2<?= esc($taikhoan['nID']) ?>" alt="..." style="height:300px;width:200px;margin-left:30px;margin-bottom:20px;object-fit:contain">
                  <input style="margin-left: 10px;font-size:10px;margin-top:10px;" onchange="onFileSelected2(event, 'myimage2<?= esc($taikhoan['nID']) ?>')" name="image" type="file">
                  <input style="margin-left: 10px;font-size:10px;margin-top:10px;" value="<?= esc($taikhoan['vImageLogin']) ?>" name="oldimage" type="hidden">
                </div>
              </div>
              <div class="col">
                <div class="row align-items-center">
                  <div class="col-md-10">
                    <h4 class="mb-1">UserName<input class="form-control" type="text" name="username" value="<?= esc($taikhoan['vUserName']) ?>"></h4>
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
                    <div style="font-weight:bold;">Email</div>
                    <input class="form-control" value="<?= esc($taikhoan['vEmail']) ?>" name="email" required type="mail">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-phone fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Password</div>
                    <input class="form-control" value="<?= esc($taikhoan['vPassword']) ?>" name="password" type="password" id="custom-phone">
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

                      <option <?php if ($taikhoan['vRole'] == "admin") {
                                echo "Selected";
                              } ?> value="admin">Admin
                      </option>
                      <option <?php if ($taikhoan['vRole'] == "giamdoc") {
                                echo "Selected";
                              } ?> value="giamdoc">Giám Đốc
                      </option>
                      <option <?php if ($taikhoan['vRole'] == "nhansu") {
                                echo "Selected";
                              } ?> value="nhansu">Nhân Sự
                      </option>
                      <option <?php if ($taikhoan['vRole'] == "ketoan") {
                                echo "Selected";
                              } ?> value="ketoan">Kế Toán
                      </option>

                    </select>

                  </div>
                </div>
              </div> <!-- .col-md-->
              <input type="hidden" name="id" value="<?= esc($taikhoan['nID']) ?>">
            </div>
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
<!-- end sửa thông tin tài khoản modal -->
<!-- xóa thông tin nhân viên modal -->
<?php foreach ($taikhoans as $taikhoan) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="col-md-4 mb-4">
      <!-- Modal -->
      <div class="modal fade" id="xoataikhoan<?= esc($taikhoan['nID']) ?>" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form method="post" action="/admin/taikhoan/xoataikhoan">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:red;font-weight:bold" class="modal-title" id="verticalModalTitle">Thông báo</h5>
              </div>
              <div class="modal-body"> Bạn có chắc muốn xóa tài khoản này! Khi xóa sẽ không thể hoàn tác </div>
              <input type="hidden" name="id" value="<?= esc($taikhoan['nID']) ?>">
              <input value="<?= esc($taikhoan['vImageLogin']) ?>" name="image" type="hidden">

              <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="submit" name="" class="btn mb-2 btn-primary">Đồng Ý</button>
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