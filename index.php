<!DOCTYPE html>
<html lang="en">
<?php
include "connection/config.php";
$sql = mysqli_query($conn, "SELECT * FROM info WHERE id_info = '1'");
$data = mysqli_fetch_array($sql);
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
      <p class="login-box-msg">Halo, Selamat Datang</p>

      <div class="social-auth-links text-center mb-3">
        <a href="login.php" class="btn btn-block btn-primary">
          <i class="far fa-user mr-2"></i> Petugas Panitia
        </a>
        <a href="daftar-tamu.php" class="btn btn-block btn-primary">
          <i class="far fa-user mr-2"></i> Tamu Undangan
        </a>
      <h6 class="card-header" style="text-align: center;"></h6>
      </div>
      <!-- /.social-auth-links -->
      <a href="info.php" class="btn btn-block btn-warning">
          <i class="fas fa-book mr-2"></i> Info & Bantuan
        </a>
    </div>
    <!-- /.login-card-body -->
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
