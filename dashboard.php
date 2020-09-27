<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "component/navbar.php" ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "component/aside.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include "component/page-header.php" ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php
      if($_SESSION['status_pengguna'] == 'superadmin' || $_SESSION['status_pengguna'] == 'admin'){
      $data_pengguna = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengguna"));
      $data_acara = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM acara"));
      $data_tamu = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tamu"));
      $data_konsultasi = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT lingkup_pesan FROM pesan"));
    ?>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $data_pengguna; ?></h3>

                <p>Pengguna</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $data_acara; ?></h3>

                <p>Acara</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $data_tamu; ?></h3>

                <p>Tamu</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $data_konsultasi; ?></h3>

                <p>Konsultasi Pesan</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header">
               <?php
               if(isset($_GET['status'])){
                  $status = $_GET['status'];
               }else{
                  $status = "";
               }
               if($status == ''){
               ?>
               <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-sm-3">Tambah Pesan</button>
               <?php
              }
               ?>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <?php
                if($status == ''){
                ?>
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                    <?php
                    $id_pengguna = $_SESSION['id_pengguna'];
                    $query_pesan = mysqli_query($conn, "SELECT DISTINCT lingkup_pesan FROM pesan WHERE id_penerima_pesan='$id_pengguna' OR id_pengirim_pesan='$id_pengguna' ORDER BY lingkup_pesan DESC");
                    $cek = mysqli_num_rows($query_pesan);
                    if($cek > 0 ){
                    while ($data_list_pesan = mysqli_fetch_array($query_pesan)){
                      $lingkup_pesan = $data_list_pesan['lingkup_pesan'];
                      $query_pesan_dua = mysqli_query($conn, "SELECT * FROM pesan WHERE lingkup_pesan='$lingkup_pesan' ORDER BY id_pesan DESC limit 1");
                      $data_isi_pesan = mysqli_fetch_array($query_pesan_dua);
                     ?> 
                      <ul class="contacts-list" style="background: #2F4F4F">
                        <li>
                          <a href="dashboard.php?data=home&status=detail-pesan&lingkup=<?php echo $lingkup_pesan?>&pengirim=<?php echo $data_isi_pesan['id_pengirim_pesan']; ?>">
                            <?php
                                $id_pengirim_pesan = $data_isi_pesan['id_pengirim_pesan'];
                                $query_nama = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna='$id_pengirim_pesan'");
                                $data_nama = mysqli_fetch_array($query_nama);
                            ?>
                            <img class="contacts-list-img" src="upload/<?php echo $data_nama['foto_pengguna'] ?>" alt="User Avatar">
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                <?php echo $data_nama['nama_pengguna']; ?>
                                <small class="contacts-list-date float-right"><?php echo substr($data_isi_pesan['waktu_pesan'],0,10) ?></small>
                              </span>
                              <?php
                              if(strlen($data_isi_pesan['isi_pesan']) > 15){
                              ?>
                              <span class="contacts-list-msg"><?php echo substr($data_isi_pesan['isi_pesan'], 0, 15) ?>.....</span>
                              <?php
                              }else{
                              ?>
                              <span class="contacts-list-msg"><?php echo $data_isi_pesan['isi_pesan'];?></span>
                              <?php
                              }
                              ?>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                      </ul>

                  <?php
                    }
                  }else{
                  ?>
                     <ul class="contacts-list" style="background: #2F4F4F">
                        <li>
                          <a href="#">
                            <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Avatar">
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Data Pesan Kosong
                              </span>
                              <span class="contacts-list-msg"></span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                      </ul>
                  <?php
                  }
                  ?>
                    <!-- /.contacts-list -->
                  </div>
                  <?php
                  }else{
                  ?>
                  <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                      <?php
                      $lingkup_pesan = $_GET['lingkup'];
                      $query_detail_pesan = mysqli_query($conn, "SELECT * FROM pesan WHERE lingkup_pesan='$lingkup_pesan'");
                      while ($data_list_detail_pesan = mysqli_fetch_array($query_detail_pesan)){
                      if($_SESSION['id_pengguna'] == $data_list_detail_pesan['id_pengirim_pesan']){
                        $float = "right";
                        $id_pengirim_pesan = $_SESSION['id_pengguna'];
                        $query_nama_detail = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna='$id_pengirim_pesan'");
                        $data_nama_detail = mysqli_fetch_array($query_nama_detail);
                        $nama_pengguna_pesan = $data_nama_detail['nama_pengguna'];
                        $foto_pengguna_pesan = $data_nama_detail['foto_pengguna'];
                      }else{
                        $float = "";
                        $id_pengirim_pesan = $data_list_detail_pesan['id_pengirim_pesan'];
                        $query_nama_detail = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna='$id_pengirim_pesan'");
                        $data_nama_detail = mysqli_fetch_array($query_nama_detail);
                        $nama_pengguna_pesan = $data_nama_detail['nama_pengguna'];
                        $foto_pengguna_pesan = $data_nama_detail['foto_pengguna'];
                      }
                      ?>
                      <div class="direct-chat-msg <?php echo $float ?>">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left"><?php echo $nama_pengguna_pesan; ?></span>
                          <span class="direct-chat-timestamp float-right"><?php echo substr($data_list_detail_pesan['waktu_pesan'],0,10) ?> / <?php echo substr($data_list_detail_pesan['waktu_pesan'],10) ?> </span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="upload/<?php echo $foto_pengguna_pesan ?>" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                          <?php echo $data_list_detail_pesan['isi_pesan'] ?>
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                      <?php
                      }
                      ?>
                  </div>
                  <div class="card-footer">
                    <form action="proses/pesan.php?action=addadmin&lingkup=<?php echo $_GET['lingkup'] ?>&pengirim=<?php echo $_GET['pengirim']; ?>" method="post">
                      <input type="hidden" class="form-control" name="id_pengirim_pesan" id="id_pengirim_pesan" value="<?php echo $_SESSION['id_pengguna'] ?>">
                      <input type="hidden" class="form-control" name="id_penerima_pesan" id="id_penerima_pesan" value="<?php echo $_GET['pengirim'] ?>">
                      <div class="input-group">
                        <input type="text" name="isi_pesan" placeholder="Iya ..." class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-primary">Send</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  <?php
                  }
                  ?>

                  <!-- /.direct-chat-msg -->
                </div>
                <!-- /.direct-chat-pane -->
            </div>
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <?php
    }else{
    ?>
    <section class="content">
      <div class="container-fluid">
        <br>
        <div class="image">
          <?php
            $sql = mysqli_query($conn, "SELECT * FROM info WHERE id_info = '1'");
            $data = mysqli_fetch_array($sql);
          ?>
          <p style="text-align: center;">
          <img style="width: 160px" src="upload/<?php echo $data['logo_info'] ?>" class="img-circle elevation-2" alt="User Image">
          </p>
        </div>
        <?php
        if(isset($_GET['menu'])){
          $menu = $_GET['menu'];
        }
        ?>
        <!-- Small boxes (Stat box) -->
        <?php
        if($menu == 'home'){
        ?>
        <h6 class="card-header" style="text-align: center;font-weight: bold;">Hai, <?php echo $_SESSION['nama_pengguna']; ?></h6>
        <br>
        <div class="row">
          <div class="col-lg-3 col-6">
          <a href="dashboard.php?data=home&menu=buat&action=addpanitia">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <br>
                <img style="width: 70px" src="dist/img/add.png" alt="User Image">
                <br>
                <br>
                <p style="font-weight: bold;">Buat Acara</p>
              </div>
            </div>
          </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <a href="dashboard.php?data=home&menu=daftar&data=acara">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <br>
                <img style="width: 70px" src="dist/img/list.png" alt="User Image">
                <br>
                <br>
                <p style="font-weight: bold;">Daftar Acara</p>
              </div>
            </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <a href="dashboard.php?data=home&menu=akun&action=editakun&id=<?php echo $_SESSION['id_pengguna'] ?>">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <br>
                <img style="width: 70px" src="dist/img/account.png" alt="User Image">
                <br>
                <br>
                <p style="font-weight: bold;">Atur Akun</p>
              </div>
            </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <a href="dashboard.php?data=home&menu=info">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <br>
                <img style="width: 70px" src="dist/img/question.png" alt="User Image">
                <br>
                <br>
                <p style="font-weight: bold;">Info & Bantuan</p>
              </div>
            </div>
            </a>
          </div>
          <!-- ./col -->
        </div>
        <?php
        }elseif ($menu == 'buat') {
         $id = $_SESSION['id_pengguna'];
         $query_kuota = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna='$id'");
         $data_kuota = mysqli_fetch_array($query_kuota);
         $kuota_perizinan_pengguna = $data_kuota['kuota_perizinan_pengguna'];
        ?>
        <form action="proses/acara.php?action=<?php echo $_GET['action'] ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <input type="hidden" class="form-control" name="id_pengguna" id="id_pengguna" value="<?php echo $_SESSION['id_pengguna'] ?>">
                  <div class="form-group">
                    <p style="text-align: center;"><label for="nama_acara">Nama Acara</label></p>
                    <input type="text" class="form-control" name="nama_acara" id="nama_acara" placeholder="Nama Acara">
                  </div>
                  <div class="form-group">
                  <p style="text-align: center;"><label>Tanggal dan Waktu Mulai</label></p>
                  <div class="input-group">
                    <input type="date" class="form-control col-md-6" name="tanggal_mulai_acara" id="tanggal_mulai_acara" >
                    <input type="time" class="form-control col-md-6" name="waktu_mulai_acara" id="waktu_mulai_acara">
                  </div>
                  <p style="text-align: center;"><label>Tanggal dan Waktu Selesai</label></p>
                  <div class="input-group">
                    <input type="date" class="form-control col-md-6" name="tanggal_selesai_acara" id="tanggal_selesai_acara">
                    <input type="time" class="form-control col-md-6" name="waktu_selesai_acara" id="waktu_selesai_acara" >
                  </div>
                  <!-- /.input group -->
                 </div>
                  <div class="form-group">
                      <p style="text-align: center;"><label>Zona Waktu</label></p>
                        <select class="custom-select" name="zona_waktu_acara">
                          <option>Pilih Zona Waktu</option>
                          <option value="WIB">WIB</option>
                          <option value="WITA">WITA</option>
                          <option value="WIT">WIT</option>
                        </select>
                  </div>
                  <div class="form-group">
                     <p style="text-align: center;"><label>Lokasi</label></p>
                     <textarea class="form-control" name="lokasi_acara" id="lokasi_acara" rows="3" placeholder="Lokasi Acara, Gunakan <br> untuk penulisan ganti baris..."></textarea>
                  </div>
                  <div class="form-group">
                     <p style="text-align: center;"><label>Ketentuan</label></p>
                     <textarea class="form-control" name="ketentuan_acara" id="ketentuan_acara" rows="3" placeholder="Ketentuan Acara, Gunakan <br> untuk penulisan ganti baris..."></textarea>
                  </div>
                  <div class="form-group">
                     <p style="text-align: center;"><label>Deskripsi</label></p>
                     <textarea class="form-control" name="deskripsi_acara" id="deskripsi_acara" rows="3" placeholder="Deskripsi Acara, Gunakan <br> untuk penulisan ganti baris..."></textarea>
                  </div>
                  <div class="form-group">
                     <p style="text-align: center;"><label>Pesan</label></p>
                     <textarea class="form-control" name="pesan_acara" id="pesan_acara" rows="3" placeholder="Pesan Acara, Gunakan <br> untuk penulisan ganti baris..."></textarea>
                  </div>
                  <div class="form-group">
                      <p style="text-align: center;"><label>Jumlah Tamu (Kuota Anda <?php echo $kuota_perizinan_pengguna ?> Tamu)</label></p>
                        <select class="custom-select" name="jumlah_tamu_acara">
                          <option>Pilih Kuota Tamu</option>
                            <?php
                            if($kuota_perizinan_pengguna <= '25'){
                            ?>
                            <option value="25">Jumlah Tamu < 25 </option>
                            <option value="50">Jumlah Tamu < 50 (Nunggu Konfimasi Admin)</option>
                            <option value="100">Jumlah Tamu < 100 (Nunggu Konfimasi Admin)</option>
                            <option value="200">Jumlah Tamu < 200 (Nunggu Konfimasi Admin)</option>
                            <option value="400">Jumlah Tamu < 400 (Nunggu Konfimasi Admin)</option>
                            <option value="800">Jumlah Tamu < 800 (Nunggu Konfimasi Admin)</option>
                            <option value="10000">Jumlah Tamu > 800  (Nunggu Konfimasi Admin)</option>
                            <?php
                            }elseif ($kuota_perizinan_pengguna <='50') {
                            ?>
                            <option value="25">Jumlah Tamu < 25 </option>
                             <option value="50">Jumlah Tamu < 50 </option>
                            <option value="100">Jumlah Tamu < 100 (Nunggu Konfimasi Admin)</option>
                            <option value="200">Jumlah Tamu < 200 (Nunggu Konfimasi Admin)</option>
                            <option value="400">Jumlah Tamu < 400 (Nunggu Konfimasi Admin)</option>
                            <option value="800">Jumlah Tamu < 800 (Nunggu Konfimasi Admin)</option>
                            <option value="10000">Jumlah Tamu > 800 (Nunggu Konfimasi Admin)</option>
                            <?php  
                            }elseif ($kuota_perizinan_pengguna <='100') {
                            ?>
                            <option value="25">Jumlah Tamu < 25 </option>
                            <option value="50">Jumlah Tamu < 50 </option>
                            <option value="100">Jumlah Tamu < 100 </option>
                            <option value="200">Jumlah Tamu < 200 (Nunggu Konfimasi Admin)</option>
                            <option value="400">Jumlah Tamu < 400 (Nunggu Konfimasi Admin)</option>
                            <option value="800">Jumlah Tamu < 800 (Nunggu Konfimasi Admin)</option>
                            <option value="10000">Jumlah Tamu > 800 (Nunggu Konfimasi Admin)</option>

                            <?php  
                            }elseif ($kuota_perizinan_pengguna <='200') {
                            ?>
                            <option value="25">Jumlah Tamu < 25 </option>
                            <option value="50">Jumlah Tamu < 50 </option>
                            <option value="100">Jumlah Tamu < 100 </option>
                            <option value="200">Jumlah Tamu < 200 </option>
                            <option value="400">Jumlah Tamu < 400 (Nunggu Konfimasi Admin)</option>
                            <option value="800">Jumlah Tamu < 800 (Nunggu Konfimasi Admin)</option>
                            <option value="10000">Jumlah Tamu > 800 (Nunggu Konfimasi Admin)</option>

                            <?php  
                            }elseif ($kuota_perizinan_pengguna <='400') {
                            ?>
                            <option value="25">Jumlah Tamu < 25 </option>
                            <option value="50">Jumlah Tamu < 50 </option>
                            <option value="100">Jumlah Tamu < 100 </option>
                            <option value="200">Jumlah Tamu < 200 </option>
                            <option value="400">Jumlah Tamu < 400 </option>
                            <option value="800">Jumlah Tamu < 800 (Nunggu Konfimasi Admin)</option>
                            <option value="10000">Jumlah Tamu > 800 (Nunggu Konfimasi Admin)</option>

                             <?php
                            }elseif ($kuota_perizinan_pengguna == '800') {
                            ?>
                            <option value="25">Jumlah Tamu < 25 </option>
                            <option value="50">Jumlah Tamu < 50 </option>
                            <option value="100">Jumlah Tamu < 100 </option>
                            <option value="200">Jumlah Tamu < 200 </option>
                            <option value="400">Jumlah Tamu < 400 </option>
                            <option value="800">Jumlah Tamu < 800 </option>
                            <option value="10000">Jumlah Tamu > 800 (Nunggu Konfimasi Admin)</option>
                            <?php  
                            }else{
                            ?>
                            <option value="25">Jumlah Tamu < 25 </option>
                            <option value="50">Jumlah Tamu < 50 </option>
                            <option value="100">Jumlah Tamu < 100 </option>
                            <option value="200">Jumlah Tamu < 200 </option>
                            <option value="400">Jumlah Tamu < 400 </option>
                            <option value="800">Jumlah Tamu < 800 </option>
                            <option value="10000">Jumlah Tamu > 800 </option>
                            <?php
                            }
                            ?>
                        </select>
                  </div>
                  <div class="image">
                    <p style="text-align: center;">
                    <img style="width: 160px" src="dist/img/user2-160x160.jpg" id="tampil_foto_poster_acara" class="img-circle elevation-2" alt="User Image">
                    </p>
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="foto_poster_acara">Poster Acara</label></p>
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
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
        <?php
        }elseif($menu == 'daftar'){
        ?>
        <br>
        <div class="card">
          <div class="card-body">
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
                        $query = mysqli_query($conn, "SELECT * FROM acara WHERE id_pengguna=".$_SESSION['id_pengguna']."");
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
                          <td><?php echo $tanggal_acara ?></td>
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
                          <?php
                          if($data['status_konfirmasi_acara'] == 'sudah'){
                          ?>
                          <a href="detail-acara.php?data=acara&id=<?php echo $data['id_acara'] ?>">
                             <button type="button" class="btn btn-success btn-sm"><i class="fas fa-folder"></i> Detail</button>
                           </a>
                           <a href="form-acara.php?data=acara&action=edit&id=<?php echo $data['id_acara'] ?>">
                             <button type="button" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</button>
                           </a>
                           <?php
                          }else{
                           ?>
                            <a href="#">
                             <button type="button" class="btn btn-success disabled btn-sm" data-toggle="modal" data-target="#modal-sm-2"><i class="fas fa-folder"></i> Detail</button>
                           </a>
                           <a href="#">
                             <button type="button" class="btn btn-info disabled btn-sm" data-toggle="modal" data-target="#modal-sm-2"><i class="fas fa-pencil-alt"></i> Edit</button>
                           </a>
                           <?php
                            }
                           ?>
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
            </div>
            <br>
        <?php
        }elseif ($menu == 'akun') {
          $action = $_GET['action'];
          $sd = "panitia";
          if($action == 'editakun'){
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
             $title = "Simpan";
             $src_foto_pengguna = "upload/".$foto_pengguna."";
             $src_logo_instansi_pengguna = "upload/".$logo_instansi_pengguna."";
          }
        ?>
             <form action="proses/pengguna.php?action=<?php echo $action ?>&sd=<?php echo $sd ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <?php
                  if($action == 'editakun'){
                  ?>
                  <input type="hidden" class="form-control" name="id_pengguna" id="id_pengguna" value="<?php echo $id ?>" readonly>
                  <input type="hidden" class="form-control" name="kuota_perizinan_pengguna" id="kuota_perizinan_pengguna" value="<?php echo $kuota_perizinan_pengguna ?>" readonly>
                  <input type="hidden" class="form-control" name="status_fitur_chat_pengguna" id="status_fitur_chat_pengguna" value="<?php echo $status_fitur_chat_pengguna ?>" readonly>
                  <?php
                  }
                  ?>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="nama_pengguna">Nama</label></p>
                    <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" value="<?php echo $nama_pengguna ?>" placeholder="Nama Pengguna">
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="tempat_lahir_pengguna">Tempat Lahir</label></p>
                    <input type="text" class="form-control" name="tempat_lahir_pengguna" id="tempat_lahir_pengguna" value="<?php echo $tempat_lahir_pengguna ?>"placeholder="Tempat Lahir">
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="tanggal_lahir_pengguna">Tanggal Lahir</label></p>
                    <input type="date" class="form-control" name="tanggal_lahir_pengguna" id="tanggal_lahir_pengguna" value="<?php echo $tanggal_lahir_pengguna ?>" placeholder="Tanggal Lahir">
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="no_hp_pengguna">Nomor HP</label></p>
                    <input type="text" class="form-control" name="no_hp_pengguna" id="no_hp_pengguna" value="<?php echo $no_hp_pengguna ?>" placeholder="Nomor HP">
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="email_pengguna">Email</label></p>
                    <input type="text" class="form-control" name="email_pengguna" id="email_pengguna" value="<?php echo $email_pengguna ?>" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="password_pengguna">Password</label><p style="text-align: center;">
                    <input type="password" class="form-control" name="password_pengguna" id="password_pengguna" value="<?php echo $password_pengguna ?>" placeholder="Password">
                  </div>
                  <div class="form-group">
                     <p style="text-align: center;"><label>Alamat</label></p>
                     <textarea class="form-control" name="alamat_pengguna" id="alamat_pengguna" rows="3" placeholder="Alamat..."><?php echo $alamat_pengguna ?></textarea>
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="instansi_pengguna">Instansi</label><p style="text-align: center;">
                    <input type="text" class="form-control" name="instansi_pengguna" id="instansi_pengguna" value="<?php echo $instansi_pengguna ?>" placeholder="Instansi">
                  </div>
                  <div class="image">
                    <p style="text-align: center;">
                    <img style="width: 160px" src="<?php echo $src_foto_pengguna ?>" id="tampil_foto_pengguna" class="img-circle elevation-2" alt="User Image">
                    </p>
                  </div>
                  <div class="form-group">
                    <p style="text-align: center;"><label for="foto_pengguna">Foto</label><p style="text-align: center;">
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
                    <p style="text-align: center;"><label for="logo_instansi_pengguna">Logo Instansi</label><p style="text-align: center;">
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
                  <p style="text-align: center;">
                  <button type="submit" class="btn btn-primary"><?php echo $title; ?></button>
                  </p>
                </div>
              </form>
        <?php
        }elseif($menu == 'pesan'){
        ?>
        <h6 class="card-header" style="text-align: center;font-weight: bold;">Sistem Bantuan Pesan</h6>
        <br>
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header">
              <?php
              if(isset($_GET['status'])){
                  $status = $_GET['status'];
                }else{
                  $status = "";
                }
              if($status == ''){
               ?>
               <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-sm-3">Tambah Pesan</button>
               <?php
               }
               ?>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Contacts are loaded here -->
                <?php
                if($status == ''){
                ?>
                <div class="direct-chat-messages">
                    <?php
                    $id_pengguna = $_SESSION['id_pengguna'];
                    $query_pesan = mysqli_query($conn, "SELECT DISTINCT lingkup_pesan FROM pesan WHERE id_penerima_pesan='$id_pengguna' OR id_pengirim_pesan='$id_pengguna' ORDER BY lingkup_pesan DESC");
                    $cek = mysqli_num_rows($query_pesan);
                    if($cek > 0 ){
                    while ($data_list_pesan = mysqli_fetch_array($query_pesan)){
                      $lingkup_pesan = $data_list_pesan['lingkup_pesan'];
                      $query_pesan_dua = mysqli_query($conn, "SELECT * FROM pesan WHERE lingkup_pesan='$lingkup_pesan' ORDER BY id_pesan DESC limit 1");
                      $data_isi_pesan = mysqli_fetch_array($query_pesan_dua);
                     ?>
                      <ul class="contacts-list" style="background: #2F4F4F">
                        <li>
                          <a href="dashboard.php?data=home&menu=pesan&status=detail-pesan&lingkup=<?php echo $lingkup_pesan ?>&pengirim=<?php echo $data_isi_pesan['id_pengirim_pesan']; ?>">
                             <?php
                                $id_pengirim_pesan = $data_isi_pesan['id_pengirim_pesan'];
                                $query_nama = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna='$id_pengirim_pesan'");
                                $data_nama = mysqli_fetch_array($query_nama);
                            ?>
                            <img class="contacts-list-img" src="upload/<?php echo $data_nama['foto_pengguna'] ?>" alt="User Avatar">
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                <?php echo $data_nama['nama_pengguna']; ?>
                                <small class="contacts-list-date float-right"><?php echo substr($data_isi_pesan['waktu_pesan'],0,10) ?></small>
                              </span>
                              <?php
                              if(strlen($data_isi_pesan['isi_pesan']) > 15){
                              ?>
                              <span class="contacts-list-msg"><?php echo substr($data_isi_pesan['isi_pesan'], 0, 15) ?>.....</span>
                              <?php
                              }else{
                              ?>
                              <span class="contacts-list-msg"><?php echo $data_isi_pesan['isi_pesan'];?></span>
                              <?php
                              }
                              ?>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                      </ul>
                    <?php
                      }
                    }else{
                    ?>
                      <ul class="contacts-list" style="background: #2F4F4F">
                        <li>
                          <a href="#">
                            <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Avatar">
                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Data Pesan Kosong
                              </span>
                              <span class="contacts-list-msg"></span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                      </ul>
                    <?php
                    }
                    ?>
                  <!-- /.contacts-list -->
                 </div>
                  <?php
                  }else{
                  ?>
                  <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                     <?php
                      $lingkup_pesan = $_GET['lingkup'];
                      $query_detail_pesan = mysqli_query($conn, "SELECT * FROM pesan WHERE lingkup_pesan='$lingkup_pesan'");
                      while ($data_list_detail_pesan = mysqli_fetch_array($query_detail_pesan)){
                      if($_SESSION['id_pengguna'] == $data_list_detail_pesan['id_pengirim_pesan']){
                        $float = "right";
                        $id_pengirim_pesan = $_SESSION['id_pengguna'];
                        $query_nama_detail = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna='$id_pengirim_pesan'");
                        $data_nama_detail = mysqli_fetch_array($query_nama_detail);
                        $nama_pengguna_pesan = $data_nama_detail['nama_pengguna'];
                        $foto_pengguna_pesan = $data_nama_detail['foto_pengguna'];
                      }else{
                        $float = "";
                        $id_pengirim_pesan = $data_list_detail_pesan['id_pengirim_pesan'];
                        $query_nama_detail = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna='$id_pengirim_pesan'");
                        $data_nama_detail = mysqli_fetch_array($query_nama_detail);
                        $nama_pengguna_pesan = $data_nama_detail['nama_pengguna'];
                        $foto_pengguna_pesan = $data_nama_detail['foto_pengguna'];
                      }
                      ?>
                      <div class="direct-chat-msg <?php echo $float ?>">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left"><?php echo $nama_pengguna_pesan; ?></span>
                          <span class="direct-chat-timestamp float-right"><?php echo substr($data_list_detail_pesan['waktu_pesan'],0,10) ?> / <?php echo substr($data_list_detail_pesan['waktu_pesan'],10) ?> </span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="upload/<?php echo $foto_pengguna_pesan ?>" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                          <?php echo $data_list_detail_pesan['isi_pesan'] ?>
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                      <?php
                      }
                      ?>
                  </div>
                  <div class="card-footer">
                    <form action="proses/pesan.php?action=add&lingkup=<?php echo $lingkup_pesan ?>&pengirim=<?php echo $_GET['pengirim']; ?>" method="post">
                      <input type="hidden" class="form-control" name="id_pengirim_pesan" id="id_pengirim_pesan" value="<?php echo $_SESSION['id_pengguna'] ?>">
                      <input type="hidden" class="form-control" name="id_penerima_pesan" id="id_penerima_pesan" value="<?php echo $_GET['pengirim'] ?>">
                      <div class="input-group">
                        <input type="text" name="isi_pesan" placeholder="Iya ..." class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-primary">Send</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  <?php
                  }
                  ?>
                <!-- /.direct-chat-pane -->
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer-->
            </div>
          </section>
          <br>
        <?php
        }else{
        ?>
        <?php
          $id = '1';
          $sql = mysqli_query($conn, "SELECT * FROM info WHERE id_info = '$id'");
          $data = mysqli_fetch_array($sql);
          $kabar_fitur_info = $data['kabar_fitur_info'];
          $cara_penggunaan_info = $data['cara_penggunaan_info'];
          $informasi_aplikasi_info = $data['informasi_aplikasi_info'];
        ?>
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
           <a href="dashboard.php?data=home&menu=home" class="btn btn-block btn-warning">Kembali</a>
          </div>
        <?php
        }
        ?>
      </div>
    </section>
    <?php
    }
    ?>
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
