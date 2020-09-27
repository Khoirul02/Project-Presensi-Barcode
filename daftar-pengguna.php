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
                <h3 class="card-title">Data Pengguna</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                  $sd = $_GET['sd'];
                  if($data =='pengguna'){
                ?>
                <a href="form-pengguna.php?data=pengguna&action=add&sd=<?php echo $sd ?>">
                   <button type="button" class="btn btn-success btn-sm"><i class="far fa-user"></i> Tambah</button>
                </a>
                <br>
                <br>
                <?php
                }
                ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Email</th>
                    <th>Instansi</th>
                    <th>Foto Pengguna</th>
                    <th>Logo Instansi</th>
                    <th>Kuota Tamu</th>
                    <th>Prizianan Pesan</th>
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
                        $sd = $_GET['sd'];
                        if($sd == 'admin'){
                          $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE status_pengguna='admin'");
                        }elseif ($sd == 'panitia') {
                          $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE status_pengguna='panitia'");
                        }
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                          <td><?php echo $data['nama_pengguna'];?></td>
                          <td><?php echo $data['tempat_lahir_pengguna'];?></td>
                          <td><?php echo tgl_indo($data['tanggal_lahir_pengguna'])?></td>
                          <td><?php echo $data['alamat_pengguna'];?></td>
                          <td><?php echo $data['no_hp_pengguna'];?></td>
                          <td><?php echo $data['email_pengguna'];?></td>
                          <td><?php echo $data['instansi_pengguna'];?></td>
                          <?php
                          if($data['foto_pengguna'] == '' || $data['logo_instansi_pengguna']== ''){
                            $src_foto_pengguna = "dist/img/user2-160x160.jpg";
                            $src_logo_instansi_pengguna = "dist/img/user2-160x160.jpg";
                          }else{
                            $src_foto_pengguna = "upload/".$data['foto_pengguna']."";
                            $src_logo_instansi_pengguna = "upload/".$data['logo_instansi_pengguna']."";
                          }
                          ?>
                          <td><img style="width: 100px" class="attachment-img" src="<?php echo $src_foto_pengguna ?>"></td>
                          <td><img style="width: 100px" class="attachment-img" src="<?php echo $src_logo_instansi_pengguna ?>"></td>
                          <td><?php echo $data['kuota_perizinan_pengguna'];?></td>
                          <td><?php echo $data['status_fitur_chat_pengguna'];?></td>
                          <td>
                          <?php
                          $data_button = $_GET['data'];
                          if($data_button == 'bantuan'){
                          ?>
                          <a href="proses/pengguna.php?action=aktifkan&sd=<?php echo $sd ?>&id=<?php echo $data['id_pengguna'] ?>">
                             <button type="button" class="btn btn-success btn-sm">Aktifkan</button>
                           </a>
                           <a href="proses/pengguna.php?action=nonaktifkan&sd=<?php echo $_GET['sd'] ?>&id=<?php echo $data['id_pengguna']?>">
                             <button type="button" class="btn btn-danger btn-sm">Nonaktifkan</button>
                           </a>
                          <?php
                          }else{
                          ?>
                           <a href="form-pengguna.php?data=pengguna&action=edit&sd=<?php echo $sd ?>&id=<?php echo $data['id_pengguna'] ?>">
                             <button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</button>
                           </a>
                           <a href="proses/pengguna.php?action=delete&sd=<?php echo $_GET['sd'] ?>&id=<?php echo $data['id_pengguna'] ?>">
                             <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                           </a>
                          <?php
                          }
                          ?>
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
