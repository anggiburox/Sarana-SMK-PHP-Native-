<?php 
    // Tentukan path yang tepat ke mPDF
$nama_dokumen='Laporan Data Barang Keluar'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../../vendors/MPDF57/'); // Tentukan folder dimana anda menyimpan folder mpdf
include(_MPDF_PATH . "mpdf.php"); // Arahkan ke file mpdf.php didalam folder mpdf
$mpdf=new mPDF('utf-8', 'A4', 10.5, 'arial'); // Membuat file mpdf baru
 
//Memulai proses untuk menyimpan variabel php dan html
ob_start();
 ?>
<style>
    table{
        border-collapse: collapse;
    }
    th{
        background-color: #73879C; 
        color: #fff;
        padding: 5px;
    }
    table, th ,td{
        border: 1px solid #999;
        padding: 5px;
    }
    .position{
        text-align: center;
        margin-top: -15px;
    }
    hr{
        width: 700px;
        border: 1px solid black;
    }
    img{
        margin-left: -630px;
        margin-bottom: -45px
    }
    h3{
        text-align: center;
        margin-top: 5px;
        margin-bottom: 10px;
    }
</style>
<div class="position">
    <img src="../../assets/images/images.png" width="60" height="60">
    <br><tr>
        <td h3>Inventaris SMK</td>
        <br>
        <td h3>Jln.Raya Cileunyi Kab.Bandung Jawa Barat</td>
    </tr>
<hr>
</div>
    <table width="100%">
            <thead>
            <tr>          <th>No</th>
                          <th>ID Barang</th>
                          <th>Nama Barang</th>
                          <th>Jumlah Barang</th>
                          <th>Jumlah Keluar</th>
                          <th>Tanggal Keluar</th>
                          <th>Lokasi</th>
            </tr>
                <!-- <th>Status</th> -->
                <!-- <th>File</th> -->
            </thead>
<?php 
include "../koneksi/config.php";
$sql = "SELECT * FROM barang_keluar
    INNER JOIN barang on barang_keluar.id_barang = barang.id_barang
    INNER JOIN lokasi on barang_keluar.lokasi = lokasi.lokasi";
$query = mysqli_query($db, $sql);
$no = 1;
while ($data=mysqli_fetch_array($query)){
?>
            <tbody>
                <tr>      
                          <td><?php echo $no ?></td>
                          <td><?php echo $data['id_barang'] ?></td>
                          <td><?php echo $data['nama_barang'] ?></td>
                          <td><?php echo $data['jumlah_barang'] ?></td>
                          <td><?php echo $data['jml_keluar'] ?></td>
                          <td><?php echo $data['tgl_keluar'] ?></td>
                          <td><?php echo $data['lokasi']?></td>
                </tr>
            </tbody>
            <?php
                }
                $no++
            ?>
    </table>           
<?php 
$mpdf->setFooter('{PAGENO}');
//penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'D');
exit;
?>       