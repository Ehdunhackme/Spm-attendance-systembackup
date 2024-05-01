<?php
#MULA SESI
session_start();
#SAMBUNG KE PANGKALAN DATA
require 'database.php';
?>
<html> 
<!-- PANGGIL CSS EXTERNAL -->
<link rel="stylesheet" type="text/css" href="style.css">
<!-- NAMA SISTEM DI TITLE BAR BROWSER -->
<title><?php echo $namaSistem; ?></title>
<!--- PAPAR MAKLUMAT SISTEM DI BANER -->
<div class="header">
    <br>
    <h1 style="font-size: 45px;"><?php echo $namasys1; ?></h1>
    <!-- PAAPR UTIKITI BUTANG ZOOM IN OUT WARNA -->
    <?php include('utiliti.php'); ?>
</div>
</html>