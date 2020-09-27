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
      $no = mysqli_num_rows($query);
      $data = mysqli_fetch_array($query);
      $query_2 = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna=".$_SESSION['id_pengguna']."");
      $data_2 = mysqli_fetch_array($query_2);
      $id_pengguna_kuota = $data_2['kuota_perizinan_pengguna'];
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
                <h3 class="card-title">Detail Acara dan Data Tamu</h3>
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
                  <?php
                  if($_SESSION['status_pengguna'] == 'panitia'){
                    if($no >= $id_pengguna_kuota){
                    ?>
                    <a href="#">
                       <button type="button" class="btn btn-success btn-sm col-5 disabled" data-toggle="modal" data-target="#modal-sm-4"">Tambah Tamu</button>
                    </a>
                    <?php
                    }else{
                    ?>
                    <a href="form-tamu.php?data=tamu&action=add&id_acara=<?php echo $_GET['id'] ?>">
                       <button type="button" class="btn btn-success btn-sm col-5">Tambah Tamu</button>
                    </a>
                    <?php
                    }
                  }else{
                  ?>
                  <a href="form-tamu.php?data=tamu&action=add&id_acara=<?php echo $_GET['id'] ?>">
                      <button type="button" class="btn btn-success btn-sm col-5">Tambah Tamu</button>
                  </a>
                  <?php
                  }
                  ?>
                  <a href="#">
                     <button type="button" class="btn btn-success btn-sm col-5">Kirim Semua</button>
                  </a>
                  <br>
                  <br>
                  <a href="kelola-daftar-hadir.php?data=acara&id=<?php echo $_GET['id'] ?>&status=tidak">
                     <button type="button" class="btn btn-info btn-sm col-10">Kelola Daftar Hadir</button>
                  </a>
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
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $query_tamu = mysqli_query($conn, "SELECT * FROM tamu WHERE id_acara=".$data['id_acara']."");
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
                         <a href="#">
                           <button type="button" class="btn btn-success btn-sm"><i class="fas fa-upload"></i> Kirim</button>
                         </a>
                         <a href="proses/print/print-undangan.php?id=<?php echo $data_tamu['id_tamu'] ?>">
                           <button type="button" class="btn btn-success btn-sm"><i class="fas fa-book"></i> Cetak</button>
                         </a>
                         <a href="form-tamu.php?data=tamu&action=edit&id_acara=<?php echo $_GET['id'] ?>&id=<?php echo $data_tamu['id_tamu'] ?>">
                           <button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</button>
                         </a>
                         <a href="proses/tamu.php?action=delete&id_acara=<?php echo $_GET['id']?>&id=<?php echo $data_tamu['id_tamu'] ?>">
                           <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
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
