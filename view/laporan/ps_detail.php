<?php 
    // Tentukan path yang tepat ke mPDF
$nama_dokumen='Laporan Data Peminjaman Barang'; //Beri nama file PDF hasil.
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
    .position1{
        margin-left: -410px;
        margin-bottom: -5px;
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
            <tr>
                          <th>ID Detail</th>
                          <th>Nama Peminjam</th>
                          <th>Nama Barang</th>
                          <th>Jumlah Barang</th>
                          <th>Jumlah Pinjam</th>
                          <th>Lokasi Pinjam</th>
                          <th>Tanggal Pinjam</th>
                          <th>Tanggal Kembali</th>
                          <th>Kondisi Barang</th>
                          <th>Status</th>
            </tr>
                <!-- <th>Status</th> -->
                <!-- <th>File</th> -->
            </thead>
            <?php 
            include "../koneksi/config.php";
  $sql = "SELECT detail_pinjam_barang. *, pinjam_barang.tgl_kembali, pinjam_barang.tgl_pinjam, pinjam_barang.status, lokasi.lokasi, peminjam.nama_peminjam, barang.id_barang, barang.nama_barang, barang.jumlah_barang, barang.kondisi
         FROM  detail_pinjam_barang
         INNER JOIN pinjam_barang on detail_pinjam_barang.id_pinjam = pinjam_barang.id_pinjam
         INNER JOIN peminjam on pinjam_barang.id_peminjam = peminjam.id_peminjam
         INNER JOIN lokasi on peminjam.lokasi = lokasi.lokasi
         INNER JOIN barang on detail_pinjam_barang.id_barang = barang.id_barang";
$query = mysqli_query($db, $sql);
  while ($data=mysqli_fetch_array($query)){
             ?>
            <tbody>
                <tr>
                          <td><?php echo $data['id_detail']?></td>
                          <td><?php echo $data['nama_peminjam']?></td>
                          <td><?php echo $data['nama_barang']?></td>
                          <td><?php echo $data['jumlah_barang']?></td>
                          <td><?php echo $data['jumlah']?></td>
                          <td><?php echo $data['lokasi']?></td>
                          <td><?php echo $data['tgl_pinjam']?></td>
                          <td><?php echo $data['tgl_kembali']?></td>
                          <td><?php echo $data['kondisi']?></td>
                          <td><?php echo $data['status']?></td>
                </tr>
            </tbody>
            <?php
                }
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