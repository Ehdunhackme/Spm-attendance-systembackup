<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Senarai Ahli</title>

    <!-- Button Styles -->
    <style>
    .styled-button {
        background-color: #3498db; /* Blue background */
        border: none; /* No border */
        color: white; /* White text */
        padding: 10px 20px; /* Padding for a larger button */
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
        background-color: #f9f9f9; /* Light background */
    }

    .styled-table th {
        background-color: #3498db; /* Blue background for headers */
        color: white; /* White text for headers */
        padding: 12px; /* Padding for headers */
    }

    .styled-table td {
        padding: 10px; /* Padding for table cells */
        border-bottom: 1px solid #ccc; /* Light border for cells */
    }

    .styled-table tr:nth-child(even) {
        background-color: #e7e7e7; /* Alternate row color */
    }

    .styled-table tr:hover {
        background-color: #d3d3d3; /* Hover effect for rows */
    }

    /* Hide elements during printing */
    @media print {
        .no-print {
            display: none; /* Hide all elements with this class during printing */
        }

        /* Ensure table borders are consistent during printing */
        .styled-table, .styled-table th, .styled-table td {
            border: 1px solid black; /* Define border for printing */
        }
    }
    </style>

    <script>
    function printContent() {
        window.print(); /* Trigger printing */
    }
    </script>
</head>

<body>

<!-- Call Menu -->
<div id="menu" class="no-print"> <!-- Hide menu during printing -->
    <?php include 'menuAdmin.php'; ?>
</div>

<!-- Printable Area -->
<div id="printarea">
    <div id="isi">
        <h2><u>SENARAI AHLI</u></h2>

        <!-- Member List Table -->
        <table class="styled-table"> <!-- Apply styled-table class -->
            <tr>
                <th>BIL</th>
                <th>NAMA</th>
                <th>JANTINA</th>
                <th>ID MURID</th>
                <th>PASSWORD</th>
                <th>NOMBOR HP</th>
                <th class="no-print">TINDAKAN</th> <!-- Hide TINDAKAN column during printing -->
            </tr>
            <?php
            $no = 1;
            $data1 = mysqli_query($con, "SELECT * FROM peserta AS t1 INNER JOIN hp AS t2 ON t1.nomHp = t2.nomHp ORDER BY t2.namaMurid ASC");
            while ($info1 = mysqli_fetch_array($data1)) {
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $info1['namaMurid']; ?></td>
                    <td><?php echo $info1['jantina']; ?></td>
                    <td><?php echo $info1['idMurid']; ?></td>
                    <td><?php echo $info1['kataLaluan']; ?></td>
                    <td><?php echo $info1['nomHP']; ?></td>
                    <td class="no-print"> <!-- Hide during printing -->
                        <a href="hapus_ahli.php?hp=<?php echo $info1['nomHP']; ?>" onclick="return confirm('Hapus Rekod?')">HAPUS</a> <!-- Hapus button -->
                    </td>
                </tr>
                <?php $no++; }
            ?>
            <tr>
                <td colspan="7" align="center" class="no-print"> <!-- Hide during printing -->
                    <font style="font-size: 15px">* Senarai Tamat *<br/>Jumlah Ahli: <?php echo $no - 1; ?></font> <br>
                    <button class="styled-button no-print" onclick="printContent()">CETAK</button> <!-- Hidden during printing -->
                    <a href="import_ahli.php"><button class="styled-button no-print">IMPORT</button></a> <!-- Hidden during printing -->
                </td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
