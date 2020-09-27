<?php
$action = $_GET['action'];
if($action == 'add') {
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_pengguna = $_POST['id_pengguna'];
    $nama_acara = $_POST['nama_acara'];
    $tanggal_mulai_acara = $_POST['tanggal_mulai_acara'];
    $waktu_mulai_acara = $_POST['waktu_mulai_acara'];
    $tanggal_selesai_acara = $_POST['tanggal_selesai_acara'];
    $waktu_selesai_acara = $_POST['waktu_selesai_acara'];
    $zona_waktu_acara = $_POST['zona_waktu_acara'];
    $lokasi_acara = $_POST['lokasi_acara'];
    $ketentuan_acara = $_POST['ketentuan_acara'];
    $deskripsi_acara = $_POST['deskripsi_acara'];
    $pesan_acara = $_POST['pesan_acara'];
    $jumlah_tamu_acara = $_POST['jumlah_tamu_acara'];
    $query_kuota = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna='$id_pengguna'");
    $data_kuota = mysqli_fetch_array($query_kuota);
    $kuota_perizinan_pengguna = $data_kuota['kuota_perizinan_pengguna'];
    if($kuota_perizinan_pengguna >= $jumlah_tamu_acara){
        $status_konfirmasi_acara = "sudah";    
    }else{
        $status_konfirmasi_acara = "belum";
    }
    $foto_poster_acara = $_FILES['foto_poster_acara']['name'];
    if ($foto_poster_acara != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
        $x = explode('.', $foto_poster_acara); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['foto_poster_acara']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto_poster_acara; //menggabungkan angka acak dengan nama file sebenarnya
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $sql = "INSERT INTO acara(id_pengguna,nama_acara,tanggal_mulai_acara,waktu_mulai_acara,tanggal_selesai_acara,waktu_selesai_acara,zona_waktu_acara,lokasi_acara,ketentuan_acara,deskripsi_acara,pesan_acara,jumlah_tamu_acara,status_konfirmasi_acara,foto_poster_acara)VALUE('$id_pengguna','$nama_acara','$tanggal_mulai_acara','$waktu_mulai_acara','$tanggal_selesai_acara','$waktu_selesai_acara','$zona_waktu_acara','$lokasi_acara','$ketentuan_acara','$deskripsi_acara','$pesan_acara','$jumlah_tamu_acara','$status_konfirmasi_acara','$nama_gambar_baru')";
            $simpan = mysqli_query($connect, $sql);
            // periska query apakah ada error
            if (!$simpan) {
                die ("Query gagal dijalankan: " . mysqli_errno($connect) .
                    " - " . mysqli_error($connect));
            } else {
                //tampil alert dan akan redirect ke halaman index.php
                //silahkan ganti index.php sesuai halaman yang akan dituju
                if (!$simpan) {
                        die ("Query gagal dijalankan: " . mysqli_errno($connect) ." - " . mysqli_error($connect));
                    } else {
                        echo "<script>alert('Sukses Memproses Data');window.location='../form-acara.php?data=acara&action=add';</script>";
                        }
                    }
            }else{
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Format Gambar Tidak Sesuai');window.location='../form-acara.php?data=acara&action=add';</script>";
        }
    }else {
       $sql = "INSERT INTO acara(id_pengguna,nama_acara,tanggal_mulai_acara,waktu_mulai_acara,tanggal_selesai_acara,waktu_selesai_acara,zona_waktu_acara,lokasi_acara,ketentuan_acara,deskripsi_acara,pesan_acara,jumlah_tamu_acara,status_konfirmasi_acara,foto_poster_acara)VALUE('$id_pengguna','$nama_acara','$tanggal_mulai_acara','$waktu_mulai_acara','$tanggal_selesai_acara','$waktu_selesai_acara','$zona_waktu_acara','$lokasi_acara','$ketentuan_acara','$deskripsi_acara','$pesan_acara','$jumlah_tamu_acara','$status_konfirmasi_acara',null)";
        $simpan = mysqli_query($connect, $sql);
        if ($simpan == true) {
            echo "<script>alert('Berhasil Memproses Data dan Gambar Kosong');window.location='../form-acara.php?data=acara&action=add';</script>";
        } else {
            echo "<script>alert('Gagal Memproses Data');window.location='../form-acara.php?data=acara&action=add';</script>";
        }
    }
}
if($action == 'addpanitia') {
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_pengguna = $_POST['id_pengguna'];
    $nama_acara = $_POST['nama_acara'];
    $tanggal_mulai_acara = $_POST['tanggal_mulai_acara'];
    $waktu_mulai_acara = $_POST['waktu_mulai_acara'];
    $tanggal_selesai_acara = $_POST['tanggal_selesai_acara'];
    $waktu_selesai_acara = $_POST['waktu_selesai_acara'];
    $zona_waktu_acara = $_POST['zona_waktu_acara'];
    $lokasi_acara = $_POST['lokasi_acara'];
    $ketentuan_acara = $_POST['ketentuan_acara'];
    $deskripsi_acara = $_POST['deskripsi_acara'];
    $pesan_acara = $_POST['pesan_acara'];
    $jumlah_tamu_acara = $_POST['jumlah_tamu_acara'];
    $query_kuota = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna='$id_pengguna'");
    $data_kuota = mysqli_fetch_array($query_kuota);
    $kuota_perizinan_pengguna = $data_kuota['kuota_perizinan_pengguna'];
    if($kuota_perizinan_pengguna >= $jumlah_tamu_acara){
        $status_konfirmasi_acara = "sudah";    
    }else{
        $status_konfirmasi_acara = "belum";
    }
    $foto_poster_acara = $_FILES['foto_poster_acara']['name'];
    if ($foto_poster_acara != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
        $x = explode('.', $foto_poster_acara); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['foto_poster_acara']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto_poster_acara; //menggabungkan angka acak dengan nama file sebenarnya
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $sql = "INSERT INTO acara(id_pengguna,nama_acara,tanggal_mulai_acara,waktu_mulai_acara,tanggal_selesai_acara,waktu_selesai_acara,zona_waktu_acara,lokasi_acara,ketentuan_acara,deskripsi_acara,pesan_acara,jumlah_tamu_acara,status_konfirmasi_acara,foto_poster_acara)VALUE('$id_pengguna','$nama_acara','$tanggal_mulai_acara','$waktu_mulai_acara','$tanggal_selesai_acara','$waktu_selesai_acara','$zona_waktu_acara','$lokasi_acara','$ketentuan_acara','$deskripsi_acara','$pesan_acara','$jumlah_tamu_acara','$status_konfirmasi_acara','$nama_gambar_baru')";
            $simpan = mysqli_query($connect, $sql);
            // periska query apakah ada error
            if (!$simpan) {
                die ("Query gagal dijalankan: " . mysqli_errno($connect) .
                    " - " . mysqli_error($connect));
            } else {
                //tampil alert dan akan redirect ke halaman index.php
                //silahkan ganti index.php sesuai halaman yang akan dituju
                if (!$simpan) {
                        die ("Query gagal dijalankan: " . mysqli_errno($connect) ." - " . mysqli_error($connect));
                    } else {
                        echo "<script>alert('Sukses Memproses Data');window.location='../dashboard.php?data=home&menu=buat&action=addpanitia';</script>";
                        }
                    }
            }else{
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Format Gambar Tidak Sesuai');window.location='../dashboard.php?data=home&menu=buat&action=addpanitia';</script>";
        }
    }else {
       $sql = "INSERT INTO acara(id_pengguna,nama_acara,tanggal_mulai_acara,waktu_mulai_acara,tanggal_selesai_acara,waktu_selesai_acara,zona_waktu_acara,lokasi_acara,ketentuan_acara,deskripsi_acara,pesan_acara,jumlah_tamu_acara,status_konfirmasi_acara,foto_poster_acara)VALUE('$id_pengguna','$nama_acara','$tanggal_mulai_acara','$waktu_mulai_acara','$tanggal_selesai_acara','$waktu_selesai_acara','$zona_waktu_acara','$lokasi_acara','$ketentuan_acara','$deskripsi_acara','$pesan_acara','$jumlah_tamu_acara','$status_konfirmasi_acara',null)";
        $simpan = mysqli_query($connect, $sql);
        if ($simpan == true) {
            echo "<script>alert('Berhasil Memproses Data dan Gambar Kosong');window.location='../dashboard.php?data=home&menu=buat&action=addpanitia';</script>";
        } else {
            echo "<script>alert('Gagal Memproses Data');window.location='../dashboard.php?data=home&menu=buat&action=addpanitia';</script>";
        }
    }
}
if($action == 'edit'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_acara = $_POST['id_acara'];
    $id_pengguna = $_POST['id_pengguna'];
    $nama_acara = $_POST['nama_acara'];
    $tanggal_mulai_acara = $_POST['tanggal_mulai_acara'];
    $waktu_mulai_acara = $_POST['waktu_mulai_acara'];
    $tanggal_selesai_acara = $_POST['tanggal_selesai_acara'];
    $waktu_selesai_acara = $_POST['waktu_selesai_acara'];
    $zona_waktu_acara = $_POST['zona_waktu_acara'];
    $lokasi_acara = $_POST['lokasi_acara'];
    $ketentuan_acara = $_POST['ketentuan_acara'];
    $deskripsi_acara = $_POST['deskripsi_acara'];
    $pesan_acara = $_POST['pesan_acara'];
    $jumlah_tamu_acara = $_POST['jumlah_tamu_acara'];
    $status_konfirmasi_acara = $_POST['status_konfirmasi_acara'];
    $foto_poster_acara = $_FILES['foto_poster_acara']['name'];
    if ($foto_poster_acara != "") { 
        $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
        $x = explode('.', $foto_poster_acara); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['foto_poster_acara']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto_poster_acara; //menggabungkan angka acak dengan nama file sebenarnya
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $sql = "UPDATE acara SET id_pengguna = '$id_pengguna',nama_acara = '$nama_acara',tanggal_mulai_acara = '$tanggal_mulai_acara',waktu_mulai_acara = '$waktu_mulai_acara',tanggal_selesai_acara = '$tanggal_selesai_acara',waktu_selesai_acara = '$waktu_selesai_acara',zona_waktu_acara = '$zona_waktu_acara',lokasi_acara = '$lokasi_acara',ketentuan_acara = '$ketentuan_acara',deskripsi_acara = '$deskripsi_acara',pesan_acara = '$pesan_acara',jumlah_tamu_acara = '$jumlah_tamu_acara',status_konfirmasi_acara = '$status_konfirmasi_acara', foto_poster_acara='$nama_gambar_baru' WHERE id_acara='$id_acara'";
            $simpan = mysqli_query($connect, $sql);
            // periska query apakah ada error
            if (!$simpan) {
                die ("Query gagal dijalankan: " . mysqli_errno($connect) .
                    " - " . mysqli_error($connect));
            } else {
            echo "<script>alert('Berhasil Memproses Data.');window.location='../daftar-acara.php?data=acara';</script>";
            }
        } else {
              echo "<script>alert('Format Gambar Tidak Sesuai');window.location='../form-acara.php?data=acara&action=add';</script>";
        }
    } else {
       $sql = "UPDATE acara SET id_pengguna = '$id_pengguna',nama_acara = '$nama_acara',tanggal_mulai_acara = '$tanggal_mulai_acara',waktu_mulai_acara = '$waktu_mulai_acara',tanggal_selesai_acara = '$tanggal_selesai_acara',waktu_selesai_acara = '$waktu_selesai_acara',zona_waktu_acara = '$zona_waktu_acara',lokasi_acara = '$lokasi_acara',ketentuan_acara = '$ketentuan_acara',deskripsi_acara = '$deskripsi_acara',pesan_acara = '$pesan_acara',jumlah_tamu_acara = '$jumlah_tamu_acara',status_konfirmasi_acara = '$status_konfirmasi_acara' WHERE id_acara='$id_acara'";
        $simpan = mysqli_query($connect, $sql);
        // periska query apakah ada error
        if (!$simpan) {
                die ("Query gagal dijalankan: " . mysqli_errno($connect) .
                    " - " . mysqli_error($connect));
        } else {
            echo "<script>alert('Foto Poster tidak diperbarui.');window.location='../daftar-acara.php?data=acara';</script>";
         }
    }
}
if($action == 'konfirmasi'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id = $_GET['id'];
    $sql = "UPDATE acara SET status_konfirmasi_acara='sudah' WHERE id_acara='$id'";
    $simpan = mysqli_query($connect, $sql);
    if($simpan == true){
       echo "<script>alert('Berhasil Memproses Data');window.location='../daftar-acara.php?data=acara';</script>";
    }else{
       echo "<script>alert('Gagal Memproses Data');window.location='../daftar-acara.php?data=acara';</script>";
    }
}
if($action == 'delete'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id = $_GET['id'];
    $sql = "DELETE FROM acara WHERE id_acara='$id'";
    $simpan = mysqli_query($connect, $sql);
    if($simpan == true){
       echo "<script>alert('Berhasil Memproses Data');window.location='../daftar-acara.php?data=acara';</script>";
    }else{
       echo "<script>alert('Gagal Memproses Data');window.location='../daftar-acara.php?data=acara';</script>";
    }
}