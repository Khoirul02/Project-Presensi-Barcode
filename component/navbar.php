<?php
session_start();
include "connection/config.php";
?>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <?php
        if($_SESSION['status_pengguna'] == 'superadmin' || $_SESSION['status_pengguna'] == 'admin'){
      ?>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <?php
    }else{
    ?>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php?data=home&menu=home"><i class="fas fa-home"></i></a>
      </li>
    </ul>
    <?php
    }
    ?>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="user-panel d-flex">
         <div class="info">
          <a href="#" data-toggle="modal" data-target="#modal-sm" class="d-block"><?php echo $_SESSION['nama_pengguna']; ?></a>
        </div>
        <div class="image">
          <?php
            if($_SESSION['foto_pengguna'] == ''){
              $foto = "dist/img/user2-160x160.jpg";
            }else{
              $foto = "upload/".$_SESSION['foto_pengguna']."";
            }
          ?>
          <img style="width: 35px;height: 35px" src="<?php echo $foto ?>" class="img-circle elevation-2" alt="User Image">
        </div>
      </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->