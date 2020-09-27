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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <style type="text/css">
.thumbnail {
    border: 0;
}

#webcodecam-canvas, #scanned-img {
    background-color: #2d2d2d;
}

#camera-select {
    display: inline-block;
    width: auto;
}

.btn {
    margin-bottom: 2px;
}

.form-control {
    height: 32px;
}

.h4, h4 {
    width: auto;
    float: left;
    font-size: 20px;
    line-height: 1.1;
    margin-top: 5px;
    margin-bottom: 5px;
}

.controls {
    float: right;
    display: inline-block;
}

.well {
    position: relative;
    display: inline-block;
}

.panel-heading {
    display: inline-block;
    width: 100%;
}

.container {
    width: 100%
}

pre {
    border: 0;
    border-radius: 0;
    background-color: #333;
    margin: 0;
    line-height: 125%;
    color: whitesmoke;
}

button {
    outline: none !important;
}

.table-bordered {
    color: #777;
    cursor: default;
}

.table-bordered a:hover {
    text-decoration: none;
}

.table-bordered th a {
    float: right;
    line-height: 3.49;
}

.table-bordered td a {
    float: left;
}

.table-bordered th img {
    float: left;
}

.table-bordered th, .table-bordered td {
    vertical-align: middle !important;
}

.scanner-laser {
    position: absolute;
    margin: 40px;
    height: 30px;
    width: 30px;
    opacity: 0.5;
}

.laser-leftTop {
    top: 0;
    left: 0;
    border-top: solid red 5px;
    border-left: solid red 5px;
}

.laser-leftBottom {
    bottom: 0;
    left: 0;
    border-bottom: solid red 5px;
    border-left: solid red 5px;
}

.laser-rightTop {
    top: 0;
    right: 0;
    border-top: solid red 5px;
    border-right: solid red 5px;
}

.laser-rightBottom {
    bottom: 0;
    right: 0;
    border-bottom: solid red 5px;
    border-right: solid red 5px;
    JS
}

#webcodecam-canvas {
    background-color: #272822;
}
#scanned-QR{
    word-break: break-word;
}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include "component/navbar.php" ?>

  <!-- Main Sidebar Container -->
  <?php include "component/aside.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include "component/page-header.php" ?>
    <!-- /.content-header -->
    <?php
      $id = $_GET['id'];
      $query = mysqli_query($conn, "SELECT * FROM acara WHERE id_acara='$id'");
      $data = mysqli_fetch_array($query);
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php
            if($_SESSION['status_pengguna'] == 'panitia'){
            ?>
            <br>
            <?php
            }
            ?>
            <div class="card">
              <div class="card-header">
                <?php
                if(isset($_GET['status'])){
                  $status = $_GET['status'];
                }else{
                  $status = "";
                }
                if($status == 'hadir'){
                     $title_table = "Data Tamu Hadir";
                   }
                   // elseif ($status == 'tidak') { 
                   //   $title_table = "Data Tamu Tidak Hadir";
                   // }
                   else{
                     $title_table = "Data Tamu Belum Hadir";
                  }
                ?>
                <h3 class="card-title">Kelola <?php echo $title_table; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="image">
                    <p style="text-align: center;">
                    <img style="width: 150px" src="upload/<?php echo $data['foto_poster_acara'] ?>" class="img-circle elevation-2" alt="User Image">
                    </p>
                </div>
                <h6 class="card-header" style="text-align: center;"><?php echo $data['nama_acara']; ?></h6>
                <br>
                <p style="text-align: center;">
                  <a href="#">
                      <button type="button" class="btn btn-warning btn-sm col-10" data-toggle="modal" data-target="#modal-sm-5">Absen Tamu</button>
                  </a>
                  <br>
                  <br>
                  <a href="kelola-daftar-hadir.php?data=acara&id=<?php echo $_GET['id'] ?>&status=hadir">
                      <button type="button" class="btn btn-success btn-sm col-5">Hadir</button>
                  </a>
                  <a href="kelola-daftar-hadir.php?data=acara&id=<?php echo $_GET['id'] ?>&status=tidak">
                     <button type="button" class="btn btn-success btn-sm col-5">Tidak Hadir</button>
                  </a>
                  <br>
                  <br>
                  <!-- <a href="kelola-daftar-hadir.php?data=acara&id=<?php echo $_GET['id'] ?>">
                     <button type="button" class="btn btn-info btn-sm col-10">Semua Tamu</button>
                  </a> -->
                </p>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID Tamu</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Instansi</th>
                    <th>Keterangan Lain</th>
                    <th>Barcode</th>
                    <th>Status Kehadiran</th>
                    <th>Waktu Kehadiran</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      if($status == 'hadir'){
                        $id_acara = $data['id_acara'];
                        $query_tamu = mysqli_query($conn, "SELECT * FROM tamu WHERE id_acara='$id_acara' AND status_kehadiran_tamu='hadir'");
                      }elseif($status=='tidak' || $status==''){
                        $id_acara = $data['id_acara'];
                        $query_tamu = mysqli_query($conn, "SELECT * FROM tamu WHERE id_acara='$id_acara' AND NOT status_kehadiran_tamu='hadir'");
                      }
                      while ($data_tamu = mysqli_fetch_array($query_tamu)) {
                      ?>
                      <tr>
                        <td><?php echo $data_tamu['id_tamu'];?></td>
                        <td><?php echo $data_tamu['nama_tamu'];?></td>
                        <td><?php echo $data_tamu['alamat_tamu'];?></td>
                        <td><?php echo $data_tamu['no_hp_tamu'];?></td>
                        <td><?php echo $data_tamu['email_tamu'];?></td>
                        <td><?php echo $data_tamu['instansi_tamu'];?></td>
                        <td><?php echo $data_tamu['keterangan_lain_tamu'];?></td>
                        <td><img style="width: 100px" class="attachment-img" src="upload/barcode/<?php echo $data_tamu['gambar_barcode_tamu'] ?>"></td>
                        <td><?php echo $data_tamu['status_kehadiran_tamu'];?></td>
                        <?php
                        if($data_tamu['status_kehadiran_tamu']=='hadir'){
                        ?>
                        <td><?php echo substr($data_tamu['waktu_kehadiran_tamu'],0,10) ?> / <?php echo substr($data_tamu['waktu_kehadiran_tamu'],10) ?></td>
                        <?php
                        }else{
                        ?>
                        <td>-</td>                        
                        <?php
                        }
                        ?>
                        <td>
                         <a href="proses/tamu.php?action=hadir&id_acara=<?php echo $_GET['id']?>&id=<?php echo $data_tamu['id_tamu'] ?>">
                           <button type="button" class="btn btn-success btn-sm">Hadir</button>
                         </a>
                         <a href="proses/tamu.php?action=tidak&id_acara=<?php echo $_GET['id']?>&id=<?php echo $data_tamu['id_tamu'] ?>">
                           <button type="button" class="btn btn-danger btn-sm">Tidak Hadir</button>
                         </a>
                        </td> 
                      </tr>
                     <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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
<script type="text/javascript" src="plugins/js/jquery.js"></script>
<script type="text/javascript" src="plugins/js/qrcodelib.js"></script>
<script type="text/javascript" src="plugins/js/webcodecamjs.js"></script>
<script type="text/javascript" src="plugins/js/filereader.js"></script>
<script type="text/javascript" src="plugins/js/main.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
