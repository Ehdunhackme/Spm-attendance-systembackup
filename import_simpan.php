<?php
require 'database.php';
#TERIMA PAIL CSV POST
if (isset($_POST["import"])) {

    if(!empty($_FILES['file']['name'])) {
        $filename=$_FILES["file"]["tmp_name"];
        $file = fopen($filename, "r");
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) 
        {
            $NAMA = $getData[0];
            $JANTINA = $getData[1];
            $idMurid = $getData[2];
            $HP = $getData[3];
            #PASSWORD
            $PW = $getData[4];

            #MASUKKAN DALAM TABLE
            mysqli_query($con, "INSERT INTO hp
            values('".$HP."','".$NAMA."')");
            mysqli_query($con, "INSERT INTO peserta
            values 
            ('".$idMurid."','".$JANTINA."','".$HP."','".$PW."')");
            echo "<script>alert('Import CSV Berjaya');
            window.location = 'senarai_ahli.php'</script>";
        }
        fclose($file);
    }else{


        echo "<script>alert('pindah naik data CSV gagal');
        window.location = 'import_ahli.php'</script>";

    }
}

?>
