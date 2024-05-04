<?php
include_once 'header.php'; // Include your header file

// Ensure database connection is established
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>

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
    </style>
</head>
<body>
<div id="menu">
    <?php include_once 'menuAdmin.php'; ?>
</div>
<br>
<div id="isi">

<!-- Search Form with Fixed 5-Character Length -->
<form method="post">
    <label for="carian">Carian idMurid:</label>
    <input type="text" name="carian" id="carian" pattern="\w{5}" title="ID must be 5 characters long" required>
    <button class="styled-button" type="submit" name="cari">CARI</button>
</form>

<?php
# Check if a search term has been submitted
if (isset($_POST['carian'])) {
    $jumpa = $_POST['carian']; # ID to search for
    
    # Ensure the ID is exactly 5 characters
    if (strlen($jumpa) !== 5) {
        echo "Error: idMurid must be exactly 5 characters long.";
        return;
    }
    
    # Display a test query to ensure data is available
    $test_query = mysqli_query($con, "SELECT * FROM peserta WHERE idMurid = '$jumpa'");
    if (!$test_query) {
        die("Test query failed: " . mysqli_error($con));
    }
    
    if (mysqli_num_rows($test_query) == 0) {
        echo "No record found for idMurid: " . $jumpa;
        return;
    }

    # Original query with error handling
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
        # If records are found, display the report
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
        <!-- Display table -->
        <hr>
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
            }
            ?>
            <tr>
                <td colspan="3" align="center">
                    <font style="font-size: 10px">
                        * End of List *<br>
                        Number of Attendances: <?php echo $no - 1; ?>
                    </font> <br>
                    <button class="styled-button" onclick="window.print()">CETAK</button>
                </td>
            </tr>
        </table>
        <?php
    } else {
        # If no records are found
        echo "Tiada rekod kehadiran"; # "No attendance record"
    }
}
?>
</div> <!-- END #isi -->
</body>
</html>