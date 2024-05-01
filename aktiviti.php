<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
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
        cursor: pointer; /* Cursor becomes a hand on hover */
        transition: all 0.3s ease; /* Smooth transition for animations */
    }

    .styled-button:hover {
        background-color: #2980b9; /* Darker blue on hover */
        border-color: #1c5987; /* Darker border on hover */
        transform: scale(1.1); /* Slight scaling effect on hover */
        color: #e6f1ff; /* Lighter text color on hover */
    }

    /* Table Styling */
    .styled-table {
        width: 100%; /* Full width */
        border-collapse: collapse; /* No double borders */
        background-color: #f9f9f9; /* Light background */
        font-size: 16px; /* Font size for readability */
        text-align: left; /* Align text to the left */
    }

    .styled-table th {
        background-color: #3498db; /* Blue background for headers */
        color: white; /* White text for headers */
        padding: 12px; /* Padding for headers */
    }

    .styled-table td {
        padding: 10px; /* Padding for table cells */
        border: 1px solid #ccc; /* Light border for cells */
    }

    .styled-table tr:nth-child(even) {
        background-color: #e7e7e7; /* Alternate row color */
    }

    .styled-table tr:hover {
        background-color: #d3d3d3; /* Hover effect for rows */
    }
    </style>
</head>
<body>
<!-- Call Menu -->
<div id="menu">
    <?php include 'menuAdmin.php'; ?>
</div>

<!-- Print Area -->
<div id="printarea">
    <!-- Main Content -->
    <div id="isi">
        <h2><u>SENARAI AKTIVITI</u></h2>

        <!-- Activity Table -->
        <table class="styled-table"> <!-- Apply styled-table class -->
            <tr>
                <th>BIL</th>
                <th>KETERANGAN AKTIVITI</th>
                <th>TARIKH</th>
                <th id="sembunyi">TINDAKAN</th>
            </tr>
            <?php
            $no = 1;
            $data1 = mysqli_query($con, "SELECT * FROM aktiviti ORDER BY tarikhAktiviti DESC");
            while ($info1 = mysqli_fetch_array($data1)) {
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $info1['keteranganAktiviti']; ?></td>
                    <td><?php echo $info1['tarikhAktiviti']; ?></td>
                    <td id="sembunyi">
                        <!-- Display Links -->
                        <a href="aktiviti_edit.php?kodAktiviti=<?php echo $info1['kodAktiviti']; ?>" onclick="return confirm('Edit Rekod?')">EDIT</a> |
                        <a href="aktiviti_hapus.php?kodAktiviti=<?php echo $info1['kodAktiviti']; ?>" onclick="return confirm('Hapus Rekod?')">HAPUS</a>
                    </td>
                </tr>
                <?php $no++; } ?>
            <tr>
                <td colspan="4" align="center">
                    <font style="font-size: 15px">* Senarai Tamat *<br/>Jumlah Aktiviti: <?php echo $no - 1; ?></font>
                    <p>
                        <button class="styled-button" onclick="javascript:window.print()">CETAK</button> <!-- Apply styled-button -->
                        <a href="aktiviti_tambah.php">
                            <button class="styled-button">+ AKTIVITI</button> <!-- Apply styled-button -->
                        </a>
                    </p>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
