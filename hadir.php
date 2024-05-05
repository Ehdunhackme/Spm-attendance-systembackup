<?php
# Connect to the database
require 'database.php';

# Set the timezone to ensure date and time consistency
date_default_timezone_set('Asia/Kuala_Lumpur');  # Example timezone, adjust as needed

# Fetch the current date and time
$tarikhKini = date('Y-m-d');  # Returns current date in 'YYYY-MM-DD' format
$masaKini = date('H:i:s');    # Returns current time in 'HH:MM:SS' format

# Initialize idKehadiran and get the student ID from the session
$idKehadiran = '';
$idMurid = $_SESSION['idMurid'] ?? '';

# Check for the 'hadir' POST request to record attendance
if (isset($_POST['hadir'])) {
    $idMurid = $_POST['idMurid'];
    $kodAktiviti = $_POST['kodAktiviti'];
    
    # Generate a unique idKehadiran based on activity code, student ID, and date
    $idKehadiran = '1' . $kodAktiviti . $idMurid . str_replace('-', '', $tarikhKini);

    # Insert the attendance record into the database
    $query = "INSERT INTO kehadiran (idKehadiran, masa, tarikh, idMurid, kodAktiviti) 
              VALUES ('$idKehadiran', '$masaKini', '$tarikhKini', '$idMurid', '$kodAktiviti')";
    mysqli_query($con, $query) or die(mysqli_error($con));

    echo "<script>alert('Rekod kehadiran berjaya disimpan!');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance Page</title>
    <!-- Button Styles -->
    <style>
    .styled-button {
        background-color: #3498db;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .styled-button:hover {
        background-color: #2980b9;
        transform: scale(1.1);
        color: #e6f1ff;
    }

    /* Hide elements with the no-print class during printing */
    @media print {
        .no-print {
            display: none; /* Hide these elements during printing */
        }
        .styled-table, .styled-table th, .styled-table td {
            border: 1px solid black; /* Consistent table borders during printing */
        }
    }
    </style>

    <script>
    function printContent() {
        window.print(); /* Triggers the print dialog */
    }
    </script>

</head>
<body>

<!-- Reminder Notice -->
<div id="sembunyi" class="no-print"> <!-- Hidden during printing -->
    <?php
    $query = mysqli_query($con, "SELECT * FROM aktiviti WHERE tarikhAktiviti >= '$tarikhKini'");

    if (mysqli_num_rows($query) > 0) {
        $senarai = mysqli_fetch_array($query);

        echo strtoupper(
            "<u>NOTIS PERINGATAN</u><br>" .
            $senarai['keteranganAktiviti'] .
            "<br>TARIKH: " . $senarai['tarikhAktiviti']
        );
        echo "<hr>";

        # Calculate the number of days until the activity
        $date1 = date_create($tarikhKini);
        $date2 = date_create($senarai['tarikhAktiviti']);
        $diff = date_diff($date1, $date2);
        $totalday = $diff->format("%a");

        # If the activity is today, check attendance status
        if ($totalday == 0) {
            $semak2 = mysqli_query($con, "SELECT * FROM kehadiran WHERE idMurid = '$idMurid' AND tarikh = '$tarikhKini'");

            if (mysqli_num_rows($semak2) == 0) {
                ?>
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
            echo "Tiada aktiviti pada hari ini"; /* This line won't be printed */
        }
    } else {
        echo "Tiada aktiviti buat masa ini"; /* This line won't be printed */
    }
    ?>
</div>

<!-- Attendance Log -->
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
                <td><?php echo $info1['keteranganAktiviti']; ?></td>
                <td><?php echo $info1['tarikh']; ?></td>
                <td><?php echo $info1['masa']; ?></td>
            </tr>
            <?php
            $no++;
        }
        ?>
        <tr>
            <td colspan="4">
                <font style="font-size: 15px">
                    * Senarai Tamat *<br/>Jumlah Aktiviti: <?php echo $no - 1; ?>
                </font>
                <br>
                <!-- Print button, hidden during printing -->
                <button class="styled-button no-print" onclick="printContent()">CETAK</button>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
