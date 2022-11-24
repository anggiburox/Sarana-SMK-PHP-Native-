<?php 
    // Tentukan path yang tepat ke mPDF
$nama_dokumen='Laporan Data Peminjaman Barang '; //Beri nama file PDF hasil.
define('_MPDF_PATH','../../vendors/MPDF57/'); // Tentukan folder dimana anda menyimpan folder mpdf
include(_MPDF_PATH . "mpdf.php"); // Arahkan ke file mpdf.php didalam folder mpdf
$mpdf=new mPDF('utf-8', 'A4', 10.5, 'arial'); // Membuat file mpdf baru
 
//Memulai proses untuk menyimpan variabel php dan html
ob_start();
 ?>
    <style>
    table{
        border-collapse: collapse;
        margin-top: 40px;
    }
    th{ 
        color: black;
        padding-top: 0px;
        border-top: 1px solid #999;
    }
    table, th ,td{
        border: 1px solid #999;
        margin-bottom: 10px;
        text-align: center;
    }
    .position{
        text-align: center;
        margin-top: 15px;
    }
    .position1{
        margin-left: -410px;
        margin-bottom: -5px;
        margin-top: -20px;
    }
    hr{
        width: 700px;
        border: 1px solid black;
    }
    img{
        margin-left: -650px;
        margin-bottom: -25px
    }
    h3{
        text-align: center;
        margin-top: 5px;
        margin-bottom: 10px;
    }
    .batas tr, td{
        margin-top: -100px;
    }
    .image{
        margin-top: -100px;
    }
</style>
<div class="position">
    <img src="../../assets/images/images.png" width="60" height="60">
    <br><h3 class="position1">Inventaris SMK</h3>
</div> 
    <table width="100%">
            <thead>
                <tr></th>                           
                <th>ID Detail</th>
                <th>Nama Peminjam</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Jumlah Pinjam</th>
                <th>Lokasi Pinjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Kondisi Barang</th>
                <th>Status</th>

                <!-- <th>Status</th> -->
                <!-- <th>File</th> -->
            </thead>
            <tbody>
                <?php 
    include('../koneksi/config.php');
    $id_detail = $_GET['id_detail'];
    
    $idm = $_GET['id_peminjam'];
    
    $sql = "SELECT detail_pinjam_barang. *, pinjam_barang.tgl_kembali, pinjam_barang.tgl_pinjam, pinjam_barang.status, lokasi.lokasi, peminjam.nama_peminjam, barang.id_barang, barang.nama_barang, barang.jumlah_barang, barang.kondisi
         FROM  detail_pinjam_barang
         INNER JOIN pinjam_barang on detail_pinjam_barang.id_pinjam = pinjam_barang.id_pinjam
         INNER JOIN peminjam on pinjam_barang.id_peminjam = peminjam.id_peminjam
         INNER JOIN lokasi on peminjam.lokasi = lokasi.lokasi
         INNER JOIN barang on detail_pinjam_barang.id_barang = barang.id_barang 
         WHERE peminjam.id_peminjam = '$idm' ";
    $query = mysqli_query($db, $sql);
    while ($data = mysqli_fetch_array($query)) {
        ?>
                <tr>
                    <td><?php echo $data['id_detail']?></td>
                    <th><?php echo $data['nama_peminjam']?></th>
                    <td><?php echo $data['id_barang']; ?></td>
                    <td><?php echo $data['nama_barang']?></td>
                    <td><?php echo $data['jumlah_barang']?></td>
                    <td><?php echo $data['jumlah']; ?></td>
                    <td><?php echo $data['lokasi']; ?></td>
                    <td><?php echo $data['tgl_pinjam'] ?></td>
                    <td><?php echo $data['tgl_kembali']; ?></td>
                    <td><?php echo $data['kondisi']; ?></td>
                    <td><?php echo $data['status']; ?></td>
                </tr>
        

        <?php
    } 
?>
            </tbody>
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
?>       >