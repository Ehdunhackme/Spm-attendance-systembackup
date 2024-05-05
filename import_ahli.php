<?php
    # Include the header
    include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
            cursor: pointer; /* Cursor becomes a hand on hover */
        }

        .styled-button:hover {
            background-color: #2980b9; /* Darker blue on hover */
            transform: scale(1.1); /* Slight scaling effect on hover */
            color: #e6f1ff; /* Lighter text color on hover */
        }
    </style>
</head>
<body>
    <!-- Call Menu -->
    <div id="menu">
        <?php include 'menuAdmin.php'; ?>
    </div>

    <!-- Call Content -->
    <div id="isi">
        <h2>IMPORT AHLI</h2>
        <label>Pilih lokasi fail CSV:</label>

        <!-- Import Form -->
        <form action="import_simpan.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" accept=".csv"><br>
            <button class="styled-button" type="submit" name="import">UPLOAD</button> <!-- Apply styled-button -->
        </form>
    </div>
</body>
</html>



