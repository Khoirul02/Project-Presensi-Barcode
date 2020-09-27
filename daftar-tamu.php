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
   <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
      <p class="login-box-msg" style="font-weight: bold;">Silakan Masukan ID Anda</p>
      <form action="daftar-tamu.php" method="get">
        <div class="form-group">
            <input type="text" class="form-control" name="id_tamu" id="id_tamu">
         </div>
        <div class="card">
            <button type="submit" class="btn btn-success col-12">Cari</button>
        </div>
      </form>
      <?php
      if(isset($_GET['id_tamu'])){
      $id_tamu = $_GET['id_tamu'];
      ?>
      <h6 class="card-header" style="text-align: center;"></h6>
      <br>
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
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $query_tamu = mysqli_query($conn, "SELECT * FROM tamu WHERE id_tamu='$id_tamu'");
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
                        <td>
                         <a href="proses/print/print-undangan.php?id=<?php echo $data_tamu['id_tamu'] ?>">
                           <button type="button" class="btn btn-success btn-sm"><i class="fas fa-book"></i> Cetak</button>
                         </a> 
                        </td>
                      </tr>
                    <?php
                      }
                    ?>
                  </tbody>
      </table>
      <?php
      }
      ?>
    </div>
</div>
<!-- /.login-box -->
<!-- ./wrapper -->

<!-- jQuery -->
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
