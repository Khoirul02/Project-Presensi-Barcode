	<?php
	if(isset($_GET['data'])){
		$data = $_GET['data'];
		if($data == 'home'){
			$page_title = "Dashboard";
		}elseif ($data == 'pengguna') {
			$page_title = "Kelola Data Pengguna";
		}elseif ($data == 'acara') {
			$page_title = "Kelola Data Acara";
		}elseif ($data == 'tamu') {
			$page_title = "Kelola Data Tamu";
		}elseif ($data == 'perizinan') {
			$page_title = "Data Perizinan Kuota";
		}elseif ($data == 'bantuan') {
			$page_title = "Data Perizianan Bantuan";
		}elseif ($data == 'info') {
			$page_title = "Kelola Data Info";
		}
	}
	?>
	<?php
    if($_SESSION['status_pengguna'] == 'superadmin' || $_SESSION['status_pengguna'] == 'admin'){
    ?>
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <?php
	}
    ?>