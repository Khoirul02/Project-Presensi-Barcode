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
                <?php
                $action = $_GET['action'];
                $sd = $_GET['sd'];
                if($sd == 'admin'){
                  $title = "Admin";  
                }else{
                  $title = "Pantia";
                }
              ?>
                <h3 class="card-title">Perizianan Kuota Tamu <?php echo $title; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="proses/pengguna.php?action=<?php echo $action ?>&sd=<?php echo $sd ?>" method="post">
                <div class="card-body">
                    <div class="form-group">
                      <label><?php echo $title; ?> / Kuota Tamu Sebelumnya</label>
                        <select class="custom-select" name="id_pengguna" id="id_pengguna">
                          <option>Pilih <?php echo $title; ?></option>
                          <?php
                          if($sd == 'admin'){
                            $sql = mysqli_query($conn, "SELECT * FROM pengguna WHERE status_pengguna='admin'");
                          }else{
                            $sql = mysqli_query($conn, "SELECT * FROM pengguna WHERE status_pengguna='panitia'");
                          }
                          while ($option = mysqli_fetch_array($sql)) {
                              $id_pengguna_option = $option['id_pengguna'];
                              $nama_pengguna_option = $option['nama_pengguna'];
                              $kuota_perizinan_pengguna_option = $option['kuota_perizinan_pengguna'];
                              if($kuota_perizinan_pengguna_option >= '800'){
                                $tanda_option = "> 800";
                              }else{
                                $tanda_option = "< ".$kuota_perizinan_pengguna_option;
                              }
                              ?>
                                <option value="<?php echo $id_pengguna_option ?>"><?php echo $nama_pengguna_option; ?> / Kuota <?php echo $tanda_option; ?></option>           
                              <?php
                              }
                              ?>
                        </select>
                  </div>
                  <div class="form-group">
                      <label>Jumlah Kuota</label>
                        <select class="custom-select" name="kuota_perizinan_pengguna">
                          <option>Pilih Kuota Tamu</option>
                          <option value="25">Jumlah Tamu < 25 </option>
                          <option value="50">Jumlah Tamu < 50 </option>
                          <option value="100">Jumlah Tamu < 100 </option>
                          <option value="200">Jumlah Tamu < 200 </option>
                          <option value="400">Jumlah Tamu < 400 </option>
                          <option value="800">Jumlah Tamu < 800 </option>
                          <option value="10000">Jumlah Tamu > 800  </option>
                        </select>
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
