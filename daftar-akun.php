<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include "connection/config.php";
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Akun</title>
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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 
    <section class="content">
      <div class="container-fluid">
        <br>
        <div class="image">
          <?php
            $sql = mysqli_query($conn, "SELECT * FROM info WHERE id_info = '1'");
            $data = mysqli_fetch_array($sql);
          ?>
          <p style="text-align: center;">
          <img style="width: 160px" src="upload/<?php echo $data['logo_info'] ?>" class="img-circle elevation-2" alt="User Image">
          </p>
          <?php
          $action = "adddaftar";
          $sd = "panitia";
          ?>
        </div>
        <!-- Small boxes (Stat box) -->
             <form action="proses/pengguna.php?action=<?php echo $action ?>&sd=<?php echo $sd ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <p style="text-align: center;"><label for="nama_pengguna">Nama</label></p>
                    <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" placeholder="Nama Pengguna">
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="tempat_lahir_pengguna">Tempat Lahir</label></p>
                    <input type="text" class="form-control" name="tempat_lahir_pengguna" id="tempat_lahir_pengguna" placeholder="Tempat Lahir">
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="tanggal_lahir_pengguna">Tanggal Lahir</label></p>
                    <input type="date" class="form-control" name="tanggal_lahir_pengguna" id="tanggal_lahir_pengguna" placeholder="Tanggal Lahir">
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="no_hp_pengguna">Nomor HP</label></p>
                    <input type="text" class="form-control" name="no_hp_pengguna" id="no_hp_pengguna" placeholder="Nomor HP">
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="email_pengguna">Email</label></p>
                    <input type="text" class="form-control" name="email_pengguna" id="email_pengguna"  placeholder="Email">
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="password_pengguna">Password</label><p style="text-align: center;">
                    <input type="password" class="form-control" name="password_pengguna" id="password_pengguna" placeholder="Password">
                  </div>
                  <div class="form-group">
                     <p style="text-align: center;"><label>Alamat</label></p>
                     <textarea class="form-control" name="alamat_pengguna" id="alamat_pengguna" rows="3" placeholder="Alamat..."></textarea>
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="instansi_pengguna">Instansi</label><p style="text-align: center;">
                    <input type="text" class="form-control" name="instansi_pengguna" id="instansi_pengguna" placeholder="Instansi">
                  </div>
                  <div class="image">
                    <p style="text-align: center;">
                    <img style="width: 160px" src="dist/img/user2-160x160.jpg" id="tampil_foto_pengguna" class="img-circle elevation-2" alt="User Image">
                    </p>
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="foto_pengguna">Foto</label><p style="text-align: center;">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto_pengguna" id="foto_pengguna">
                        <label class="custom-file-label" for="foto_pengguna">Pilih Foto</label>
                      </div>
                    </div>
                  </div>
                  <div class="image">
                    <p style="text-align: center;">
                    <img style="width: 160px" src="dist/img/user2-160x160.jpg" id="tampil_logo_instansi" class="img-circle elevation-2" alt="User Image">
                    </p>
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="logo_instansi_pengguna">Logo Instansi</label><p style="text-align: center;">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="logo_instansi_pengguna" id="logo_instansi_pengguna">
                        <label class="custom-file-label" for="logo_instansi_pengguna">Pilih Logo</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <p style="text-align: center;">
                  <button type="submit" class="btn btn-primary">Daftar</button>
                  </p>
                </div>
              </form>
      </div>
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
        $("#foto_pengguna").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil_foto_pengguna').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
  });
  $('document').ready(function () {
        $("#logo_instansi_pengguna").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil_logo_instansi').attr('src', e.target.result);
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
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
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
