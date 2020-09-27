<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SI-Absensi Barcode</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "component/navbar.php" ?>
  <!-- /.navbar -->

   <?php include "component/aside.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include "component/page-header.php" ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Isi Data Info Aplikasi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                $action = $_GET['action'];
                if($action == 'edit'){
                    $id = '1';
                    $sql = mysqli_query($conn, "SELECT * FROM info WHERE id_info = '$id'");
                    $data = mysqli_fetch_array($sql);
                    $kabar_fitur_info = $data['kabar_fitur_info'];
                    $cara_penggunaan_info = $data['cara_penggunaan_info'];
                    $informasi_aplikasi_info = $data['informasi_aplikasi_info'];
                    $logo_info = $data['logo_info'];
                    $title = "Edit";
                    if($logo_info == ''){
                      $src_logo_info = "dist/img/user2-160x160.jpg";
                    }else{
                      $src_logo_info = "upload/".$logo_info."";
                    }
                }  
              ?>
              <form action="proses/info.php?action=<?php echo $action ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <?php
                  if($action == 'edit'){
                  ?>
                    <input type="hidden" class="form-control" name="id_info" id="id_info" value="<?php echo $id ?>" readonly>
                  <?php
                  }
                  ?>
                  <div class="image">
                    <p style="text-align: center;">
                    <img style="width: 160px" src="<?php echo $src_logo_info ?>" id="tampil_logo_info" class="img-circle elevation-2" alt="User Image">
                    </p>
                  </div>
                  <div class="form-group">
                    <label for="logo_info">Logo Info (Ukuran Foto 160px x 160px)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="logo_info" id="logo_info">
                        <label class="custom-file-label" for="logo_info">Pilih Logo</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                     <label>Informasi Fitur</label>
                     <textarea class="form-control" name="kabar_fitur_info" id="kabar_fitur_info" rows="3" placeholder="Informasi Fitur, Gunakan <br> untuk penulisan ganti baris..."><?php echo $kabar_fitur_info ?></textarea>
                  </div>
                  <div class="form-group">
                     <label>Cara Penggunan</label>
                     <textarea class="form-control" name="cara_penggunaan_info" id="cara_penggunaan_info" rows="3" placeholder="Cara Penggunan, Gunakan <br> untuk penulisan ganti baris..."><?php echo $cara_penggunaan_info ?></textarea>
                  </div>
                  <div class="form-group">
                     <label>Informasi Aplikasi</label>
                     <textarea class="form-control" name="informasi_aplikasi_info" id="informasi_aplikasi_info" rows="3" placeholder="Informasi Aplikasi, Gunakan <br> untuk penulisan ganti baris..."><?php echo $informasi_aplikasi_info ?></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include "component/footer.php" ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
  $('document').ready(function () {
        $("#logo_info").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil_logo_info').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
  });
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!-- <script src="plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<!-- <script src="plugins/jqvmap/jquery.vmap.min.js"></script> -->
<!-- <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
