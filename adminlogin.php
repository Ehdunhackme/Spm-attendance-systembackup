<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Adding CSS for button styling -->
    <style>
    .styled-button {
        background-color: #3498db; /* Blue background */
        border: none; /* No border */
        color: white; /* White text */
        padding: 10px 20px; /* Padding for a better button size */
        text-align: center; /* Center text */
        text-decoration: none; /* No underline */
        display: inline-block; /* Display inline-block */
        font-size: 16px; /* Font size */
        margin: 10px 5px; /* Margin between buttons */
        border-radius: 8px; /* Rounded corners */
        cursor: pointer; /* Cursor becomes a hand on hover */
        transition: 0.3s; /* Smooth transition for hover effects */
    }

    .styled-button:hover {
        background-color: #2980b9; /* Darker blue on hover */
    }
    </style>
</head>
<body>
<!-- PAPAR DI RUANG MENU -->
<div id="menu">
    <h3>LOG MASUK</h3>

    <form method="post" action="loginAdmin.php">
        ID Admin:<br>
        <input type="text" name="idAdmin" placeholder="TAIP SINI" size="12%" minlength="5" maxlength="5"><br>
        Kata Laluan:<br>
        <input type="password" name="kataLaluanAdmin" placeholder="********" size="12%" minlength="6" maxlength="6" required /><br><br>
        <button class="styled-button" name="hantar" type="submit">LOG MASUK</button> <!-- Updated button with styles -->
    </form>
    <br>
</div>
</body>
</html>