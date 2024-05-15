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

        .print-button {
            display: none; /* Hide CETAK button during printing */
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
    
    $query_peserta = mysqli_query($con, "SELECT * FROM peserta WHERE idMurid = '$jumpa'");

    if (!$query_peserta) {
        die("Query failed: " . mysqli_error($con));
    }

    if (mysqli_num_rows($query_peserta) > 0) {
        $papar = mysqli_fetch_array($query_peserta);
        ?>
        <h2><u>MAKLUMAT PESERTA</u></h2>
        <table class="styled-table">
            <tr>
                <th>ID MURID</th>
                <th>JANTINA</th>
                <th>NOMBOR HP</th>
                <th>KATA LALUAN</th>
            </tr>
            <tr>
                <td><?php echo $papar['idMurid']; ?></td>
                <td><?php echo $papar['jantina']; ?></td>
                <td><?php echo $papar['nomHP']; ?></td>
                <td><?php echo $papar['kataLaluan']; ?></td>
            </tr>
        </table>
        <br>
        <button class="styled-button print-button" onclick="printContent()">CETAK</button> <!-- Allow printing -->
        <?php
    } else {
        echo "Tiada rekod peserta dengan idMurid tersebut.";
    }
}
?>
</div> <!-- END #isi -->

</body>
</html>
