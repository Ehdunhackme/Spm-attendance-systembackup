<?php
#MULA SESI
session_start();
#SAMBUNG KE PANGKALAN DATA
require 'database.php';

if (isset($_POST['carian'])) {
    $jumpa = $_POST['carian'];
    $query_hadir = mysqli_query($con, "SELECT * FROM kehadiran AS t1
    INNER JOIN peserta AS t2 ON t1.idMurid=t2.idMurid
    INNER JOIN hp AS t3 ON t2.nomHP=t3.nomHP
    INNER JOIN aktiviti AS t4 ON t1.kodAktiviti=t4.kodAktiviti
    WHERE t1.idMurid='$jumpa'
    ORDER BY t3.namaMurid ASC");
    $no = 1;
    if (mysqli_num_rows($query_hadir) > 0) {
        ?>
        <h2><u>LAPORAN KEHADIRAN</u></h2>
        <?php
        $papar = mysqli_fetch_array($query_hadir);
        echo "AKTIVITI : " . $papar['keteranganAktiviti'];
        echo "<br>NAMA : " . $papar['namaMurid'];
        echo "<br>JANTINA : " . $papar['jantina'];
        echo "<br>ID MURID : " . $papar['idMurid'];
        ?>
        <!-- DISPLAY TABLE -->
        <hr><br>
        <table border="1">
            <tr>
                <th>BIL</th>
                <th>TARIKH</th>
                <th>MASA</th>
            </tr>
            <?php
            while ($hadir = mysqli_fetch_array($query_hadir)) {
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $hadir['tarikh']; ?></td>
                    <td><?php echo $hadir['masa']; ?></td>
                </tr>
                <?php $no++;
            } ?>
            <tr>
                <td colspan="3" align="center">
                    <font style="font-size: 10px">
                        * Senarai Tamat *<br/>
                        Bilangan Kehadiran: <?php echo $no - 1; ?>
                    </font>
                </td>
            </tr>
        </table>
        <?php
    } else {
        echo "Tiada rekod kehadiran";
    }
}
?>