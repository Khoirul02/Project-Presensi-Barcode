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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Acara</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="form-acara.php?data=acara&action=add">
                   <button type="button" class="btn btn-success btn-sm">Tambah</button>
                </a>
                <br>
                <br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Ketentuan</th>
                    <th>Deskripsi</th>
                    <th>Pesan</th>
                    <th>Poster</th>
                    <th>Kuota Tamu</th>
                    <th>Konfirmasi Acara</th>
                    <th>Pengelola</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        function tgl_indo($tanggal){
                        $bulan = array(
                            1 => 'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember');
                        $pecahkan = explode('-', $tanggal);
                          // variabel pecahkan 0 = tanggal
                          // variabel pecahkan 1 = bulan
                          // variabel pecahkan 2 = tahun
                             return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                        }
                        if($_SESSION['status_pengguna'] == 'panitia'){
                          $id_pengguna_acara = $_SESSION['id_pengguna'];
                          $query = mysqli_query($conn, "SELECT * FROM acara WHERE id_pengguna='$id_pengguna_acara'");
                        }else{
                          $query = mysqli_query($conn, "SELECT * FROM acara");
                        }
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                          <td><?php echo $data['nama_acara'];?></td>
                          <?php
                            if($data['tanggal_mulai_acara'] == $data['tanggal_selesai_acara']){
                                $tanggal_acara = tgl_indo($data['tanggal_mulai_acara']);
                            }else{
                                $tanggal_acara = tgl_indo($data['tanggal_mulai_acara'])." - ".tgl_indo($data['tanggal_selesai_acara']);
                            }
                            ?>
                          <td><?php echo $tanggal_acara?></td>
                          <td><?php echo $data['waktu_mulai_acara'];?>-<?php echo $data['waktu_selesai_acara'];?> <?php echo $data['zona_waktu_acara'];?></td>
                          <td><?php echo $data['lokasi_acara'];?></td>
                          <td><?php echo $data['ketentuan_acara'];?></td>
                          <td><?php echo $data['deskripsi_acara'];?></td>
                          <td><?php echo $data['pesan_acara'];?></td>
                          <?php
                          if($data['foto_poster_acara'] == ''){
                            $src_foto_poster_acara = "dist/img/user2-160x160.jpg";
                          }else{
                            $src_foto_poster_acara = "upload/".$data['foto_poster_acara']."";
                          }
                          ?>
                          <td><img style="width: 100px" class="attachment-img" src="<?php echo $src_foto_poster_acara ?>"></td>
                          <td><?php echo $data['jumlah_tamu_acara'];?></td>
                          <td><?php echo $data['status_konfirmasi_acara'];?></td>
                          <?php
                            $query_pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna=".$data['id_pengguna']."");
                            $data_pengguna = mysqli_fetch_array($query_pengguna);
                          ?>
                          <td><?php echo $data_pengguna['nama_pengguna']; ?></td>
                          <td>
                           <a href="proses/acara.php?action=konfirmasi&id=<?php echo $data['id_acara'] ?>">
                             <button type="button" class="btn btn-warning btn-sm"><i class="fas fa-save"></i> Konfrimasi</button>
                           </a>
                           <a href="detail-acara.php?data=acara&id=<?php echo $data['id_acara'] ?>">
                             <button type="button" class="btn btn-success btn-sm"><i class="fas fa-folder"></i> Detail</button>
                           </a>
                           <a href="form-acara.php?data=acara&action=edit&id=<?php echo $data['id_acara'] ?>">
                             <button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</button>
                           </a>
                           <a href="proses/acara.php?action=delete&id=<?php echo $data['id_acara'] ?>">
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
<!-- AdminLTE App -->
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
</body>
</html>
