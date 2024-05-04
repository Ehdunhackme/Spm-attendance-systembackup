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

    /* Styles for printing */
    @media print {
        .no-print {
            display: none; /* Hide all elements with the no-print class */
        }

        /* Ensure proper table borders during printing */
        table, th, td {
            border: 1px solid black;
        }
    }
    </style>

    <script>
    function printTable() {
        window.print();
    }
    </script>
</head>
<body>

<div id="menu" class="no-print"> <!-- Apply no-print class to hide during printing -->
    <?php include 'menuadmin.php'; ?>
</div>

<!-- Call Content -->
<div id="isi">
    <label id="sembunyi">SENARAI AKTIVITI:</label>
    <!-- Search Form -->
    <form method="POST" name="search" id="sembunyi" class="no-print"> <!-- Apply no-print class -->
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
        <button class="styled-button no-print" type="submit" name="cari">PILIH</button> <!-- Apply no-print class -->
    </form>

    <?php
    if (isset($_POST['cari'])) {
        $jumpa = $_POST['aktiviti'];

        # Display Activity Details
        $keterangan = mysqli_query($con, "SELECT * FROM aktiviti WHERE kodAktiviti = '$jumpa'");
        $detail = mysqli_fetch_array($keterangan);

        # Printable area
        echo "<div id='printarea'>";
        echo "<h2>LAPORAN KEHADIRAN AKTIVITI " . $detail['keteranganAktiviti'] . "<br>PADA " . $detail['tarikhAktiviti'] . "</h2>";

        # Display the attendance table
        echo "<table>";
        echo "<tr><th>BIL</th><th>NAMA</th><th>JANTINA</th><th>ID MURID</th><th>TARIKH</th><th>MASA</th></tr>";

        $no = 1;
        $data1 = mysqli_query($con, "SELECT * FROM kehadiran AS t1 INNER JOIN peserta AS t2 ON t1.idMurid = t2.idMurid INNER JOIN hp AS t3 ON t2.nomHP = t3.nomHP WHERE t1.kodAktiviti = '$jumpa' ORDER BY t1.tarikh ASC");

        while ($info = mysqli_fetch_array($data1)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $info['namaMurid'] . "</td>";
            echo "<td>" . $info['jantina'] . "</td>";
            echo "<td>" . $info['idMurid'] . "</td>";
            echo "<td>" . $info['tarikh'] . "</td>";
            echo "<td>" . $info['masa'] . "</td>";
            echo "</tr>";
            $no++;
        }

        echo "</table>";

        # Display total attendance count and print button (hidden when printing)
        echo "<font style='font-size: 15px'>* Jumlah Hadir: " . ($no - 1) . " / ";

        $kira = mysqli_query($con, "SELECT COUNT(*) FROM peserta");
        $detail1 = mysqli_fetch_array($kira);
        echo $detail1['COUNT(*)'];

        echo "</font><br>";

        echo "<button class='styled-button no-print' onclick='printTable()'>CETAK</button>"; # Button hidden during printing
        echo "</div>";
    } else {
        echo "(N/A) Tiada Rekod"; # If no record is found
    }
    ?>
</div>
</body>
</html>