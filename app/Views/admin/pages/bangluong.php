<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <p id="addbutton" data-toggle="modal" style="display:<?php $session = session();
                                                            if ($session->get('s_role') == "admin" || $session->get('s_role') == "ketoan") {
                                                              echo "block";
                                                            } else {
                                                              echo "none";
                                                            }
                                                            ?>;" data-target="#thembangluong"><i id="iconadd" class="fe fe-24 fe-edit-2"></i></p>
      <h2 class="mb-2 page-title">Bảng Lương</h2>
      <p class="card-text">Thông tin bản lương tất cả nhân viên trong công ty</p>
      <button type="button" class="btn mb-2 btn-info">
        <a style="color:white; text-decoration: none;" href="<?php echo base_url() ?>/admin/bangluong/print"><i class="fe fe-24 fe-printer"></i>Print</a>
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
                    <th style="color:gray">Tên Nhân Viên</th>
                    <th style="color:gray">Số Ngày Công</th>
                    <th style="color:gray">Ngày Tính Lương</th>
                    <th style="color:gray">Thực Lĩnh</th>
                    <th style="color:gray">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $doanhthu = 0;
                  foreach ($bangluongs as $bangluong) {
                  ?>
                    <tr>


                      <td>
                        <p class="mb-0 text-muted"><?= esc($bangluong['nID']) ?></p>
                      </td>
                      <?php foreach ($nhanviens as $nhanvien) {
                        if ($bangluong['nMaNV'] == $nhanvien['nMaNV']) {
                      ?>
                          <td>
                            <p class="mb-0 text-muted"><?= esc($nhanvien['nMaNV']) ?></p>
                          </td>
                          <td>
                            <p class="mb-0 text-muted"><strong><?= esc($nhanvien['vTenNV']) ?></strong></p>
                          </td>
                      <?php }
                      } ?>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($bangluong['fSoNgayCong']) ?></p>
                      </td>
                      <td>
                        <p class="mb-0 text-muted"><?= esc($bangluong['dNgayTinhLuong']) ?></p>
                      </td>
                      <td>

                        <p class="mb-0 text-muted" style="color:red!important"><?= esc(ceil($bangluong['fThucLinh'])) ?></p>
                      </td>
                      <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="text-muted sr-only">Action</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#chitietbangluong<?php echo $bangluong['nID']; ?>">Chi Tiết</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" style="display:<?php $session = session();
                                                                                                if ($session->get('s_role') == "admin" ) {
                                                                                                  echo "block";
                                                                                                } else {
                                                                                                  echo "none";
                                                                                                }
                                                                                                ?>;" data-target="#xoabangluong<?php echo $bangluong['nID']; ?>">Xóa</a>
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

<!-- chi tiết bảng lương -->
<?php foreach ($bangluongs as $bangluong) {
?>
  <!-- chi tiết thông tin nhân viên modal -->
  <div class="card-body">
    <!-- Extra large modal -->

    <div class="modal fade" id="chitietbangluong<?php echo $bangluong['nID'];  ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Chi Tiết Bảng Lương</h2>
          </div>
          <form action="" method="post">
            <div class="row my-3 mx-3">
              <div class="col-md-3 my-3">
                <div class="row">
                  <div class="col-2">
                    <i style="color: grey !important;" class="fe fe-user fe-24 text-primary"></i>
                  </div>
                  <div class="col-10">
                    <div style="font-weight:bold">Mã Nhân Viên</div>
                    <input class="form-control" type="text" value="<?php echo $bangluong['nMaNV'];  ?>">
                  </div>
                </div>
              </div> <!-- .col-md-->
              <?php foreach ($nhanviens as $nhanvien) {
                if ($bangluong['nMaNV'] == $nhanvien['nMaNV']) {

              ?>
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Tên Nhân Viên</div>

                        <input class="form-control" type="text" value="<?php echo $bangluong['vTenNV'];  ?>">
                    <?php }
                } ?>
                      </div>
                    </div>
                  </div> <!-- .col-md-->
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Phòng Ban</div>

                        <input class="form-control" type="text" value="<?php foreach ($phongbans as $phongban) {
                                                                          if ($phongban['nMaPB'] == $bangluong['nMaPB']) {
                                                                            echo $phongban['vTenPB'];
                                                                          }
                                                                        } ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Chức Vụ</div>

                        <input class="form-control" type="text" value="<?php foreach ($chucvus as $chucvu) {
                                                                          if ($chucvu['nMaCV'] == $bangluong['nMaCV']) {
                                                                            echo $chucvu['vTenCV'];
                                                                          }
                                                                        } ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->




                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-users fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Tiền Lương</div>
                        <input class="form-control" type="number" value="<?php echo $bangluong['fLuongCB'];  ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Số Ngày Công</div>
                        <input class="form-control" type="number" value="<?php echo $bangluong['fSoNgayCong'] ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-credit-card fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Số Giờ Tăng Ca</div>
                        <input class="form-control" type="number" value="<?php echo $bangluong['fGioTangCa'] ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Phụ Cấp</div>
                        <input class="form-control" type="number" value="<?php echo $bangluong['fPhuCap'] ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Các Khoản Chi Bảo Hiểm</div>

                        <input class="form-control" type="number" value="<?php echo $bangluong['fCacKhoanChiBH']; ?>">
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
                        <input class="form-control" type="number" value="<?php echo $bangluong['fDoanhThu']; ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Thưởng</div>
                        <input class="form-control" type="number" value="<?php echo $bangluong['fThuong']; ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->

                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Thực Lĩnh</div>
                        <input class="form-control" type="number" value="<?php echo $bangluong['fLuongCB'] - $bangluong['fCacKhoanChiBH'] ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->
                  <div class="col-md-3 my-3">
                    <div class="row">
                      <div class="col-2">
                        <i style="color: grey !important;" class="fe fe-book fe-24 text-primary"></i>
                      </div>
                      <div class="col-10">
                        <div style="font-weight:bold">Ngày Tính Lương</div>
                        <input class="form-control" type="date" value="<?php echo $bangluong['dNgayTinhLuong'] ?>">
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
                        <input class="form-control" type="text" value="<?php echo $bangluong['vGhiChu'] ?>">
                      </div>
                    </div>
                  </div> <!-- .col-md-->


            </div>
            <div class="modal-footer">
              <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end chi tiết thông tin nhân viên modal -->
