<?php include_once 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Page Title</title>
    <style>
    .styled-button {
        background-color: #3498db; /* Blue background */
        border: none; /* No border */
        color: white; /* White text */
        padding: 10px 20px; /* Padding for better button size */
        text-align: center; /* Center text */
        text-decoration: none; /* No underlines */
        display: inline-block; /* Display inline-   block */
        font-size: 16px; /* Font size */
        border-radius: 8px; /* Rounded corners */
        cursor: pointer; /* Cursor becomes a hand on hover */
        transition: all 0.3s ease; /* Smooth transition for animations */
    }

    .styled-button:hover {
        background-color: #2980b9; /* Darker blue on hover */
        border-color: #1c5987; /* Darker border on hover */
        transform: scale(1.1); /* Slight scaling effect on hover */
        color: #e6f1ff; /* Lighter text color on hover */
    }
    </style>
</head>
<body>
<!-- CALL MENU -->
<div id="menu">
    <?php include_once 'menuAdmin.php'; ?>
</div>
<br>
<!-- CALL CONTENT -->
<div id="isi">
<!--SEARCH FORM-->
<form method="post">
    <label for="carian">Carian idMurid:</label>
    <input type="text" name="carian" id="carian" size="20%" minLength='5' maxLength='12' required>
    <button class="styled-button" type="submit" name="cari">CARI</button> <!-- Apply styled-button class -->
</form>
<?php
#GET ID FROM URL
if (isset($_POST['carian'])) {
    $jumpa = $_POST['carian'];
    #DISPLAY SEARCH RESULTS
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
            foreach ($query_hadir as $hadir) {
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
                    </font> <br>
                    <button class="styled-button" onclick='javascript:window.print()'>CETAK</button> <!-- Apply styled-button class -->
                </td>
            </tr>
        </table>
        <?php
    } else {
        echo "Tiada rekod kehadiran";
    }
}
?>
</div> <!-- END #isi -->
</div> <!-- END #menu -->
</body>
</html>