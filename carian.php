<?php
// Include header and ensure the database connection is established
include 'header.php';
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Kehadiran</title>
    
    <!-- Styling for buttons, table, and print rules -->
    <style>
    .styled-button {
        background-color: #3498db; /* Blue background */
        border: none; /* No border */
        color: white; /* White text */
        padding: 10px 20px; /* Padding for larger button size */
        text-align: center; /* Center the text */
        text-decoration: none; /* No underlines */
        display: inline-block; /* Display inline-block */
        font-size: 16px; /* Font size */
        border-radius: 8px; /* Rounded corners */
        cursor: pointer; /* Cursor becomes a hand on hover */
        transition: all 0.3s ease; /* Smooth transition for animations */
    }

    .styled-button:hover {
        background-color: #2980b9; /* Darker blue on hover */
        transform: scale(1.1); /* Slight scaling effect on hover */
        color: #e6f1ff; /* Lighter text color on hover */
    }

    /* Table styling */
    .styled-table {
        width: 100%; /* Full width */
        border-collapse: collapse; /* No double borders */
        font-size: 16px; /* Readable font size */
        text-align: left; /* Left-align text */
    }

    .styled-table th {
        background-color: #3498db; /* Blue background for headers */
        color: white; /* White text for headers */
        padding: 12px; /* Padding for headers */
    }

    .styled-table td {
        padding: 10px; /* Padding for table cells */
        border-bottom: 1px solid #ddd; /* Border at the bottom */
    }

    .styled-table tr:nth-child(even) {
        background-color: #f2f2f2; /* Alternate row background */
    }

    .styled-table tr:hover {
        background-color: #f5f5f5; /* Hover effect */
    }

    /* Hide elements during printing */
    @media print {
        .no-print {
            display: none; /* Hide these elements during printing */
        }

        .styled-table, .styled-table th, .styled-table td {
            border: 1px solid black; /* Ensure consistent table borders during printing */
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

<!-- Hide menu during printing -->
<div id="menu" class="no-print"> 
    <?php include 'menuAdmin.php'; ?>
</div>

<br>

<!-- Main content area -->
<div id="isi">

<!-- Search Form with hidden elements during printing -->
<form method="post" class="no-print"> <!-- No-print to hide during printing -->
    <label for="carian">Carian idMurid:</label>
    <input type="text" name="carian" pattern="\w{5}" required>
    <button class="styled-button" type="submit" name="cari">CARI</button> <!-- Hidden during printing -->
</form>

<?php
if (isset($_POST['carian'])) {
    $jumpa = $_POST['carian']; # ID to search for
    
    if (strlen($jumpa) !== 5) {
        echo "Error: idMurid must be exactly 5 characters long.";
        return;
    }
    
    $query_hadir = mysqli_query($con, "SELECT * FROM kehadiran AS t1
        INNER JOIN peserta AS t2 ON t1.idMurid = t2.idMurid
        INNER JOIN hp AS t3 ON t2.nomHP = t3.nomHP
        INNER JOIN aktiviti AS t4 ON t1.kodAktiviti = t4.kodAktiviti
        WHERE t1.idMurid = '$jumpa'
        ORDER BY t3.namaMurid ASC");

    if (!$query_hadir) {
        die("Query failed: " . mysqli_error($con));
    }
    
    if (mysqli_num_rows($query_hadir) > 0) {
        ?>
        <h2><u>LAPORAN KEHADIRAN</u></h2>
        <?php
        $papar = mysqli_fetch_array($query_hadir);
        echo "AKTIVITI: " . $papar['keteranganAktiviti'] . "<br>";
        echo "NAMA: " . $papar['namaMurid'] . "<br>";
        echo "JANTINA: " . $papar['jantina'] . "<br>";
        echo "ID MURID: " . $papar['idMurid'] . "<br>";
        
        $no = 1;
        ?>
        <!-- Display the table -->
        <hr>
        <table class="styled-table"> <!-- Apply styled-table class -->
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
            }
            ?>
            <tr class="no-print"> <!-- Hide during printing -->
                <td colspan="3" align="center">
                    <font style="font-size: 10px">* End of List *<br>
                    Number of Attendances: <?php echo $no - 1; ?></font> <br>
                    <button class="styled-button" onclick="printContent()">CETAK</button> <!-- Hide during printing -->
                </td>
            </tr>
        </table>
        <?php
    } else {
        echo "Tiada rekod kehadiran"; # If no attendance record found
    }
}
?>
</div> <!-- END #isi -->
</div> <!-- END #printarea -->

</body>
</html>
