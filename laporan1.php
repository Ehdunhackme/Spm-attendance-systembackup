<?php
# Include header
include 'header.php';
$jumpa = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    /* Button Styles */
    .styled-button {
        background-color: #3498db; /* Blue background */
        border: none; /* No border */
        color: white; /* White text */
        padding: 10px 20px; /* Padding for better button size */
        text-align: center; /* Center text */
        text-decoration: none; /* No underlines */
        display: inline-block; /* Display inline-block */
        font-size: 16px; /* Font size */
        border-radius: 8px; /* Rounded corners */
        transition: all 0.3s ease; /* Smooth transition for animations */
        cursor: pointer; /* Cursor becomes a hand on hover */
    }

    .styled-button:hover {
        background-color: #2980b9; /* Darker blue on hover */
        transform: scale(1.1); /* Slight scaling effect on hover */
        color: #e6f1ff; /* Lighter text color on hover */
    }

    /* Table Styles */
    table {
        width: 100%;
        border-collapse: collapse; /* Collapse border spacing */
    }

    th, td {
        padding: 8px; /* Padding inside table cells */
        text-align: left; /* Align text to the left */
        border-bottom: 1px solid #ddd; /* Bottom border for each row */
    }

    th {
        background-color: #3498db; /* Blue background for table headers */
        color: white; /* White text for table headers */
    }

    tr:nth-child(even) {
        background-color: #f2f2f2; /* Alternate row background color */
    }

    tr:hover {
        background-color: #f5f5f5; /* Darker background on hover */
    }
    </style>
</head>
<body>
<!-- Call Menu -->
<div id="menu">
    <?php include 'menuadmin.php'; ?>
</div>

<!-- Call Content -->
<div id="isi">
    <label id="sembunyi">SENARAI AKTIVITI:</label>
    <!-- Search Form -->
    <form method="POST" name="search" id="sembunyi">
        <select name="aktiviti">
            <?php
            $senaraiAktiviti = mysqli_query($con, "SELECT * FROM aktiviti ORDER BY tarikhAktiviti DESC");
            echo "<option>--PILIH--</option>";
            while ($keteranganAktiviti = mysqli_fetch_array($senaraiAktiviti)) {
                echo "<option value='{$keteranganAktiviti['kodAktiviti']}'>
                    {$keteranganAktiviti['keteranganAktiviti']}</option>";
            }
            ?>
        </select>
        <button class="styled-button" type="submit" name="cari">PILIH</button> <!-- Apply styled-button class -->
    </form>

    <?php
    if (isset($_POST['cari'])) {
        $jumpa = $_POST['aktiviti'];

        # Display Activity Details
        $keterangan = mysqli_query($con, "SELECT * FROM aktiviti WHERE kodAktiviti='$jumpa'");
        $detail = mysqli_fetch_array($keterangan);
        ?>
        <div id='printarea'>
            <h2>LAPORAN KEHADIRAN AKTIVITI <?php echo $detail['keteranganAktiviti']; ?><br>
            PADA <?php echo $detail['tarikhAktiviti']; ?></h2>

            <!-- Display Attendance Table -->
            <table>
                <tr>
                    <th>BIL</th>
                    <th>NAMA</th>
                    <th>JANTINA</th>
                    <th>ID MURID</th>
                    <th>TARIKH</th>
                    <th>MASA</th>
                </tr>
                <?php
                $no = 1;
                $data1 = mysqli_query($con, "SELECT * FROM kehadiran AS t1 INNER JOIN peserta AS t2 ON t1.idMurid = t2.idMurid INNER JOIN hp AS t3 ON t2.nomHP = t3.nomHP WHERE t1.kodAktiviti = '$jumpa' ORDER BY t1.tarikh ASC");
                while ($info = mysqli_fetch_array($data1)) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $info['namaMurid']; ?></td>
                        <td><?php echo $info['jantina']; ?></td>
                        <td><?php echo $info['idMurid']; ?></td>
                        <td><?php echo $info['tarikh']; ?></td>
                        <td><?php echo $info['masa']; ?></td>
                    </tr>
                    <?php $no++; } ?>
                </table>

                <font style='font-size: 15px'>
                    * Jumlah Hadir: <?php echo $no - 1; ?> /
                    <?php
                    $kira = mysqli_query($con, "SELECT COUNT(*) FROM peserta");
                    $detail1 = mysqli_fetch_array($kira);
                    echo $detail1['COUNT(*)'];
                    ?>
                </font><br>
                <button class="styled-button" onclick='javascript:window.print()'>CETAK</button> <!-- Apply styled-button -->
            </div>
        <?php
    } else {
        echo "(N/A) Tiada Rekod";   
    }
    ?>
</div>
</body>
</html>
