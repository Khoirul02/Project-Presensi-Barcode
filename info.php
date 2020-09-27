<!DOCTYPE html>
<html lang="en">
<?php
include "connection/config.php";
$sql = mysqli_query($conn, "SELECT * FROM info WHERE id_info = '1'");
$data = mysqli_fetch_array($sql);
$kabar_fitur_info = $data['kabar_fitur_info'];
$cara_penggunaan_info = $data['cara_penggunaan_info'];
$informasi_aplikasi_info = $data['informasi_aplikasi_info'];
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SI-Absesnsi Barcode</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <div class="image">
      <p style="text-align: center;">
      <img style="width: 160px" src="upload/<?php echo $data['logo_info'] ?>" id="tampil_foto_pengguna" class="img-circle elevation-2" alt="User Image">
      </p>
    </div>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <div class="form-group">
          <label>Informasi Fitur</label>
            <div class="small-box bg-info">
              <div class="inner">
                <p style="text-align: left;"><?php echo $kabar_fitur_info; ?></p>
              </div>
            </div>
           </div>
           <div class="form-group">
           <label>Cara Penggunan</label>
           <div class="small-box bg-info">
              <div class="inner">
                <p style="text-align: left;"><?php echo $cara_penggunaan_info; ?></p>
              </div>
            </div>
           </div>
           <div class="form-group">
           <label>Informasi Aplikasi</label>
           <div class="small-box bg-info">
              <div class="inner">
                <p style="text-align: left;"><?php echo $informasi_aplikasi_info; ?></p>
              </div>
            </div>
           </div>
           <h6 class="card-header" style="text-align: center;"></h6>
           <div class="social-auth-links text-center mb-3">
           <a href="index.php" class="btn btn-block btn-warning">Kembali</a>
          </div>
         </div>
       </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