<?php } ?>
<!-- end chi tiết bảng lương -->
<!-- thêm thông tin bảng lương modal -->
<div class="card-body">
  <!-- Extra large modal -->

  <div class="modal fade" id="thembangluong" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h2 class="col p-2 bg-danger-dark" style="color:white;font-size:35px;text-align:center">Tính Lương</h2>
        </div>
        <form action="/admin/bangluong/tinhluong" method="post">
          <div class="row my-3 mx-3">
            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-2">
                  <i style="color: grey !important;" class="fe fe-user fe-24 text-primary"></i>
                </div>
                <div class="col-10">

                  <div style="font-weight:bold;">Nhân Viên</div>
                  <select class="form-control" name="manhanvien" id="example-select">
                    <?php foreach ($chuatinhluongs as $chuatinhluong) { ?>
                      <option value="<?php echo $chuatinhluong['nMaNV'] ?>"><?php echo $chuatinhluong['vTenNV'] ?></option>

                    <?php
                    } ?>
                  </select>

                </div>
              </div>
            </div> <!-- .col-md-->

            <div class="col-md-3 my-3">
              <div class="row">
                <div class="col-12">
                  <div style="font-weight:bold">Ngày Tháng</div>
                  <input class="form-control" disabled type="date" value="<?php
                                                                          date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                          echo $date = date('Y-m-d'); ?>">
                  <input class="form-control" name="thoigian" type="hidden" value="<?php
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
            <button type="submit" name="thembanluong" class="btn mb-2 btn-primary" <?php
                                                                                    if (count($chuatinhluongs) == 0) {
                                                                                      echo "disabled";
                                                                                    }
                                                                                    $thang = getdate();
                                                                                    if (4 >= $thang['mday'] && $thang['mday'] > 7) {
                                                                                      echo "disabled";
                                                                                    }

                                                                                    ?>>Đồng Ý</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end thêm thông tin bảng lương modal -->

<!-- xóa thông tin bảng lương modal -->
<?php foreach ($bangluongs as $bangluong) { ?>
  <div class="card-body">
    <!-- Extra large modal -->
    <div class="col-md-4 mb-4">
      <!-- Modal -->
      <div class="modal fade" id="xoabangluong<?php echo $bangluong['nID'];  ?>" tabindex="-1" role="dialog" aria-labelledby="verticalModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <form action="/admin/bangluong/xoabangluong" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:red;font-weight:bold" class="modal-title" id="verticalModalTitle">Thông báo</h5>
              </div>
              <input type="hidden" name="id" value="<?php echo $bangluong['nID'];  ?>">
              <div class="modal-body"> Bạn có chắc muốn xóa bảng lương nhân viên này! Khi xóa sẽ không thể hoàn tác </div>
              <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="submit" name="xoabangluong" class="btn mb-2 btn-primary">Đồng Ý</button>
              </div>
            </div>
          </form>
        </div>
      </div>


    </div>
  </div>
<?php } ?>
<!-- end xóa thông tin bảng lương modal -->


<style>
  #addbutton {
    border-radius: 15px;
    background-color: #2E8B57;
    width: 60px;
    height: 50px;
    line-height: 60px;
    margin-left: 940px;
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
</main>

