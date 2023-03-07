<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">
  <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="/css/simplebar.css">
  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro" rel="stylesheet">
  <!-- Icons CSS -->
  <link rel="stylesheet" href="/css/feather.css">
  <link rel="stylesheet" href="/css/select2.css">
  <link rel="stylesheet" href="/css/dropzone.css">
  <link rel="stylesheet" href="/css/uppy.min.css">
  <link rel="stylesheet" href="/css/jquery.steps.css">
  <link rel="stylesheet" href="/css/jquery.timepicker.css">
  <link rel="stylesheet" href="/css/quill.snow.css">
  <!-- Date Range Picker CSS -->
  <link rel="stylesheet" href="/css/daterangepicker.css">
  <!-- App CSS -->
  <link rel="stylesheet" href="/css/app-light.css" id="lightTheme">
  <link rel="stylesheet" href="/css/app-dark.css" id="darkTheme" disabled>
  <link rel="stylesheet" href="/css/dataTables.bootstrap4.css">



</head>

<body class="vertical  light">
  <div class="wrapper">
    <nav class="topnav navbar navbar-light">
      <?= $left ?>
    </nav>
    <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
      <?= $head ?>
    </aside>
  </div> <!-- .wrapper -->
  <main role="main" class="main-content">
    <?= $content ?>

    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="defaultModalLabel" style="text-align:center !important">Thông Tin Tài Khoản</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php $session = session();

            if (empty($session->get('s_username'))) {
            ?>
              <script>
                window.location.assign("/admin/login")
              </script>
            <?php
            } else {

            ?>
          <form method="post" action="/admin/doimatkhau" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row mt-8 align-items-center">
                <div class="col-md-5 text-center mb-5">
                  <div class="avatar avatar-xl">
                    <img src="../../../../assets/avatars/<?php echo $session->get('s_image'); ?>" alt="..." id="myimage" class="avatar-img rounded-circle">
                    <input style="margin-left: 10px;font-size:10px;margin-top:20px;" size="" onchange="onFileSelected2(event,'myimage')" name="image" type="file">
                    <input  name="oldimage" value="<?php echo $session->get('s_image'); ?>" type="hidden">

                  </div>
                </div>
                <div class="col">
                  <div class="row align-items-center">
                    <div class="col-md-7">
                      <h4 class="mb-1"><?php echo $session->get('s_username'); ?></h4>
                      <input type="hidden" value="<?php echo $session->get('s_username'); ?>" name="username">
                      <p class="small mb-3"><span class="badge badge-dark"><?php echo $session->get('s_mail'); ?></span></p>
                      <input type="hidden" value="<?php echo $session->get('s_mail'); ?>" name="mail">
                    </div>
                  </div>
                </div>
              </div>

              <div style="margin-left:30px" class="row mt-8 align-items-center">
                <div class="col-md-5 text-center mb-5">
                  <div class="avatar avatar-xl">
                    <div>Mật Khẩu Cũ</div>
                    <input class="form-control" name="oldpassword" value="<?php echo $session->get('s_password'); ?>" type="password">
                  </div>
                </div>
                <div class="col-md-5 text-center mb-5">
                  <div class="avatar avatar-xl">
                    <div>Mật Khẩu Mới</div>
                    <input required class="form-control" name="newpassword" type="password">
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $session->get('s_id'); ?>">
            <div class="modal-footer">
              <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn mb-2 btn-primary">Save changes</button>
            </div>
          </form>
          <?php }?> 
        </div>
      </div>
    </div>
  </main>

  <script src="/js/jquery.min.js"></script>
  <script src="/js/popper.min.js"></script>
  <script src="/js/moment.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/simplebar.min.js"></script>
  <script src='/js/daterangepicker.js'></script>
  <script src='/js/jquery.stickOnScroll.js'></script>
  <script src="/js/tinycolor-min.js"></script>
  <script src="/js/config.js"></script>
  <script src='/js/jquery.dataTables.min.js'></script>
  <script src='/js/dataTables.bootstrap4.min.js'></script>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="></script>

  <script>
    $('#dataTable-1').DataTable({
      autoWidth: true,
      "lengthMenu": [
        [16, 32, 64, -1],
        [16, 32, 64, "All"]
      ]
    });
  </script>
  <script src="/js/apps.js"></script>
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
  <script src='/js/jquery.mask.min.js'></script>
  <script src='/js/select2.min.js'></script>
  <script src='/js/jquery.steps.min.js'></script>
  <script src='/js/jquery.validate.min.js'></script>
  <script src='/js/jquery.timepicker.js'></script>
  <script src='/js/dropzone.min.js'></script>
  <script src='/js/uppy.min.js'></script>
  <script src='/js/quill.min.js'></script>
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

  <script>
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
  </script>
</body>

</html>