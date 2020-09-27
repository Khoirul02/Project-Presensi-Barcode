<?php
session_start();
include "../connection/config.php";
$email_pengguna = $_POST['email_pengguna'];
$password_pengguna = $_POST['password_pengguna'];
// query untuk mendapatkan record dari username
$data = mysqli_query($conn, "SELECT * FROM pengguna WHERE email_pengguna= '$email_pengguna' and password_pengguna='$password_pengguna'");
$user = mysqli_fetch_assoc($data);
$cek = mysqli_num_rows($data);
$id_pengguna = $user['id_pengguna'];
$status_pengguna = $user['status_pengguna'];
if($cek  > 0) {
    if($status_pengguna == "superadmin"){
        $_SESSION['nama_pengguna']= $user['nama_pengguna'];
        $_SESSION['tempat_lahir_pengguna']= $user['tempat_lahir_pengguna'];
        $_SESSION['tanggal_lahir_pengguna']= $user['tanggal_lahir_pengguna'];
        $_SESSION['alamat_pengguna'] = $user['alamat_pengguna'];
        $_SESSION['no_hp_pengguna'] = $user['no_hp_pengguna'];
        $_SESSION['email_pengguna']= $email_pengguna;
        $_SESSION['instansi_pengguna']= $user['instansi_pengguna'];
        $_SESSION['foto_pengguna']= $user['foto_pengguna'];
        $_SESSION['logo_instansi_pengguna']= $user['logo_instansi_pengguna'];
        $_SESSION['kuota_perizinan_pengguna']= $user['kuota_perizinan_pengguna'];
        $_SESSION['status_fitur_chat_pengguna']= $user['status_fitur_chat_pengguna'];
        $_SESSION['status_pengguna']= $status_pengguna;
        $_SESSION['id_pengguna']= $id_pengguna;
        header("Location:../dashboard.php?data=home");
    } else if ($status_pengguna == "admin"){
        $_SESSION['nama_pengguna']= $user['nama_pengguna'];
        $_SESSION['tempat_lahir_pengguna']= $user['tempat_lahir_pengguna'];
        $_SESSION['tanggal_lahir_pengguna']= $user['tanggal_lahir_pengguna'];
        $_SESSION['alamat_pengguna'] = $user['alamat_pengguna'];
        $_SESSION['no_hp_pengguna'] = $user['no_hp_pengguna'];
        $_SESSION['email_pengguna']= $email_pengguna;
        $_SESSION['instansi_pengguna']= $user['instansi_pengguna'];
        $_SESSION['foto_pengguna']= $user['foto_pengguna'];
        $_SESSION['logo_instansi_pengguna']= $user['logo_instansi_pengguna'];
        $_SESSION['kuota_perizinan_pengguna']= $user['kuota_perizinan_pengguna'];
        $_SESSION['status_fitur_chat_pengguna']= $user['status_fitur_chat_pengguna'];
        $_SESSION['status_pengguna']= $status_pengguna;
        $_SESSION['id_pengguna']= $id_pengguna;
        header("Location:../dashboard.php?data=home");
    }else{
        $_SESSION['nama_pengguna']= $user['nama_pengguna'];
        $_SESSION['tempat_lahir_pengguna']= $user['tempat_lahir_pengguna'];
        $_SESSION['tanggal_lahir_pengguna']= $user['tanggal_lahir_pengguna'];
        $_SESSION['alamat_pengguna'] = $user['alamat_pengguna'];
        $_SESSION['no_hp_pengguna'] = $user['no_hp_pengguna'];
        $_SESSION['email_pengguna']= $email_pengguna;
        $_SESSION['instansi_pengguna']= $user['instansi_pengguna'];
        $_SESSION['foto_pengguna']= $user['foto_pengguna'];
        $_SESSION['logo_instansi_pengguna']= $user['logo_instansi_pengguna'];
        $_SESSION['kuota_perizinan_pengguna']= $user['kuota_perizinan_pengguna'];
        $_SESSION['status_fitur_chat_pengguna']= $user['status_fitur_chat_pengguna'];
        $_SESSION['status_pengguna']= $status_pengguna;
        $_SESSION['id_pengguna']= $id_pengguna;
        header("Location:../dashboard.php?data=home&menu=home");
    }
    echo json_encode($response);
}else{
    echo '<script>
        alert("Gagal login, Data yang anda masukan salah!");
        window.location = "../login.php"
        </script>';
    }
?>