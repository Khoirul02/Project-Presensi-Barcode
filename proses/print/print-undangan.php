<!doctype html>
<html>
<?php
include "../../connection/config.php";
function tgl_indo($tanggal){
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember');
    $pecahkan = explode('-', $tanggal);
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
     }
     $id = $_GET['id'];
     $query = mysqli_query($conn, "SELECT * FROM tamu WHERE id_tamu='$id'");
     $data_tb_tamu = mysqli_fetch_array($query);
     $id_acara = $data_tb_tamu['id_acara']; 
     $query_2 = mysqli_query($conn, "SELECT * FROM acara WHERE id_acara='$id_acara'");
     $data_tb_acara = mysqli_fetch_array($query_2);
     $id_pengguna = $data_tb_acara['id_pengguna'];
     $query_3 = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna='$id_pengguna'");
     $data_tb_pengguna = mysqli_fetch_array($query_3);
?>
<head>
    <meta charset="utf-8">
    <title>Undangan-<?php echo $data_tb_tamu['nama_tamu']; ?></title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 10px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    body {
      margin: 0;
      padding: 0;
      background-color: #FAFAFA;
      font: 12pt "Tahoma";
    }

    * {
      box-sizing: border-box;
      -moz-box-sizing: border-box;
    }

    .page {
      width: 21cm;
      min-height: 29.7cm;
      padding: 2cm;
      margin: 1cm auto;
      border: 1px #D3D3D3 solid;
      border-radius: 5px;
      background: white;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
      padding: 1cm;
      border: 5px red solid;
      height: 256mm;
      outline: 2cm #FFEAEA solid;
    }

    @page {
      size: A4;
      margin: 0;
    }

    @media print {
      .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
      }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
             <tr class="top">
                <td colspan="2">
                    <br>
                    <table style="border: 4px solid #eee">
                        <tr>
                            <td style="text-align: center;">
                                <br>
                                <img src="../../upload/<?php echo $data_tb_acara['foto_poster_acara'] ?>" style="width: 200px;border-radius: 50%;"><br>
                                <p style="font-weight: bold;"><?php echo $data_tb_acara['nama_acara']; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <?php
                            if($data_tb_acara['tanggal_mulai_acara'] == $data_tb_acara['tanggal_selesai_acara']){
                                $tanggal_acara = tgl_indo($data_tb_acara['tanggal_mulai_acara']);
                            }else{
                                $tanggal_acara = tgl_indo($data_tb_acara['tanggal_mulai_acara'])." - ".tgl_indo($data_tb_acara['tanggal_selesai_acara']);
                            }
                            ?>
                            <td>
                                Tanggal dan Waktu Acara<br>
                                <?php echo $tanggal_acara; ?><br>
                                Pukul <?php echo substr($data_tb_acara['waktu_mulai_acara'],0, 5)." - ".substr($data_tb_acara['waktu_selesai_acara'],0,5)." ".$data_tb_acara['zona_waktu_acara'] ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Yth. Kepada  
                </td>
                <td style="padding-right: 20px">
                    Barcode Anda 
                </td>
            </tr>
            
            <tr class="details">
                <td> 
                    <br>
                     <?php echo $data_tb_tamu['nama_tamu']; ?><br>
                     <?php echo $data_tb_tamu['email_tamu']; ?><br>
                     <?php echo $data_tb_tamu['instansi_tamu']; ?> <br>
                     <?php echo $data_tb_tamu['no_hp_tamu']; ?>
                </td>
                <td>
                    <img src="../../upload/barcode/<?php echo $data_tb_tamu['gambar_barcode_tamu'] ?>" style="width:40%;">
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Pesan / Deskripsi / Kententuan
                </td>
                <td>
                    Acara <?php echo $data_tb_acara['nama_acara']; ?>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Pesan
                </td>
                
                <td>
                    <?php echo $data_tb_acara['pesan_acara']; ?>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Deskripsi
                </td>
                
                <td>
                    <?php echo $data_tb_acara['deskripsi_acara']; ?>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Ketentuan
                </td>
                
                <td>
                    <?php echo $data_tb_acara['ketentuan_acara']; ?>
                </td>
            </tr>
            <tr class="top">
                <td colspan="2">
                    <br>
                    <table style="border: 4px solid #eee">
                        <tr>
                            <td style="text-align: center;">
                                <br>
                                <img src="../../upload/<?php echo $data_tb_pengguna['logo_instansi_pengguna'] ?>" style="width: 200px;border-radius: 50%;"><br>
                                <p style="font-weight: bold;"><?php echo $data_tb_pengguna['instansi_pengguna']; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
<script>
        window.print();
</script>
</html>
