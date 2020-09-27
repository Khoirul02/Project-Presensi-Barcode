<?php
$action = $_GET['action'];
if(isset($_GET['sd'])){
    $sd = $_GET['sd'];
}
if($action == 'add') {
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $nama_pengguna = $_POST['nama_pengguna'];
    $tempat_lahir_pengguna = $_POST['tempat_lahir_pengguna'];
    $tanggal_lahir_pengguna = $_POST['tanggal_lahir_pengguna'];
    $alamat_pengguna = $_POST['alamat_pengguna'];
    $no_hp_pengguna = $_POST['no_hp_pengguna'];
    $email_pengguna = $_POST['email_pengguna'];
    $password_pengguna = $_POST['password_pengguna'];
    $instansi_pengguna = $_POST['instansi_pengguna'];
    if($sd == 'panitia'){
        $kuota_perizinan_pengguna = "25";
        $status_fitur_chat_pengguna = "aktif";
    }elseif($sd == 'admin'){
        $kuota_perizinan_pengguna = "25";
        $status_fitur_chat_pengguna = "nonaktif";
    }else{
        $kuota_perizinan_pengguna = "800";
        $status_fitur_chat_pengguna = "aktif";
    }
    $status_pengguna = $sd;
    $foto_pengguna = $_FILES['foto_pengguna']['name'];
    $logo_instansi_pengguna = $_FILES['logo_instansi_pengguna']['name'];
    if ($foto_pengguna != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
        $x = explode('.', $foto_pengguna); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['foto_pengguna']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto_pengguna; //menggabungkan angka acak dengan nama file sebenarnya
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $sql = "INSERT INTO pengguna(nama_pengguna,tempat_lahir_pengguna,tanggal_lahir_pengguna,alamat_pengguna,no_hp_pengguna,email_pengguna,password_pengguna,instansi_pengguna,kuota_perizinan_pengguna,status_pengguna,status_fitur_chat_pengguna,foto_pengguna)VALUE('$nama_pengguna','$tempat_lahir_pengguna','$tanggal_lahir_pengguna','$alamat_pengguna','$no_hp_pengguna','$email_pengguna','$password_pengguna','$instansi_pengguna','$kuota_perizinan_pengguna','$status_pengguna','$status_fitur_chat_pengguna','$nama_gambar_baru')";
            $simpan = mysqli_query($connect, $sql);
            // periska query apakah ada error
            if (!$simpan) {
                die ("Query gagal dijalankan: " . mysqli_errno($connect) .
                    " - " . mysqli_error($connect));
            } else {
                //tampil alert dan akan redirect ke halaman index.php
                //silahkan ganti index.php sesuai halaman yang akan dituju
                $id = mysqli_insert_id($connect);
                if ($logo_instansi_pengguna != "") {
                    $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
                    $x = explode('.', $logo_instansi_pengguna); //memisahkan nama file dengan ekstensi yang diupload
                    $ekstensi = strtolower(end($x));
                    $file_tmp = $_FILES['logo_instansi_pengguna']['tmp_name'];
                    $angka_acak = rand(1, 999);
                    $nama_gambar_baru_2 = $angka_acak . '-' . $logo_instansi_pengguna; //menggabungkan angka acak dengan nama file sebenarnya
                    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                        move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru_2); //memindah file gambar ke folder gambar
                        // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                        $sql = "UPDATE pengguna SET logo_instansi_pengguna='$nama_gambar_baru_2' WHERE id_pengguna='$id'";
                        $simpan = mysqli_query($connect, $sql);
                        // periska query apakah ada error
                        if (!$simpan) {
                            die ("Query gagal dijalankan: " . mysqli_errno($connect) ." - " . mysqli_error($connect));
                        } else {
                            echo "<script>alert('Sukses Memproses Data');window.location='../form-pengguna.php?data=pengguna&action=add&sd=".$sd."';</script>";
                        }
                     }else{
                    //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                        echo "<script>alert('Format Gambar Tidak Sesuai');window.location='../form-pengguna.php?data=pengguna&action=add&sd=".$sd."';</script>";
                    }
                }else{
                    $sql = "UPDATE pengguna SET logo_instansi_pengguna=null WHERE id_pengguna='$id'";
                    $simpan = mysqli_query($connect, $sql);
                    // periska query apakah ada error
                    if (!$simpan) {
                        die ("Query gagal dijalankan: " . mysqli_errno($connect) ." - " . mysqli_error($connect));
                    } else {
                        //tampil alert dan akan redirect ke halaman index.php
                        //silahkan ganti index.php sesuai halaman yang akan dituju
                        echo "<script>alert('Berhasil Memproses Data dan Logo Kosong');window.location='../form-pengguna.php?data=pengguna&action=add&sd=".$sd."';</script>";
                    }
                }
            }
        }else{
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                header('location: ../form-pengguna.php?data=pengguna&action=add&status=warning&sd='.$sd.'');
        }
    }else {
        $sql = "INSERT INTO pengguna(nama_pengguna,tempat_lahir_pengguna,tanggal_lahir_pengguna,alamat_pengguna,no_hp_pengguna,email_pengguna,password_pengguna,instansi_pengguna,kuota_perizinan_pengguna,status_pengguna,status_fitur_chat_pengguna,foto_pengguna)VALUE('$nama_pengguna','$tempat_lahir_pengguna','$tanggal_lahir_pengguna','$alamat_pengguna','$no_hp_pengguna','$email_pengguna','$password_pengguna','$instansi_pengguna','$kuota_perizinan_pengguna','$status_pengguna','$status_fitur_chat_pengguna',null)";
        $simpan = mysqli_query($connect, $sql);
        if ($simpan == true) {
            echo "<script>alert('Berhasil Memproses Data dan Gambar dan Logo Kosong');window.location='../form-pengguna.php?data=pengguna&action=add&sd=".$sd."';</script>";
        } else {
            echo "<script>alert('Gagal Memproses Data');window.location='../form-pengguna.php?data=pengguna&action=add&sd=".$sd."';</script>";
        }
    }
}
if($action == 'adddaftar') {
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $nama_pengguna = $_POST['nama_pengguna'];
    $tempat_lahir_pengguna = $_POST['tempat_lahir_pengguna'];
    $tanggal_lahir_pengguna = $_POST['tanggal_lahir_pengguna'];
    $alamat_pengguna = $_POST['alamat_pengguna'];
    $no_hp_pengguna = $_POST['no_hp_pengguna'];
    $email_pengguna = $_POST['email_pengguna'];
    $password_pengguna = $_POST['password_pengguna'];
    $instansi_pengguna = $_POST['instansi_pengguna'];
    $kuota_perizinan_pengguna = "25";
    $status_fitur_chat_pengguna = "aktif";
    $status_pengguna = $sd;
    $foto_pengguna = $_FILES['foto_pengguna']['name'];
    $logo_instansi_pengguna = $_FILES['logo_instansi_pengguna']['name'];
    if ($foto_pengguna != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
        $x = explode('.', $foto_pengguna); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['foto_pengguna']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto_pengguna; //menggabungkan angka acak dengan nama file sebenarnya
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $sql = "INSERT INTO pengguna(nama_pengguna,tempat_lahir_pengguna,tanggal_lahir_pengguna,alamat_pengguna,no_hp_pengguna,email_pengguna,password_pengguna,instansi_pengguna,kuota_perizinan_pengguna,status_pengguna,status_fitur_chat_pengguna,foto_pengguna)VALUE('$nama_pengguna','$tempat_lahir_pengguna','$tanggal_lahir_pengguna','$alamat_pengguna','$no_hp_pengguna','$email_pengguna','$password_pengguna','$instansi_pengguna','$kuota_perizinan_pengguna','$status_pengguna','$status_fitur_chat_pengguna','$nama_gambar_baru')";
            $simpan = mysqli_query($connect, $sql);
            // periska query apakah ada error
            if (!$simpan) {
                die ("Query gagal dijalankan: " . mysqli_errno($connect) .
                    " - " . mysqli_error($connect));
            } else {
                //tampil alert dan akan redirect ke halaman index.php
                //silahkan ganti index.php sesuai halaman yang akan dituju
                $id = mysqli_insert_id($connect);
                if ($logo_instansi_pengguna != "") {
                    $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
                    $x = explode('.', $logo_instansi_pengguna); //memisahkan nama file dengan ekstensi yang diupload
                    $ekstensi = strtolower(end($x));
                    $file_tmp = $_FILES['logo_instansi_pengguna']['tmp_name'];
                    $angka_acak = rand(1, 999);
                    $nama_gambar_baru_2 = $angka_acak . '-' . $logo_instansi_pengguna; //menggabungkan angka acak dengan nama file sebenarnya
                    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                        move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru_2); //memindah file gambar ke folder gambar
                        // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                        $sql = "UPDATE pengguna SET logo_instansi_pengguna='$nama_gambar_baru_2' WHERE id_pengguna='$id'";
                        $simpan = mysqli_query($connect, $sql);
                        // periska query apakah ada error
                        if (!$simpan) {
                            die ("Query gagal dijalankan: " . mysqli_errno($connect) ." - " . mysqli_error($connect));
                        } else {
                            echo "<script>alert('Sukses Memproses Data');window.location='../index.php';</script>";
                        }
                     }else{
                    //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                        echo "<script>alert('Format Gambar Tidak Sesuai');window.location='../index.php';</script>";
                    }
                }else{
                    $sql = "UPDATE pengguna SET logo_instansi_pengguna=null WHERE id_pengguna='$id'";
                    $simpan = mysqli_query($connect, $sql);
                    // periska query apakah ada error
                    if (!$simpan) {
                        die ("Query gagal dijalankan: " . mysqli_errno($connect) ." - " . mysqli_error($connect));
                    } else {
                        //tampil alert dan akan redirect ke halaman index.php
                        //silahkan ganti index.php sesuai halaman yang akan dituju
                        echo "<script>alert('Berhasil Memproses Data dan Logo Kosong');window.location='../index.php';</script>";
                    }
                }
            }
        }else{
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                header('location: ../form-pengguna.php?data=pengguna&action=add&status=warning&sd='.$sd.'');
        }
    }else {
        $sql = "INSERT INTO pengguna(nama_pengguna,tempat_lahir_pengguna,tanggal_lahir_pengguna,alamat_pengguna,no_hp_pengguna,email_pengguna,password_pengguna,instansi_pengguna,kuota_perizinan_pengguna,status_pengguna,status_fitur_chat_pengguna,foto_pengguna)VALUE('$nama_pengguna','$tempat_lahir_pengguna','$tanggal_lahir_pengguna','$alamat_pengguna','$no_hp_pengguna','$email_pengguna','$password_pengguna','$instansi_pengguna','$kuota_perizinan_pengguna','$status_pengguna','$status_fitur_chat_pengguna',null)";
        $simpan = mysqli_query($connect, $sql);
        if ($simpan == true) {
            echo "<script>alert('Berhasil Memproses Data dan Gambar dan Logo Kosong');window.location='../index.php';</script>";
        } else {
            echo "<script>alert('Gagal Memproses Data');window.location='../index.php';</script>";
        }
    }
}
if($action == 'edit'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_pengguna = $_POST['id_pengguna'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $tempat_lahir_pengguna = $_POST['tempat_lahir_pengguna'];
    $tanggal_lahir_pengguna = $_POST['tanggal_lahir_pengguna'];
    $alamat_pengguna = $_POST['alamat_pengguna'];
    $no_hp_pengguna = $_POST['no_hp_pengguna'];
    $email_pengguna = $_POST['email_pengguna'];
    $password_pengguna = $_POST['password_pengguna'];
    $instansi_pengguna = $_POST['instansi_pengguna'];
    $kuota_perizinan_pengguna = $_POST['kuota_perizinan_pengguna'];
    $status_fitur_chat_pengguna = $_POST['status_fitur_chat_pengguna'];
    $status_pengguna = $sd;
    $foto_pengguna = $_FILES['foto_pengguna']['name'];
    $logo_instansi_pengguna = $_FILES['logo_instansi_pengguna']['name'];
    if ($foto_pengguna != "") { 
        $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
        $x = explode('.', $foto_pengguna); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['foto_pengguna']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto_pengguna; //menggabungkan angka acak dengan nama file sebenarnya
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $sql = "UPDATE pengguna SET nama_pengguna='$nama_pengguna',tempat_lahir_pengguna='$tempat_lahir_pengguna',tanggal_lahir_pengguna='$tanggal_lahir_pengguna',alamat_pengguna='$alamat_pengguna',no_hp_pengguna='$no_hp_pengguna',email_pengguna='$email_pengguna',password_pengguna='$password_pengguna',instansi_pengguna='$instansi_pengguna',kuota_perizinan_pengguna='$kuota_perizinan_pengguna',status_pengguna='$status_pengguna',status_fitur_chat_pengguna='$status_fitur_chat_pengguna',foto_pengguna='$nama_gambar_baru' WHERE id_pengguna='$id_pengguna'";
            $simpan = mysqli_query($connect, $sql);
            // periska query apakah ada error
            if (!$simpan) {
                die ("Query gagal dijalankan: " . mysqli_errno($connect) .
                    " - " . mysqli_error($connect));
            } else {
                //tampil alert dan akan redirect ke halaman index.php
                //silahkan ganti index.php sesuai halaman yang akan dituju
                if ($logo_instansi_pengguna != "") {
                    $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
                    $x = explode('.', $logo_instansi_pengguna); //memisahkan nama file dengan ekstensi yang diupload
                    $ekstensi = strtolower(end($x));
                    $file_tmp = $_FILES['logo_instansi_pengguna']['tmp_name'];
                    $angka_acak = rand(1, 999);
                    $nama_gambar_baru_2 = $angka_acak . '-' . $logo_instansi_pengguna; //menggabungkan angka acak dengan nama file sebenarnya
                    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                        move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru_2); //memindah file gambar ke folder gambar
                        // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                        $sql = "UPDATE pengguna SET logo_instansi_pengguna='$nama_gambar_baru_2' WHERE id_pengguna='$id_pengguna'";
                        $simpan = mysqli_query($connect, $sql);
                        // periska query apakah ada error
                        if (!$simpan) {
                            die ("Query gagal dijalankan: " . mysqli_errno($connect) ." - " . mysqli_error($connect));
                        } else {
                            echo "<script>alert('Sukses Memperbarui Data');window.location='../form-pengguna.php?data=pengguna&action=add&sd=".$sd."';</script>";
                        }
                     }else{
                    echo "<script>alert('Format Gambar Tidak Sesuai');window.location='../form-pengguna.php?data=pengguna&action=add&sd=".$sd."';</script>";
                    }
                }else{
                     //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Logo instansi tidak diperbarui.');window.location='../daftar-pengguna.php?data=pengguna&sd=".$sd."';</script>";
                }
            }
        } else {
              echo "<script>alert('Format Gambar Tidak Sesuai');window.location='../form-pengguna.php?data=pengguna&action=add&sd=".$sd."';</script>";
        }
    } else {
        $sql = "UPDATE pengguna SET nama_pengguna='$nama_pengguna',tempat_lahir_pengguna='$tempat_lahir_pengguna',tanggal_lahir_pengguna='$tanggal_lahir_pengguna',alamat_pengguna='$alamat_pengguna',no_hp_pengguna='$no_hp_pengguna',email_pengguna='$email_pengguna',password_pengguna='$password_pengguna',instansi_pengguna='$instansi_pengguna',kuota_perizinan_pengguna='$kuota_perizinan_pengguna',status_pengguna='$status_pengguna',status_fitur_chat_pengguna='$status_fitur_chat_pengguna' WHERE id_pengguna='$id_pengguna'";
        $simpan = mysqli_query($connect, $sql);
        // periska query apakah ada error
        if (!$simpan) {
                die ("Query gagal dijalankan: " . mysqli_errno($connect) .
                    " - " . mysqli_error($connect));
        } else {
            echo "<script>alert('Foto Pengguna dan Logo instansi tidak diperbarui.');window.location='../daftar-pengguna.php?data=pengguna&sd=".$sd."';</script>";
         }
    }
}
if($action == 'editakun'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_pengguna = $_POST['id_pengguna'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $tempat_lahir_pengguna = $_POST['tempat_lahir_pengguna'];
    $tanggal_lahir_pengguna = $_POST['tanggal_lahir_pengguna'];
    $alamat_pengguna = $_POST['alamat_pengguna'];
    $no_hp_pengguna = $_POST['no_hp_pengguna'];
    $email_pengguna = $_POST['email_pengguna'];
    $password_pengguna = $_POST['password_pengguna'];
    $instansi_pengguna = $_POST['instansi_pengguna'];
    $kuota_perizinan_pengguna = $_POST['kuota_perizinan_pengguna'];
    $status_fitur_chat_pengguna = $_POST['status_fitur_chat_pengguna'];
    $status_pengguna = $sd;
    $foto_pengguna = $_FILES['foto_pengguna']['name'];
    $logo_instansi_pengguna = $_FILES['logo_instansi_pengguna']['name'];
    if ($foto_pengguna != "") { 
        $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
        $x = explode('.', $foto_pengguna); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['foto_pengguna']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto_pengguna; //menggabungkan angka acak dengan nama file sebenarnya
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $sql = "UPDATE pengguna SET nama_pengguna='$nama_pengguna',tempat_lahir_pengguna='$tempat_lahir_pengguna',tanggal_lahir_pengguna='$tanggal_lahir_pengguna',alamat_pengguna='$alamat_pengguna',no_hp_pengguna='$no_hp_pengguna',email_pengguna='$email_pengguna',password_pengguna='$password_pengguna',instansi_pengguna='$instansi_pengguna',kuota_perizinan_pengguna='$kuota_perizinan_pengguna',status_pengguna='$status_pengguna',status_fitur_chat_pengguna='$status_fitur_chat_pengguna',foto_pengguna='$nama_gambar_baru' WHERE id_pengguna='$id_pengguna'";
            $simpan = mysqli_query($connect, $sql);
            // periska query apakah ada error
            if (!$simpan) {
                die ("Query gagal dijalankan: " . mysqli_errno($connect) .
                    " - " . mysqli_error($connect));
            } else {
                //tampil alert dan akan redirect ke halaman index.php
                //silahkan ganti index.php sesuai halaman yang akan dituju
                if ($logo_instansi_pengguna != "") {
                    $ekstensi_diperbolehkan = array('png', 'jpg','jpeg'); //ekstensi file gambar yang bisa diupload
                    $x = explode('.', $logo_instansi_pengguna); //memisahkan nama file dengan ekstensi yang diupload
                    $ekstensi = strtolower(end($x));
                    $file_tmp = $_FILES['logo_instansi_pengguna']['tmp_name'];
                    $angka_acak = rand(1, 999);
                    $nama_gambar_baru_2 = $angka_acak . '-' . $logo_instansi_pengguna; //menggabungkan angka acak dengan nama file sebenarnya
                    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                        move_uploaded_file($file_tmp, '../upload/' . $nama_gambar_baru_2); //memindah file gambar ke folder gambar
                        // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                        $sql = "UPDATE pengguna SET logo_instansi_pengguna='$nama_gambar_baru_2' WHERE id_pengguna='$id_pengguna'";
                        $simpan = mysqli_query($connect, $sql);
                        // periska query apakah ada error
                        if (!$simpan) {
                            die ("Query gagal dijalankan: " . mysqli_errno($connect) ." - " . mysqli_error($connect));
                        } else {
                            echo "<script>alert('Sukses Memperbarui Data');window.location='../dashboard.php?data=home&menu=akun&action=editakun&id=".$id_pengguna."';</script>";
                        }
                     }else{
                    echo "<script>alert('Format Gambar Tidak Sesuai');window.location='../dashboard.php?data=home&menu=akun&action=editakun&id=".$id_pengguna."';</script>";
                    }
                }else{
                     //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Logo instansi tidak diperbarui.');window.location='../dashboard.php?data=home&menu=akun&action=editakun&id=".$id_pengguna."';</script>";
                }
            }
        } else {
              echo "<script>alert('Format Gambar Tidak Sesuai');window.location='../dashboard.php?data=home&menu=akun&action=editakun&id=".$id_pengguna."';</script>";
        }
    } else {
        $sql = "UPDATE pengguna SET nama_pengguna='$nama_pengguna',tempat_lahir_pengguna='$tempat_lahir_pengguna',tanggal_lahir_pengguna='$tanggal_lahir_pengguna',alamat_pengguna='$alamat_pengguna',no_hp_pengguna='$no_hp_pengguna',email_pengguna='$email_pengguna',password_pengguna='$password_pengguna',instansi_pengguna='$instansi_pengguna',kuota_perizinan_pengguna='$kuota_perizinan_pengguna',status_pengguna='$status_pengguna',status_fitur_chat_pengguna='$status_fitur_chat_pengguna' WHERE id_pengguna='$id_pengguna'";
        $simpan = mysqli_query($connect, $sql);
        // periska query apakah ada error
        if (!$simpan) {
                die ("Query gagal dijalankan: " . mysqli_errno($connect) .
                    " - " . mysqli_error($connect));
        } else {
            echo "<script>alert('Foto Pengguna dan Logo instansi tidak diperbarui.');window.location='../dashboard.php?data=home&menu=akun&action=editakun&id=".$id_pengguna."';</script>";
         }
    }
}
if($action == 'aktifkan'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id = $_GET['id'];
    $sql = "UPDATE pengguna SET status_fitur_chat_pengguna='aktif' WHERE id_pengguna='$id'";
    $simpan = mysqli_query($connect, $sql);
    if($simpan == true){
       echo "<script>alert('Berhasil Memproses Data');window.location='../daftar-pengguna.php?data=bantuan&sd=".$sd."';</script>";
    }else{
       echo "<script>alert('Gagal Memproses Data');window.location='../daftar-pengguna.php?data=bantuan&sd=".$sd."';</script>";
    }
}
if($action == 'nonaktifkan'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id = $_GET['id'];
    $sql = "UPDATE pengguna SET status_fitur_chat_pengguna='nonaktif' WHERE id_pengguna='$id'";
    $simpan = mysqli_query($connect, $sql);
    if($simpan == true){
       echo "<script>alert('Berhasil Memproses Data');window.location='../daftar-pengguna.php?data=bantuan&sd=".$sd."';</script>";
    }else{
       echo "<script>alert('Gagal Memproses Data');window.location='../daftar-pengguna.php?data=bantuan&sd=".$sd."';</script>";
    }
}
if($action == 'perizinan'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_pengguna = $_POST['id_pengguna'];
    $kuota_perizinan_pengguna = $_POST['kuota_perizinan_pengguna'];
    $sql = "UPDATE pengguna SET kuota_perizinan_pengguna='$kuota_perizinan_pengguna' WHERE id_pengguna='$id_pengguna'";
    $simpan = mysqli_query($connect, $sql);
    if($simpan == true){
       echo "<script>alert('Berhasil Memproses Data');window.location='../form-perizinan.php?data=perizinan&action=perizinan&sd=".$sd."';</script>";
    }else{
       echo "<script>alert('Gagal Memproses Data');window.location='../form-perizinan.php?data=perizinan&action=perizinan&sd=".$sd."';</script>";
    }
}
if($action == 'delete'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id = $_GET['id'];
    $sql = "DELETE FROM pengguna WHERE id_pengguna='$id'";
    $simpan = mysqli_query($connect, $sql);
    if($simpan == true){
       echo "<script>alert('Berhasil Memproses Data');window.location='../daftar-pengguna.php?data=pengguna&sd=".$sd."';</script>";
    }else{
       echo "<script>alert('Gagal Memproses Data');window.location='../daftar-pengguna.php?data=pengguna&sd=".$sd."';</script>";
    }
}