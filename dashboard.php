<?php include 'header.php'; ?>
<!--HTML MULA-->
<html>
<!--PANGGIL MENU-->
<div id="menu">
    <?php include 'menu.php'; ?>
</div>
<!--PAPAR ISI KANDUNGAN-->
<div id="isi">
<!--PAPAR UCAPAN SELAMAT DATANG-->
<h3>Selamat Datang <?php 
echo strtoupper ($_SESSION['namaMurid']);
echo "</h3>TARIKH:".$tarikhKini;
echo "<br>MASA:".$masaKini; ?><hr>
<!--PAPAR PAGE CONTENT-->
<?php
include 'hadir.php';
?>
</div>
</html>