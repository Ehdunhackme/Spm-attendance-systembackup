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
        display: inline-block; /* Make it inline-block for styling */
        font-size: 16px; /* Font size */
        margin: 10px 5px; /* Margin between buttons */
        border-radius: 8px; /* Rounded corners */
        cursor: pointer; /* Cursor becomes a hand on hover */
        transition: 0.3s; /* Smooth transition for hover effects */
    }

    .styled-button:hover {
        background-color: #2980b9; /* Darker blue on hover */
    }

    #no-activities-message {
        text-align: center;
        font-size: 20px; /* Larger font size */
        margin-top: 20px; /* Adding some space from the content above */
    }
    
    </style>
</head>
<body>
<!-- PAPAR DI RUANG MENU -->
<div id="menu">
    <h3>Log Masuk Akaun Murid</h3>

    <form method="post" action="login_semak.php">
        ID Murid:<br>
        <input type="text" name="idMurid" placeholder="ID Murid" size="12%" minlength="5" maxlength="5"><br>
        <br> Kata Laluan:<br>
        <input type="password" name="kataLaluan" placeholder="********" size="12%" minlength="6" maxlength="6" required /><br><br>
        <button class="styled-button" name="hantar" type="submit">Log Masuk</button> <!-- Button with new styles -->
    </form>
    <h3>Belum mempunyai akaun? Daftar di sini!</h3>
    <a href="signup.php"><button class="styled-button">Membina Akaun Baharu</button></a> <!-- Button with new styles -->
    <h3>Adakah anda admin? Log masuk di sini!</h3>
    <a href="adminlogin.php"><button class="styled-button">Log Masuk Akaun Admin</button></a> <!-- Button with new styles -->
</div>

<!-- PAPAR DI RUANG ISI -->
<div id="isi">
    <h1 style="text-align: center;"><?php echo ("Senarai Aktiviti"); ?></h1>
    <hr>

    <?php
    $no = 1;
    $data1 = mysqli_query($con, "SELECT * FROM aktiviti WHERE tarikhAktiviti >= '$tarikhKini' ORDER BY tarikhAktiviti ASC");
    if (mysqli_num_rows($data1) > 0) {
        ?>
        <h2>JADUAL AKTIVITI DARI TARIKH <?php echo $tarikhKini; ?></h2>
        <table border="1">

        <!-- PAPAR MAKLUMAT AKTIVITI -->
        <tr>
            <th>BIL</th>
            <th>KETERANGAN AKTIVITI</th>
            <th>TARIKH</th>
        </tr>

        <?php
        while ($info1 = mysqli_fetch_array($data1)) {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $info1['keteranganAktiviti']; ?></td>
                <td><?php echo $info1['tarikhAktiviti']; ?></td>
            </tr>
            <?php
            $no++;
        }
        ?>
        </table>
        <?php 
    } else { 
        echo "<div id='no-activities-message'>Tiada Rekod Baharu</div>";
    }
    ?>
</div>
</body>
</html>
