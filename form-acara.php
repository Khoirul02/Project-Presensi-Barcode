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
                if($action == 'edit'){
                  $id = $_GET['id'];
                  $sql = mysqli_query($conn, "SELECT * FROM acara WHERE id_acara = '$id'");
                  $data = mysqli_fetch_array($sql);
                  $id_pengguna = $data['id_pengguna'];
                  $nama_acara = $data['nama_acara'];
                  $tanggal_mulai_acara = $data['tanggal_mulai_acara'];
                  $waktu_mulai_acara = $data['waktu_mulai_acara'];
                  $tanggal_selesai_acara = $data['tanggal_selesai_acara'];
                  $waktu_selesai_acara = $data['waktu_selesai_acara'];
                  $zona_waktu_acara = $data['zona_waktu_acara'];
                  $lokasi_acara = $data['lokasi_acara'];
                  $ketentuan_acara = $data['ketentuan_acara'];
                  $deskripsi_acara = $data['deskripsi_acara'];
                  $pesan_acara = $data['pesan_acara'];
                  $jumlah_tamu_acara = $data['jumlah_tamu_acara'];
                  $status_konfirmasi_acara = $data['status_konfirmasi_acara'];
                  $foto_poster_acara = $data['foto_poster_acara'];
                  $title = "Edit";
                  $src_foto_poster_acara = "upload/".$foto_poster_acara."";
                }else{
                  $id_pengguna = "";
                  $nama_acara = "";
                  $tanggal_mulai_acara = "";
                  $waktu_mulai_acara = "";
                  $tanggal_selesai_acara = "";
                  $waktu_selesai_acara = "";
                  $zona_waktu_acara = "";
                  $lokasi_acara = "";
                  $ketentuan_acara = "";
                  $deskripsi_acara = "";
                  $pesan_acara = "";
                  $jumlah_tamu_acara = "";
                  $title = "Tambah";
                  $src_foto_poster_acara = "dist/img/user2-160x160.jpg";
                }  
              ?>
              <form action="proses/acara.php?action=<?php echo $action ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <?php
                  if($action == 'edit'){
                  ?>
                  <div class="form-group">
                    <label for="id_acara">ID Acara</label>
                    <input type="text" class="form-control" name="id_acara" id="id_acara" value="<?php echo $id ?>" readonly>
                  </div>
                  <input type="hidden" class="form-control" name="status_konfirmasi_acara" id="status_konfirmasi_acara" value="<?php echo $status_konfirmasi_acara ?>" readonly>
                  <?php
                  }
                  ?>
                  <div class="form-group">
                      <label>Panitia Penglola</label>
                        <select class="custom-select" name="id_pengguna" id="id_pengguna">
                          <option>Pilih Panitia</option>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM pengguna WHERE status_pengguna='panitia'");
                          while ($option = mysqli_fetch_array($sql)) {
                            $id_pengguna_option = $option['id_pengguna'];
                            $nama_pengguna_option = $option['nama_pengguna'];
                              if($action == 'edit'){ 
                              ?>
                                <option <?php if($id_pengguna_option == $id_pengguna) echo 'selected'; ?> value="<?php echo $id_pengguna_option ?>"><?php echo $nama_pengguna_option; ?></option>
                              <?php
                              }else{
                              ?>
                                <option value="<?php echo $id_pengguna_option ?>"><?php echo $nama_pengguna_option; ?></option>                             
                              <?php
                              }
                            }
                          ?>
                        </select>
                  </div>
                  <div class="form-group">
                    <label for="nama_acara">Nama Acara</label>
                    <input type="text" class="form-control" name="nama_acara" id="nama_acara" value="<?php echo $nama_acara ?>" placeholder="Nama Acara">
                  </div>
                  <div class="form-group">
                  <label>Tanggal dan Waktu Mulai</label>
                  <div class="input-group">
                    <input type="date" class="form-control col-md-6" name="tanggal_mulai_acara" id="tanggal_mulai_acara" value="<?php echo $tanggal_mulai_acara ?>">
                    <input type="time" class="form-control col-md-6" name="waktu_mulai_acara" id="waktu_mulai_acara"value="<?php echo $waktu_mulai_acara ?>">
                  </div>
                  <label>Tanggal dan Waktu Selesai</label>
                  <div class="input-group">
                    <input type="date" class="form-control col-md-6" name="tanggal_selesai_acara" id="tanggal_selesai_acara" value="<?php echo $tanggal_selesai_acara ?>">
                    <input type="time" class="form-control col-md-6" name="waktu_selesai_acara" id="waktu_selesai_acara" value="<?php echo $waktu_selesai_acara ?>">
                  </div>
                  <!-- /.input group -->
                 </div>
                  <div class="form-group">
                      <label>Zona Waktu</label>
                        <select class="custom-select" name="zona_waktu_acara">
                          <option>Pilih Zona Waktu</option>
                          <option <?php if($zona_waktu_acara == "WIB") echo 'selected'; ?> value="WIB">WIB</option>
                          <option <?php if($zona_waktu_acara == "WITA") echo 'selected'; ?> value="WITA">WITA</option>
                          <option <?php if($zona_waktu_acara == "WIT") echo 'selected'; ?> value="WIT">WIT</option>
                        </select>
                  </div>
                  <div class="form-group">
                     <label>Lokasi</label>
                     <textarea class="form-control" name="lokasi_acara" id="lokasi_acara" rows="3" placeholder="Lokasi Acara, Gunakan <br> untuk penulisan ganti baris..."><?php echo $lokasi_acara; ?></textarea>
                  </div>
                  <div class="form-group">
                     <label>Ketentuan</label>
                     <textarea class="form-control" name="ketentuan_acara" id="ketentuan_acara" rows="3" placeholder="Ketentuan Acara, Gunakan <br> untuk penulisan ganti baris..."><?php echo $ketentuan_acara; ?></textarea>
                  </div>
                  <div class="form-group">
                     <label>Deskripsi</label>
                     <textarea class="form-control" name="deskripsi_acara" id="deskripsi_acara" rows="3" placeholder="Deskripsi Acara, Gunakan <br> untuk penulisan ganti baris..."><?php echo $deskripsi_acara; ?></textarea>
                  </div>
                  <div class="form-group">
                     <label>Pesan</label>
                     <textarea class="form-control" name="pesan_acara" id="pesan_acara" rows="3" placeholder="Pesan Acara, Gunakan <br> untuk penulisan ganti baris..."><?php echo $pesan_acara; ?></textarea>
                  </div>

                  <div class="form-group">
                      <label>Jumlah Tamu</label>
                        <select class="custom-select" name="jumlah_tamu_acara">
                          <option>Pilih Kuota Tamu</option>
                            <option <?php if($jumlah_tamu_acara == "25") echo 'selected'; ?> value="25">Jumlah Tamu < 25 </option>
                            <option <?php if($jumlah_tamu_acara == "50") echo 'selected'; ?> value="50">Jumlah Tamu < 50 </option>
                            <option <?php if($jumlah_tamu_acara == "100") echo 'selected'; ?> value="100">Jumlah Tamu < 100 </option>
                            <option <?php if($jumlah_tamu_acara == "200") echo 'selected'; ?> value="200">Jumlah Tamu < 200 </option>
                            <option <?php if($jumlah_tamu_acara == "400") echo 'selected'; ?> value="400">Jumlah Tamu < 400 </option>
                            <option <?php if($jumlah_tamu_acara == "800") echo 'selected'; ?> value="800">Jumlah Tamu < 800 </option>
                            <option <?php if($jumlah_tamu_acara == "10000") echo 'selected'; ?> value="10000">Jumlah Tamu > 800  </option>
                        </select>
                  </div>
                  <div class="image">
                    <p style="text-align: center;">
                    <img style="width: 160px" src="<?php echo $src_foto_poster_acara ?>" id="tampil_foto_poster_acara" class="img-circle elevation-2" alt="User Image">
                    </p>
                  </div>
                  <div class="form-group">
                    <label for="foto_poster_acara">Poster Acara</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto_poster_acara" id="foto_poster_acara">
                        <label class="custom-file-label" for="foto_poster_acara">Pilih Poster</label>
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
        $("#foto_poster_acara").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#tampil_foto_poster_acara').attr('src', e.target.result);
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
