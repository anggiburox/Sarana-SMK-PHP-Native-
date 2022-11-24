<?php 
    // Tentukan path yang tepat ke mPDF
$nama_dokumen='Laporan Data Barang Masuk'; //Beri nama file PDF hasil.
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
<h3>Laporan Data Barang Masuk</h3>
    <table width="100%">
            <thead>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>  
                <th>Tanggal Masuk</th>
                <th>Jumlah Masuk</th>
                <th>ID Suplier</th>
                <th>Nama Suplier</th>
                <th>Alamat Suplier</th>
            </tr>
                <!-- <th>Status</th> -->
                <!-- <th>File</th> -->
            </thead>
            <?php 
            include "../koneksi/config.php";
            $id = $_GET['id'];
$sql = "SELECT * FROM barang_masuk
        INNER JOIN barang on barang_masuk.id_barang = barang.id_barang
        INNER JOIN suplier on barang_masuk.id_suplier = suplier.id_suplier WHERE barang_masuk.id ='$id'";
$query=mysqli_query($db, $sql);
$no=1;
while ($data=mysqli_fetch_array($query)){
             ?>
            <tbody>
                <tr>
                    <td><?php echo $data['id_barang']; ?></td>
                    <td><?php echo $data['nama_barang']; ?></td>
                    <td><?php echo $data['tgl_masuk']; ?></td>
                    <td><?php echo $data['jml_masuk']; ?></td>
                    <td><?php echo $data['id_suplier']; ?></td>
                    <td><?php echo $data['nama_suplier']?></td>
                    <td><?php echo $data['alamat_suplier']?></td>
                </tr>
            </tbody>
            <?php
                }
                $no++
            ?>
    </table>      
    <br>
        <table style="width: 100%; border: 1px;">
                <tr>
                    <td colspan="2" style="text-align: right; border: 0;">Petugas Inventaris</td>
                </tr>
                <br><br><br><br>
                <tr>
                    <td colspan="2" style="text-align: right; border: 0;">___________________</td>
                </tr>
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