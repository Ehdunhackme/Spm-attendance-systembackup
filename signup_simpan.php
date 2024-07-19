<?php
require 'database.php';

# SAMBUNG KE P/DATA
# TERIMA NILAI YG DI POST
if (isset($_POST['hantar'])) {
    if ($_POST['jantina'] == NULL) {
        echo "<script>alert('Sila pilih jantina');
        window.location='signup.php'</script>";
    } else {
        # TERIMA VALUE YANG DI POST
        $idMurid = $_POST['idMurid'];
        $LP = $_POST['jantina'];
        $namaMurid = $_POST['namaMurid'];
        $nomHP = $_POST['nomHP'];
        # PASSWORD
        $kataLaluan = $_POST['kataLaluan'];
        
        # SEMAK DULU REKOD SEDIA ADA
        $semakan1 = mysqli_query($con, "SELECT * FROM hp WHERE nomHP='$nomHP'");
        $semakan2 = mysqli_query($con, "SELECT * FROM peserta WHERE idMurid='$idMurid'");
        
        # LAKSANA ATURCARA
        $detail1 = mysqli_num_rows($semakan1);
        $detail2 = mysqli_fetch_array($semakan2);
        
        # PASTIKAN TIADA REKOD
        if (($detail1 == 0) AND ($detail2 == 0)) {
            mysqli_query($con, "INSERT INTO hp VALUES('$nomHP', '$namaMurid')") or die(mysqli_error($con));
            mysqli_query($con, "INSERT INTO peserta VALUES('$idMurid', '$LP', '$nomHP', '$kataLaluan')") or die(mysqli_error($con));
            echo "<script>alert('Pendaftaran berjaya!'); window.location='index.php'</script>";
        } else {
            echo "<script>alert('Pendaftaran gagal, Semak Nombor ID/HP'); window.location='signup.php'</script>";
        }
    }
}
?>
