<?php
#KEKALKAN SETUP INI
#SET TIME ZONE WAKTU
date_default_timezone_set('Asia/Kuala_Lumpur');
$tarikhKini = date('Y-m-d');
$masaKini = date('H:i:s');

#SETTING DATABASE
$host = 'localhost';
$user = 'root';

#UBAH DI SINI NAMA DB
$db='sk';
$password = '';

#SAMBUUNG PANGKALAN DATA
$con = mysqli_connect($host, $user, $password, $db);

#PAPAARKAN MSG JIKA SAMBUNGAN GAGAL
if (mysqli_connect_errno())
  {
  echo "Databse tidak berhubung!: " . mysqli_connect_error();
  }

#UBAH DI SINI UNTUK TETAPAN SISTEM
$namaSistem = 'Sistem Kehadiran Hari Sukan Sekolah';
$namasys1 = 'Sistem Kehadiran Hari Sukan Sekolah'; 
?>

