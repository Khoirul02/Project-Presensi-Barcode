<?php
$action = $_GET['action'];
if(isset($_GET['id_acara'])){
    $id_acara = $_GET['id_acara'];
}
if($action == 'add') {
    include "../phpqrcode/qrlib.php";
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_tamu = $_POST['id_tamu'];
    $id_acara = $_POST['id_acara'];
    $nama_tamu = $_POST['nama_tamu'];
    $alamat_tamu = $_POST['alamat_tamu'];
    $no_hp_tamu = $_POST['no_hp_tamu'];
    $email_tamu = $_POST['email_tamu'];
    $instansi_tamu = $_POST['instansi_tamu'];
    $keterangan_lain_tamu = $_POST['keterangan_lain_tamu'];
    $gambar_barcode_tamu = QRcode::png("$_POST[id_tamu]", "../upload/barcode/$_POST[id_tamu].png", "L", 6, 6);
    $status_kehadiran_tamu = 'belum';
    $sql = "INSERT INTO tamu(id_tamu,id_acara,nama_tamu,alamat_tamu,no_hp_tamu,email_tamu,instansi_tamu,keterangan_lain_tamu,gambar_barcode_tamu,status_kehadiran_tamu)VALUE('$id_tamu','$id_acara','$nama_tamu','$alamat_tamu','$no_hp_tamu','$email_tamu','$instansi_tamu','$keterangan_lain_tamu','".$id_tamu.".png','$status_kehadiran_tamu')";
    $simpan = mysqli_query($connect, $sql);
    if ($simpan == true) {
        echo "<script>alert('Berhasil Memproses Data');window.location='../detail-acara.php?data=acara&id=".$id_acara."';</script>";
    } else {
        echo "<script>alert('Gagal Memproses Data');window.location='../form-tamu.php?data=tamu&action=add&id_acara=".$id_acara."';</script>";
    }
}
if($action == 'edit'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_tamu = $_POST['id_tamu'];
    $id_acara = $_POST['id_acara'];
    $nama_tamu = $_POST['nama_tamu'];
    $alamat_tamu = $_POST['alamat_tamu'];
    $no_hp_tamu = $_POST['no_hp_tamu'];
    $email_tamu = $_POST['email_tamu'];
    $instansi_tamu = $_POST['instansi_tamu'];
    $keterangan_lain_tamu = $_POST['keterangan_lain_tamu'];
    $status_kehadiran_tamu = $_POST['status_kehadiran_tamu'];
    $sql = "UPDATE tamu SET nama_tamu='$nama_tamu',alamat_tamu='$alamat_tamu',no_hp_tamu='$no_hp_tamu',email_tamu='$email_tamu',instansi_tamu='$instansi_tamu',keterangan_lain_tamu='$keterangan_lain_tamu',status_kehadiran_tamu='$status_kehadiran_tamu' WHERE id_tamu='$id_tamu'";
    $simpan = mysqli_query($connect, $sql);
    if ($simpan == true) {
        echo "<script>alert('Berhasil Memperbarui Data');window.location='../detail-acara.php?data=acara&id=".$id_acara."';</script>";
    } else {
        echo "<script>alert('Gagal Memproses Data');window.location='../form-tamu.php?data=tamu&action=add&id_acara=".$id_acara."';</script>";
    }
}
if($action == 'hadir'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id = $_GET['id'];
    $query = mysqli_query($connect, "SELECT * FROM tamu WHERE id_tamu='$id'");
    $data_nama = mysqli_fetch_array($query);
    $data_nama_tamu = $data_nama['nama_tamu'];
    date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d h:i:sa");
    $sql = "UPDATE tamu SET status_kehadiran_tamu='hadir',waktu_kehadiran_tamu='$date'  WHERE id_tamu='$id'";
    $simpan = mysqli_query($connect, $sql);
    if($simpan == true){
       echo "<script>alert('Tamu ".$data_nama_tamu." dinyatakan hadir');window.location='../kelola-daftar-hadir.php?data=acara&id=".$id_acara."';</script>";
    }else{
       echo "<script>alert('Gagal Memproses Data');window.location='../kelola-daftar-hadir.php?data=acara&id=".$id_acara."';</script>";
    }
}
if($action == 'hadirtamu'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id = substr($_POST['id_tamu'], -3);
    date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d h:i:sa");
    $query = mysqli_query($connect, "SELECT * FROM tamu WHERE id_tamu='$id'");
    $data_nama = mysqli_fetch_array($query);
    $data_nama_tamu = $data_nama['nama_tamu'];
    $sql = "UPDATE tamu SET status_kehadiran_tamu='hadir',waktu_kehadiran_tamu='$date'  WHERE id_tamu='$id'";
    $simpan = mysqli_query($connect, $sql);
    if($simpan == true){
       echo "<script>alert('Tamu ".$data_nama_tamu." dinyatakan hadir');window.location='../kelola-daftar-hadir.php?data=acara&id=".$id_acara."&status=hadir';</script>";
    }else{
       echo "<script>alert('Gagal Memproses Data');window.location='../kelola-daftar-hadir.php?data=acara&id=".$id_acara."&status=hadir';</script>";
    }
}
if($action == 'tidak'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id = $_GET['id'];
    $query = mysqli_query($connect, "SELECT * FROM tamu WHERE id_tamu='$id'");
    $data_nama = mysqli_fetch_array($query);
    $data_nama_tamu = $data_nama['nama_tamu'];
    date_default_timezone_set('Asia/Jakarta');
    $date = date("Y-m-d h:i:sa");
    $sql = "UPDATE tamu SET status_kehadiran_tamu='tidak',waktu_kehadiran_tamu='$date' WHERE id_tamu='$id'";
    $simpan = mysqli_query($connect, $sql);
    if($simpan == true){
       echo "<script>alert('Tamu ".$data_nama_tamu." tidak dinyatakan hadir');window.location='../kelola-daftar-hadir.php?data=acara&id=".$id_acara."';</script>";
    }else{
       echo "<script>alert('Gagal Memproses Data');window.location='../kelola-daftar-hadir.php?data=acara&id=".$id_acara."';</script>";
    }
}
if($action == 'delete'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id = $_GET['id'];
    $sql = "DELETE FROM tamu WHERE id_tamu='$id'";
    $simpan = mysqli_query($connect, $sql);
    if($simpan == true){
       echo "<script>alert('Berhasil Memproses Data');window.location='../detail-acara.php?data=acara&id=".$id_acara."';</script>";
    }else{
       echo "<script>alert('Gagal Memproses Data');window.location='../detail-acara.php?data=acara&id=".$id_acara."';</script>";
    }
}