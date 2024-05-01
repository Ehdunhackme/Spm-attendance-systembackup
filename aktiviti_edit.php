<?php
#PANGGIL HEADER
include 'header.php';
#DAPATKAN URL
$AktivitiEdit = $_GET['kodAktiviti'];
#SAMBUNG KE TABLE AKTIVITI
$dataAktiviti = mysqli_query($con, "SELECT * FROM aktiviti 
WHERE kodAktiviti= '$AktivitiEdit'");
$EditAktiviti = mysqli_fetch_array($dataAktiviti);
?>
<?php
#TERIMA NILAI YG DI POST
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $data1 = $_POST['aktiviti'];
    $data2 = $_POST['tarikh'];
    $data3 = $_POST['masaAktiviti'];

    #PROSES KEMASKINI
    $result2 = mysqli_query($con, "UPDATE aktiviti 
    SET keteranganAktiviti='$data1',tarikhAktiviti='$data2',masaAktiviti='$data3'
    WHERE kodAktiviti='$id'");
    echo "<script>alert('Aktiviti telah dikemaskini');
    window.location='aktiviti.php'</script>";
}
?>
<HTML>
<!--PANGGIL MENU-->
<div id="menu">
    <?php include 'menu.php'; ?>
</div>
<!--PANGGIL ISI-->
<div id="isi">
<head>
    <h2>KEMASKINI AKTIVITI</h2>
</head>
<body>
<form method="POST">
<p>KETERANGAN:<br>
<input type="text" name="aktiviti" 
value="<?php echo $EditAktiviti['keteranganAktiviti']; ?>" 
size="70%" required autofocus></p>
<p>MASA:<br>
<input type="time" name="masaAktiviti"
value="<?php echo $EditAktiviti['masaAktiviti']; ?>" size="30%" required></p>
<p>TARIKH:<br>
<input type="date" name="tarikh"
value="<?php echo $EditAktiviti['tarikhAktiviti']; ?>" size="30%" required></p>
<!--PUJUKAN PRIMARY KEY-->
<input type="text" name="id" value="<?php 
echo $EditAktiviti['kodAktiviti']; ?>" hidden>
<br>
<button name="submit" type="submit">KEMASKINI</button>
<br>
<font color="red">*Sila pastikan maklumat diisi dengan betul sebelum simpan.</font>
</form>
</body>
</div>
</HTML>