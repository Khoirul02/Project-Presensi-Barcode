       <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Yakin Keluar Sistem ?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Nama : <?php echo $_SESSION['nama_pengguna']; ?><br>
              Email : <?php echo $_SESSION['email_pengguna']; ?><br>
              Instansi : <?php echo $_SESSION['instansi_pengguna']; ?></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
              <a href="proses/logout.php">
              <button type="button" class="btn btn-danger">Keluar Sistem</button>
          	  </a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-sm-2">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Mengelola Data Acara?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            Data acara sedang menunggu konfirmasi admin ya.
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

       <div class="modal fade" id="modal-sm-3">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Masukan Pesan Anda</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="proses/pesan.php" method="post">
              <input type="hidden" class="form-control" name="id_pengirim_pesan" id="id_pengirim_pesan" value="<?php echo $_SESSION['id_pengguna'] ?>">
              <div class="form-group">
               <label>Penerima Pesan</label>
                 <?php
                 if($_SESSION['status_pengguna'] == 'panitia'){
                    $title_option = "Admin";
                 }else{
                    $title_option = "Pengguna";
                 }
                 ?>
                 <select class="custom-select" name="id_penerima_pesan" id="id_penerima_pesan">
                   <option>Pilih <?php echo $title_option; ?> </option>
                   <?php
                    if ($_SESSION['status_pengguna'] == 'panitia') {
                      $sql = mysqli_query($conn, "SELECT * FROM pengguna WHERE status_pengguna='admin'");
                    }elseif ($_SESSION['status_pengguna'] == 'admin' || $_SESSION['status_pengguna'] == 'superadmin') {
                      $sql = mysqli_query($conn, "SELECT * FROM pengguna");
                    }
                    while ($option = mysqli_fetch_array($sql)) {
                     $id_pengguna_option = $option['id_pengguna'];
                     $nama_pengguna_option = $option['nama_pengguna'];
                     ?>
                         <option value="<?php echo $id_pengguna_option ?>"><?php echo $nama_pengguna_option; ?></option>                             
                     <?php
                     }
                   ?>
                 </select>
               </div>
               <div class="form-group">
                <label>Pesan Anda</label>
                <textarea class="form-control" name="isi_pesan" id="isi_pesan" rows="3" placeholder="Isi Pesan Anda"></textarea>
              </div>
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary col-12">Kirim</button>
              </div>
            </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-sm-4">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Mengelola Data Tamu?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            Daftar Sudah Mencapai Kuota Tamu anda!
            Kalau ingin nambah kuota konfirmasi ke Admin dulu.
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="modal-sm-5">
        <div class="modal-dialog modal-sm-1">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Scan Barcode Disini!</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <br>
            <div class="container" id="QR-Code">
            <div class="panel panel-info text-center">
                <div class="panel-heading">
                    <div class="navbar-form navbar-right">
                        <select class="custom-select" id="camera-select"></select>
                        <div class="form-group">
                            <button title="Decode Image" class="btn btn-default btn-sm" id="decode-img" type="button" data-toggle="tooltip"><i class="fas fa-upload"></i></button>
                            <button title="Image shoot" class="btn btn-info btn-sm disabled" id="grab-img" type="button" data-toggle="tooltip"><i class="fas fa-image"></i></button>
                            <button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip"><i class="fas fa-play"></i></button>
                            <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip"><i class="fas fa-pause"></i></button>
                            <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><i class="fas fa-stop"></i></button>
                         </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="well">
                            <canvas width="320" height="320" id="webcodecam-canvas"></canvas>
                            <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="thumbnail" id="result">
                            <div class="well" style="overflow: hidden;">
                                <img width="320" height="320" id="scanned-img" src="">
                            </div>
                        </div>
                    </div>
                </div>
                <form action="proses/tamu.php?action=hadirtamu&id_acara=<?php echo $_GET['id']?>" method="post">
                <textarea style="display: none;" class="form-control" name="id_tamu" id="scanned-QR" rows="1" placeholder="ID Tamu"></textarea>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success col-12">Konfirmasi</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

 <footer class="main-footer">
    <strong>Copyright &copy; 2020</strong>
    Sistem Informasi Absensi Barcode
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
 </footer>