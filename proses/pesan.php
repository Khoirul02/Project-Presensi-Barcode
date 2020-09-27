<?php
$action = $_GET['action'];
if(isset($_GET['lingkup'])){
    $lingkup = $_GET['lingkup'];
}else{
    $lingkup = "";
}
$pengirim = $_GET['pengirim'];
if($action == 'add') {
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_pengirim_pesan = $_POST['id_pengirim_pesan'];
    $id_penerima_pesan = $_POST['id_penerima_pesan'];
    $isi_pesan = $_POST['isi_pesan'];
    $randomString = $lingkup; 
    $sql = "INSERT INTO pesan(id_pengirim_pesan,id_penerima_pesan,isi_pesan,lingkup_pesan)VALUE('$id_pengirim_pesan','$id_penerima_pesan','$isi_pesan','$randomString')";
    $simpan = mysqli_query($connect, $sql);
    if ($simpan == true) {
        
        header('location: ../dashboard.php?data=home&menu=pesan&status=detail-pesan&lingkup='.$lingkup.'&pengirim='.$pengirim.'');    
    } else {
        header('location: ../dashboard.php?data=home&menu=pesan&status=gagal');
    }
}elseif($action == 'addadmin'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_pengirim_pesan = $_POST['id_pengirim_pesan'];
    $id_penerima_pesan = $_POST['id_penerima_pesan'];
    $isi_pesan = $_POST['isi_pesan'];
    if($lingkup == ''){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    }else{
        $randomString = $lingkup;
    } 
    $sql = "INSERT INTO pesan(id_pengirim_pesan,id_penerima_pesan,isi_pesan,lingkup_pesan)VALUE('$id_pengirim_pesan','$id_penerima_pesan','$isi_pesan','$randomString')";
    $simpan = mysqli_query($connect, $sql);
    if ($simpan == true) {

        header('location: ../dashboard.php?data=home&status=detail-pesan&lingkup='.$lingkup.'&pengirim='.$pengirim.'');    
    } else {
        header('location: ../dashboard.php?data=home&menu=pesan&status=gagal');
    }
}elseif($action == 'addpanitia'){
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_pengirim_pesan = $_POST['id_pengirim_pesan'];
    $id_penerima_pesan = $_POST['id_penerima_pesan'];
    $isi_pesan = $_POST['isi_pesan'];
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 5; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $sql = "INSERT INTO pesan(id_pengirim_pesan,id_penerima_pesan,isi_pesan,lingkup_pesan)VALUE('$id_pengirim_pesan','$id_penerima_pesan','$isi_pesan','$randomString')";
    $simpan = mysqli_query($connect, $sql);
    if ($simpan == true) {
        header('location: ../dashboard.php?data=home&menu=pesan');    
    } else {
        header('location: ../dashboard.php?data=home&menu=pesan&status=gagal');
    }
}else{
    $connect = mysqli_connect("localhost", "root", "", "sistem_absensi_barcode") or die(mysqli_error());
    $id_pengirim_pesan = $_POST['id_pengirim_pesan'];
    $id_penerima_pesan = $_POST['id_penerima_pesan'];
    $isi_pesan = $_POST['isi_pesan'];
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 5; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $sql = "INSERT INTO pesan(id_pengirim_pesan,id_penerima_pesan,isi_pesan,lingkup_pesan)VALUE('$id_pengirim_pesan','$id_penerima_pesan','$isi_pesan','$randomString')";
    $simpan = mysqli_query($connect, $sql);
    if ($simpan == true) {
        header('location: ../dashboard.php?data=home');    
    } else {
        header('location: ../dashboard.php?data=home&menu=pesan&status=gagal');
    }
}
