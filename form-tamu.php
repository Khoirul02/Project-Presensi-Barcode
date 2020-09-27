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
            <?php
            if($_SESSION['status_pengguna'] == 'panitia'){
            ?>
            <br>
            <?php
            }
            ?>
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Isi Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                $action = $_GET['action'];
                $id_acara = $_GET['id_acara'];
                if($action == 'edit'){
                  $id = $_GET['id'];
                  $sql = mysqli_query($conn, "SELECT * FROM tamu WHERE id_tamu = '$id'");
                  $data = mysqli_fetch_array($sql);
                  $query_no = mysqli_query($conn, "SELECT * FROM tamu WHERE id_acara='$id_acara'");
                  $no = mysqli_num_rows($query_no);
                  $nama_tamu = $data['nama_tamu'];
                  $alamat_tamu = $data['alamat_tamu'];
                  $no_hp_tamu = $data['no_hp_tamu'];
                  $email_tamu = $data['email_tamu'];
                  $instansi_tamu = $data['instansi_tamu'];
                  $keterangan_lain_tamu = $data['keterangan_lain_tamu'];
                  $status_kehadiran_tamu = $data['status_kehadiran_tamu'];
                }else{
                  $query_no = mysqli_query($conn, "SELECT * FROM tamu WHERE id_acara='$id_acara'");
                  $no = mysqli_num_rows($query_no);
                  $no_urut = $no + 1;
                  $id_tamu = $id_acara."-".$no_urut;  
                  $nama_tamu = "";
                  $alamat_tamu = "";
                  $no_hp_tamu = "";
                  $email_tamu = "";
                  $instansi_tamu = "";
                  $keterangan_lain_tamu = "";
                }
              ?>
              <form action="proses/tamu.php?action=<?php echo $action?>&id_acara=<?php echo $_GET['id_acara'] ?>" method="post">
                <div class="card-body">
                  <?php
                  if($action == 'edit'){
                  ?>
                  <input type="hidden" class="form-control" name="id_acara" id="id_acara" value="<?php echo $id_acara ?>" readonly>
                  <input type="hidden" class="form-control" name="status_kehadiran_tamu" id="status_kehadiran_tamu" value="<?php echo $status_kehadiran_tamu ?>" readonly>
                  <div class="form-group">
                    <label for="id_tamu">ID Tamu</label>
                    <input type="text" class="form-control" name="id_tamu" id="id_tamu" value="<?php echo $id ?>" readonly>
                  </div>
                  <?php
                  }else{
                  ?>
                  <input type="hidden" class="form-control" name="id_acara" id="id_acara" value="<?php echo $id_acara ?>" readonly>
                  <div class="form-group">
                    <label for="id_tamu">ID Tamu</label>
                    <input type="text" class="form-control" name="id_tamu" id="id_tamu" value="<?php echo $id_tamu ?>" readonly>
                  </div>
                  <?php
                  }
                  ?>
                  <div class="form-group">
                    <label for="nama_tamu">Nama</label>
                    <input type="text" class="form-control" name="nama_tamu" id="nama_tamu" value="<?php echo $nama_tamu ?>" placeholder="Nama Tamu">
                  </div>
                  <div class="form-group">
                     <label>Alamat</label>
                     <textarea class="form-control" name="alamat_tamu" id="alamat_tamu" rows="3" placeholder="Alamat..."><?php echo $alamat_tamu ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="no_hp_tamu">Nomor HP</label>
                    <input type="text" class="form-control" name="no_hp_tamu" id="no_hp_tamu" value="<?php echo $no_hp_tamu ?>" placeholder="Nomor HP">
                  </div>
                  <div class="form-group">
                    <label for="email_tamu">Email</label>
                    <input type="text" class="form-control" name="email_tamu" id="email_tamu" value="<?php echo $email_tamu ?>" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="instansi_tamu">Instansi</label>
                    <input type="text" class="form-control" name="instansi_tamu" id="instansi_tamu" value="<?php echo $instansi_tamu ?>" placeholder="Instansi">
                  </div>
                  <div class="form-group">
                     <label>Keterangan Lain</label>
                     <textarea class="form-control" name="keterangan_lain_tamu" id="keterangan_lain_tamu" rows="3" placeholder="Keterangan Lain..."><?php echo $keterangan_lain_tamu ?></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <?php
            if($_SESSION['status_pengguna'] == 'panitia'){
            ?>
            <h6 class="card-header" style="text-align: center;"></h6>
              <!-- /.social-auth-links -->
              <br>
              <p style="text-align: center;" class="mb-0"> <?php echo $no; ?> Tamu Tersimpan!
                <a href="detail-acara.php?data=acara&id=<?php echo $_GET['id_acara'] ?>" class="text-center">Lihat Daftar Tamu</a>
              </p>
              <br>
            <?php
            }
            ?>
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
