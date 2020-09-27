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
                <h3 class="card-title">Isi Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                $action = $_GET['action'];
                $sd = $_GET['sd'];
                if($action == 'edit'){
                  $id = $_GET['id'];
                  $sql = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna = '$id'");
                  $data = mysqli_fetch_array($sql);
                  $nama_pengguna = $data['nama_pengguna'];
                  $tempat_lahir_pengguna = $data['tempat_lahir_pengguna'];
                  $tanggal_lahir_pengguna = $data['tanggal_lahir_pengguna'];
                  $alamat_pengguna = $data['alamat_pengguna'];
                  $no_hp_pengguna = $data['no_hp_pengguna'];
                  $email_pengguna = $data['email_pengguna'];
                  $password_pengguna = "";
                  $instansi_pengguna = $data['instansi_pengguna'];
                  $kuota_perizinan_pengguna = $data['kuota_perizinan_pengguna'];
                  $status_fitur_chat_pengguna = $data['status_fitur_chat_pengguna'];
                  $foto_pengguna = $data['foto_pengguna'];
                  $logo_instansi_pengguna = $data['logo_instansi_pengguna'];
                  $title = "Edit";
                  $src_foto_pengguna = "upload/".$foto_pengguna."";
                  $src_logo_instansi_pengguna = "upload/".$logo_instansi_pengguna."";
                }else{
                  $nama_pengguna = "";
                  $tempat_lahir_pengguna = "";
                  $tanggal_lahir_pengguna = "";
                  $alamat_pengguna = "";
                  $no_hp_pengguna = "";
                  $email_pengguna = "";
                  $password_pengguna = "";
                  $instansi_pengguna = "";
                  $foto_pengguna = "";
                  $title = "Tambah";
                  $src_foto_pengguna = "dist/img/user2-160x160.jpg";
                  $src_logo_instansi_pengguna = "dist/img/user2-160x160.jpg";
                }
              ?>
              <form action="proses/pengguna.php?action=<?php echo $action ?>&sd=<?php echo $sd ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <?php
                  if($action == 'edit'){
                  ?>
                  <div class="form-group">
                    <label for="id_pengguna">ID Pengguna</label>
                    <input type="text" class="form-control" name="id_pengguna" id="id_pengguna" value="<?php echo $id ?>" readonly>
                  </div>
                  <input type="hidden" class="form-control" name="kuota_perizinan_pengguna" id="kuota_perizinan_pengguna" value="<?php echo $kuota_perizinan_pengguna ?>" readonly>
                  <input type="hidden" class="form-control" name="status_fitur_chat_pengguna" id="status_fitur_chat_pengguna" value="<?php echo $status_fitur_chat_pengguna ?>" readonly>
                  <?php
                  }
                  ?>
                  <div class="form-group">
                    <label for="nama_pengguna">Nama</label>
                    <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" value="<?php echo $nama_pengguna ?>" placeholder="Nama Pengguna">
                  </div>
                  <div class="form-group">
                    <label for="tempat_lahir_pengguna">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir_pengguna" id="tempat_lahir_pengguna" value="<?php echo $tempat_lahir_pengguna ?>"placeholder="Tempat Lahir">
                  </div>
                  <div class="form-group">
                    <label for="tanggal_lahir_pengguna">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir_pengguna" id="tanggal_lahir_pengguna" value="<?php echo $tanggal_lahir_pengguna ?>" placeholder="Tanggal Lahir">
                  </div>
                  <div class="form-group">
                    <label for="no_hp_pengguna">Nomor HP</label>
                    <input type="text" class="form-control" name="no_hp_pengguna" id="no_hp_pengguna" value="<?php echo $no_hp_pengguna ?>" placeholder="Nomor HP">
                  </div>
                  <div class="form-group">
                    <label for="email_pengguna">Email</label>
                    <input type="text" class="form-control" name="email_pengguna" id="email_pengguna" value="<?php echo $email_pengguna ?>" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="password_pengguna">Password</label>
                    <input type="password" class="form-control" name="password_pengguna" id="password_pengguna" value="<?php echo $password_pengguna ?>" placeholder="Password">
                  </div>
                  <div class="form-group">
                     <label>Alamat</label>
                     <textarea class="form-control" name="alamat_pengguna" id="alamat_pengguna" rows="3" placeholder="Alamat..."><?php echo $alamat_pengguna ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="instansi_pengguna">Instansi</label>
                    <input type="text" class="form-control" name="instansi_pengguna" id="instansi_pengguna" value="<?php echo $instansi_pengguna ?>" placeholder="Instansi">
                  </div>
                  <div class="image">
                    <p style="text-align: center;">
                    <img style="width: 160px" src="<?php echo $src_foto_pengguna ?>" id="tampil_foto_pengguna" class="img-circle elevation-2" alt="User Image">
                    </p>
                  </div>
                  <div class="form-group">
                    <label for="foto_pengguna">Foto</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto_pengguna" id="foto_pengguna">
                        <label class="custom-file-label" for="foto_pengguna">Pilih Foto</label>
                      </div>
                    </div>
                  </div>
                  <div class="image">
                    <p style="text-align: center;">
                    <img style="width: 160px" src="<?php echo $src_logo_instansi_pengguna ?>" id="tampil_logo_instansi" class="img-circle elevation-2" alt="User Image">
                    </p>
                  </div>
                  <div class="form-group">
                    <label for="logo_instansi_pengguna">Logo Instansi</label>
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
                  <button type="submit" class="btn btn-primary"><?php echo $title; ?></button>
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
  // <?php
  // if(isset($_GET['status'])){
  //   $status = $_GET['status'];
  //   if($status == 'succes'){
  //   ?>
  //   $(function() {
  //   var Toast = Swal.mixin({
  //     toast: true,
  //     position: 'top-end',
  //     showConfirmButton: false,
  //     timer: 3000
  //   });
  //   $('document').ready(function () {
  //       Toast.fire({
  //       icon: 'success',
  //       title: 'Sukses Memproses Data Pengguna.'
  //       })
  //     });
  //   <?php
  //   }
  // }
  // ?>
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
