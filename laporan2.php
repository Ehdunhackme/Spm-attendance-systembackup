<?php
# Include header
include 'header.php';
$jumpa = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Tidak Hadir Aktiviti</title>

    <!-- Button and Table Styles -->
    <style>
    .styled-button {
        background-color: #3498db; /* Blue background */
        border: none; /* No border */
        color: white; /* White text */
        padding: 10px 20px; /* Padding for better button size */
        text-align: center; /* Center the text */
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
    .styled-table {
        width: 100%; /* Full width */
        border-collapse: collapse; /* No double borders */
        font-size: 16px; /* Font size for readability */
    }

    .styled-table th {
        background-color: #3498db; /* Blue background for headers */
        color: white; /* White text for headers */
        padding: 12px; /* Padding for headers */
        text-align: left; /* Align text to the left */
    }

    .styled-table td {
        padding: 10px; /* Padding for table cells */
        border-bottom: 1px solid #ddd; /* Bottom border for rows */
    }

    .styled-table tr:nth-child(even) {
        background-color: #f2f2f2; /* Alternate row color */
    }

    .styled-table tr:hover {
        background-color: #f5f5f5; /* Background color on hover */
    }

    /* Hide elements during printing */
    @media print {
        .no-print {
            display: none; /* Hide all elements with this class during printing */
        }

        .styled-table, .styled-table th, .styled-table td {
            border: 1px solid black; /* Ensure table borders are visible during printing */
        }
    }
    </style>

    <script>
    function printTable() {
        window.print(); /* Print the current window */
    }
    </script>
</head>

<body>

<!-- Call Menu -->
<div id="menu" class="no-print"> <!-- Apply no-print class -->
    <?php include 'menuadmin.php'; ?>
</div>

<!-- Call Content -->
<div id="isi">
<label id="sembunyi">SENARAI AKTIVITI:</label>

    <!-- Search Form -->
    <form method="POST" name="search" class="no-print"> <!-- Apply no-print class -->
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
    if (isset($_POST['aktiviti'])) {
        $jumpa = $_POST['aktiviti'];

        # Display Activity Details
        $keterangan = mysqli_query($con, "SELECT * FROM aktiviti WHERE kodAktiviti = '$jumpa'");
        $detail = mysqli_fetch_array($keterangan);

        # Printable area for the report
        echo "<div id='printarea'>";
        echo "<h2>SENARAI AHLI TIDAK HADIR AKTIVITI " . $detail['keteranganAktiviti'] . "<br>";
        echo "PADA " . $detail['tarikhAktiviti'] . "</h2>";

        # Non-attendees table
        echo "<table class='styled-table'>"; 
        echo "<tr><th>BIL</th><th>NAMA</th><th>JANTINA</th><th>ID MURID</th><th>nomHP</th></tr>";

        $no = 1;
        $data1 = mysqli_query($con, "SELECT * FROM peserta AS t1 INNER JOIN hp AS t3 ON t1.nomHP = t3.nomHP WHERE t1.idMurid NOT IN (SELECT t2.idMurid FROM kehadiran AS t2 WHERE t2.kodAktiviti = '$jumpa') ORDER BY t1.idMurid ASC");

        while ($info = mysqli_fetch_array($data1)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $info['namaMurid'] . "</td>";
            echo "<td>" . $info['jantina'] . "</td>";
            echo "<td>" . $info['idMurid'] . "</td>";
            echo "<td>" . $info['nomHP'] . "</td>";
            echo "</tr>";
            $no++;
        }

        echo "</table>";

        # Total count and print button (to be hidden during printing)
        echo "<font style='font-size: 15px'>* Jumlah Tidak Hadir: " . ($no - 1) . " / ";

        $kira = mysqli_query($con, "SELECT COUNT(*) FROM peserta");
        $detail1 = mysqli_fetch_array($kira);
        echo "/" . $detail1['COUNT(*)'];

        echo "</font><br>";

        echo "<button class='styled-button no-print' onclick='printTable()'>CETAK</button>"; # Hidden during printing
        echo "</div>"; # End of printable area

    } else {
        echo "(N/A) Tiada Rekod"; # If no record is found
    }
    ?>
</div> <!-- End of #isi -->

</body>
</html>
