<?php
# Connect to database
require 'database.php';

# Generate idKehadiran
$idKehadiran = '';
$idMurid = $_SESSION['idMurid'] ?? '';

# Receive POST data for attendance
if (isset($_POST['hadir'])) {
    $idMurid = $_POST['idMurid'];
    $kodAktiviti = $_POST['kodAktiviti'];
    $idKehadiran = '1' . $_POST['kodAktiviti'] . $_POST['idMurid'] . $tarikhKini;

    mysqli_query($con, "INSERT INTO kehadiran (idKehadiran, masa, tarikh, idMurid, kodAktiviti) VALUES ('$idKehadiran', '$masaKini', '$tarikhKini', '$idMurid', '$kodAktiviti')")
        or die(mysqli_error($con));

    echo "<script>alert('Rekod kehadiran berjaya disimpan!');</script>";
}

?>

<!-- Start of HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance Page</title>
    <!-- Button Styles -->
    <style>
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
        cursor: pointer; /* Cursor changes to a hand on hover */
    }

    .styled-button:hover {
        background-color: #2980b9; /* Darker blue on hover */
        transform: scale(1.1); /* Slight scaling effect on hover */
        color: #e6f1ff; /* Lighter text color on hover */
    }
    </style>
</head>
<body>

<!-- Display Reminder Notice -->
<div id="sembunyi">
<?php
$query = mysqli_query($con, "SELECT * FROM aktiviti WHERE tarikhAktiviti >= '$tarikhKini'");

if (mysqli_num_rows($query) > 0) {
    $senarai = mysqli_fetch_array($query);

    # Display activity notice
    echo strtoupper(
        "<u>NOTIS PERINGATAN</u><br>" .
        $senarai['keteranganAktiviti'] .
        "<br>TARIKH: " . $senarai['tarikhAktiviti']
    );
    echo "<hr>";

    # Calculate days until event
    $date1 = date_create($tarikhKini);
    $date2 = date_create($senarai['tarikhAktiviti']);
    $diff = date_diff($date1, $date2);
    $totalday = $diff->format("%a");

    # If event is today, check attendance
    if ($totalday == 0) {
        $semak2 = mysqli_query($con, "SELECT * FROM kehadiran WHERE idMurid = '$idMurid' AND tarikh = '$tarikhKini'");

        # If not attended, show "SAYA HADIR" button
        if (mysqli_num_rows($semak2) == 0) {
            ?>
            <!-- Show "SAYA HADIR" Button -->
            <form method="POST">
                <h3>*Klik butang hadir untuk hadir aktiviti ini</h3>
                <input type="hidden" name="idMurid" value="<?php echo $idMurid; ?>">
                <input type="hidden" name="kodAktiviti" value="<?php echo $senarai['kodAktiviti']; ?>">
                <button class="styled-button" name="hadir" type="submit">SAYA HADIR</button> <!-- Styled button -->
                <hr>
            </form>
            <?php
        } else {
            echo "<h3>Anda sudah hadir pada hari ini</h3>";
        }
    } else {
        echo "Tiada aktiviti pada hari ini";
    }
} else {
    echo "Tiada aktiviti buat masa ini";
}
?>
</div>

<!-- Display Log Information -->
<div id="printarea">
    <h2><u>LOG KEHADIRAN</u></h2>
    <table border="1" summary="Log Kehadiran">
        <tr>
            <th>BIL.</th>
            <th>AKTIVITI</th>
            <th>TARIKH</th>
            <th>MASA</th>
        </tr>
        <?php
        $no = 1;
        $data1 = mysqli_query($con, "SELECT * FROM kehadiran AS t1 INNER JOIN aktiviti AS t2 ON t1.kodAktiviti = t2.kodAktiviti WHERE t1.idMurid = '$idMurid' ORDER BY t1.tarikh DESC");
        while ($info1 = mysqli_fetch_array($data1)) {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $info1['namaAktiviti']; ?></td>
                <td><?php echo $info1['tarikh']; ?></td>
                <td><?php echo $info1['masa']; ?></td>
            </tr>
            <?php $no++;
        } ?>
        <tr>
            <td colspan="4">
                <font style="font-size: 15px">
                    * Senarai Tamat *<br/>Jumlah Aktiviti: <?php echo $no - 1; ?>
                </font> <br>
                <button class="styled-button" onclick="javascript:window.print()">CETAK</button> <!-- Styled button -->
            </td>
        </tr>
    </table>
</div>

</body>
</html>
