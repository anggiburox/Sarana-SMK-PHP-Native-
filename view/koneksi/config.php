<?php
    $host="localhost";          // variabel host = localhost
    $user="root";               // variabel user = root
    $pass="";                 // variabel pass =kosong (karena xampp yang digunakan tidak menggunakan password)
    $database="inventaris";             //variabel db = nama database yang kita buat
   
    $db=mysqli_connect($host, $user, $pass) or die (mysqli_error());   //mengkoneksikan ke database
    mysqli_select_db($db, $database);                 // memilih database
?>