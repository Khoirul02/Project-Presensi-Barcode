<?php
$action = $_GET['action'];
if($action == 'add') {
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $kabar_fitur_info = $_POST['kabar_fitur_info'];
    $cara_penggunaan_info = $_POST['cara_penggunaan_info'];
    $informasi_aplikasi_info = $_POST['informasi_aplikasi_info'];
    $logo_info = $_FILES['logo_info']['name'];
    if ($logo_info != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
        $x = explode('.', $logo_info); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['logo_info']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $logo_info; //menggabungkan angka acak dengan nama file sebenarnya
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $sql = "INSERT INTO info(kabar_fitur_info,cara_penggunaan_info,informasi_aplikasi_info,logo_info)VALUE('$kabar_fitur_info','$cara_penggunaan_info','$nama_gambar_baru')";
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
                        echo "<script>alert('Sukses Memproses Data');window.location='../form-info.php?data=info&action=add';</script>";
                        }
                    }
            }else{
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Format Gambar Tidak Sesuai');window.location='../form-info.php?data=info&action=add';</script>";
        }
    }else {
        $sql = "INSERT INTO info(kabar_fitur_info,cara_penggunaan_info,informasi_aplikasi_info,logo_info)VALUE('$kabar_fitur_info','$cara_penggunaan_info',null)";
        $simpan = mysqli_query($connect, $sql);
        if ($simpan == true) {
            echo "<script>alert('Berhasil Memproses Data dan Gambar Kosong');window.location='../form-info.php?data=info&action=add';</script>";
        } else {
            echo "<script>alert('Gagal Memproses Data');window.location='../form-info.php?data=info&action=add';</script>";
        }
    }
}
if($action == 'edit'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_info = $_POST['id_info'];
    $kabar_fitur_info = $_POST['kabar_fitur_info'];
    $cara_penggunaan_info = $_POST['cara_penggunaan_info'];
    $informasi_aplikasi_info = $_POST['informasi_aplikasi_info'];
    $logo_info = $_FILES['logo_info']['name'];
    if ($logo_info != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
        $x = explode('.', $logo_info); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['logo_info']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $logo_info; //menggabungkan angka acak dengan nama file sebenarnya
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $sql = "UPDATE info SET kabar_fitur_info='$kabar_fitur_info',cara_penggunaan_info='$cara_penggunaan_info',informasi_aplikasi_info='$informasi_aplikasi_info',logo_info='$nama_gambar_baru' WHERE id_info='$id_info'";
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
                        echo "<script>alert('Sukses Memperbarui Data');window.location='../form-info.php?data=info&action=edit';</script>";
                        }
                    }
            }else{
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Format Gambar Tidak Sesuai');window.location='../form-info.php?data=info&action=edit';</script>";
        }
    }else {
        $sql = "UPDATE info SET kabar_fitur_info='$kabar_fitur_info',cara_penggunaan_info='$cara_penggunaan_info',informasi_aplikasi_info='$informasi_aplikasi_info' WHERE id_info='$id_info'";
        $simpan = mysqli_query($connect, $sql);
        if ($simpan == true) {
            echo "<script>alert('Berhasil Memproses Data dan Gambar Kosong');window.location='../form-info.php?data=info&action=edit';</script>";
        } else {
            echo "<script>alert('Gagal Memproses Data');window.location='../form-info.php?data=info&action=edit';</script>";
        }
    }
}