<style>
    .wabutton {
        position: fixed;
        bottom: 5px;
        right: 10px;
        z-index: 100;
    }
</style>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php?data=home" class="brand-link">
      <?php
        $sql = mysqli_query($conn, "SELECT * FROM info WHERE id_info = '1'");
        $data_logo = mysqli_fetch_array($sql);
      ?>
      <img src="upload/<?php echo $data_logo['logo_info'] ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SI - Absensi Barcode</span>
    </a>
    <?php 
      if($_SESSION['status_pengguna'] == 'panitia'){
      ?>
    <a href="dashboard.php?data=home&menu=pesan">
        <img src="dist/img/comments.png" style="width: 60px;height: 60px" class="wabutton" alt="WhatsApp-Button">
    </a>
    <?php
    }
    ?>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
          <?php include "component/navigation.php" ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>