<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/simplebar.min.js"></script>
<script src='js/daterangepicker.js'></script>
<script src='js/jquery.stickOnScroll.js'></script>
<script src="js/tinycolor-min.js"></script>
<script src="js/config.js"></script>
<script src='js/jquery.dataTables.min.js'></script>
<script src='js/dataTables.bootstrap4.min.js'></script>
<script>
  $('#dataTable-1').DataTable({
    autoWidth: true,
    "lengthMenu": [
      [16, 32, 64, -1],
      [16, 32, 64, "All"]
    ]
  });
</script>
<script src="js/apps.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'UA-56159088-1');
</script>
<script src='js/jquery.mask.min.js'></script>
<script src='js/select2.min.js'></script>
<script src='js/jquery.steps.min.js'></script>
<script src='js/jquery.validate.min.js'></script>
<script src='js/jquery.timepicker.js'></script>
<script src='js/dropzone.min.js'></script>
<script src='js/uppy.min.js'></script>
<script src='js/quill.min.js'></script>
<script>
  $('.select2').select2({
    theme: 'bootstrap4',
  });
  $('.select2-multi').select2({
    multiple: true,
    theme: 'bootstrap4',
  });
  $('.drgpicker').daterangepicker({
    singleDatePicker: true,
    timePicker: false,
    showDropdowns: true,
    locale: {
      format: 'MM/DD/YYYY'
    }
  });
  $('.time-input').timepicker({
    'scrollDefault': 'now',
    'zindex': '9999' /* fix modal open */
  });
  /** date range picker */
  if ($('.datetimes').length) {
    $('.datetimes').daterangepicker({
      timePicker: true,
      startDate: moment().startOf('hour'),
      endDate: moment().startOf('hour').add(32, 'hour'),
      locale: {
        format: 'M/DD hh:mm A'
      }
    });
  }
  var start = moment().subtract(29, 'days');
  var end = moment();

  function cb(start, end) {
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  }
  $('#reportrange').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
  }, cb);
  cb(start, end);
  $('.input-placeholder').mask("00/00/0000", {
    placeholder: "__/__/____"
  });
  $('.input-zip').mask('00000-000', {
    placeholder: "____-___"
  });
  $('.input-money').mask("#.##0,00", {
    reverse: true
  });
  $('.input-phoneus').mask('(000) 000-0000');
  $('.input-mixed').mask('AAA 000-S0S');
  $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
    translation: {
      'Z': {
        pattern: /[0-9]/,
        optional: true
      }
    },
    placeholder: "___.___.___.___"
  });
  // editor
  var editor = document.getElementById('editor');
  if (editor) {
    var toolbarOptions = [
      [{
        'font': []
      }],
      [{
        'header': [1, 2, 3, 4, 5, 6, false]
      }],
      ['bold', 'italic', 'underline', 'strike'],
      ['blockquote', 'code-block'],
      [{
          'header': 1
        },
        {
          'header': 2
        }
      ],
      [{
          'list': 'ordered'
        },
        {
          'list': 'bullet'
        }
      ],
      [{
          'script': 'sub'
        },
        {
          'script': 'super'
        }
      ],
      [{
          'indent': '-1'
        },
        {
          'indent': '+1'
        }
      ], // outdent/indent
      [{
        'direction': 'rtl'
      }], // text direction
      [{
          'color': []
        },
        {
          'background': []
        }
      ], // dropdown with defaults from theme
      [{
        'align': []
      }],
      ['clean'] // remove formatting button
    ];
    var quill = new Quill(editor, {
      modules: {
        toolbar: toolbarOptions
      },
      theme: 'snow'
    });
  }
  var editor = document.getElementById('editor2');
  if (editor) {
    var toolbarOptions = [
      [{
        'font': []
      }],
      [{
        'header': [1, 2, 3, 4, 5, 6, false]
      }],
      ['bold', 'italic', 'underline', 'strike'],
      ['blockquote', 'code-block'],
      [{
          'header': 1
        },
        {
          'header': 2
        }
      ],
      [{
          'list': 'ordered'
        },
        {
          'list': 'bullet'
        }
      ],
      [{
          'script': 'sub'
        },
        {
          'script': 'super'
        }
      ],
      [{
          'indent': '-1'
        },
        {
          'indent': '+1'
        }
      ], // outdent/indent
      [{
        'direction': 'rtl'
      }], // text direction
      [{
          'color': []
        },
        {
          'background': []
        }
      ], // dropdown with defaults from theme
      [{
        'align': []
      }],
      ['clean'] // remove formatting button
    ];
    var quill = new Quill(editor, {
      modules: {
        toolbar: toolbarOptions
      },
      theme: 'snow'
    });
  }
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->

</body>

</html>