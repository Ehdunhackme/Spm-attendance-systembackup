<?php
include 'header.php';

# RECEIVE POST DATA
if (isset($_POST['hantar'])) {
    $data1 = $_POST['kodAktiviti'];
    $data2 = $_POST['keteranganAktiviti'];
    $data3 = $_POST['tarikh'];
    $data4 = $_POST['masaAktiviti'];

    # CHECK FOR DATE CONFLICTS
    $semakan = mysqli_query($con, "SELECT * FROM aktiviti WHERE tarikhAktiviti = '$data3'");
    $detail = mysqli_num_rows($semakan);

    if ($detail != 0) {
        echo "<script>alert('RALAT! Pertembungan tarikh. Sila pilih tarikh lain.');
        window.location='aktiviti_tambah.php'</script>";
    } else {
        # INSERT RECORD INTO DATABASE
        mysqli_query($con, "INSERT INTO aktiviti (kodAktiviti, keteranganAktiviti, masaAktiviti, tarikhAktiviti) 
        VALUES ('$data1', '$data2', '$data4', '$data3')") or die(mysqli_error($con));
        echo "<script>alert('Rekod aktiviti berjaya disimpan!'); window.location='aktiviti.php'</script>";
    }
}
?>
<!-- HTML START -->
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    .styled-button {
        background-color: #3498db; /* Blue background */
        border: none; /* No border */
        color: white; /* White text */
        padding: 10px 20px; /* Padding for a better button size */
        text-align: center; /* Center text */
        text-decoration: none; /* No underlines */
        display: inline-block; /* Display inline-block */
        font-size: 16px; /* Font size */
        border-radius: 8px; /* Rounded corners */
        transition: all 0.3s ease; /* Smooth transition for hover effects */
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
    <h2>TAMBAH AKTIVITI</h2>
    <form method="POST">
        <p>KOD AKTIVITI<br>
        <input type="text" name="kodAktiviti" placeholder="TAIP SINI" size="30%" required></p>
        
        <p>KETERANGAN AKTIVITI<br>
        <input type="text" name="keteranganAktiviti" placeholder="TAIP SINI" size="60%" required autofocus></p>
        
        <p>TARIKH AKTIVITI<br>
        <input type="date" name="tarikh" size="30%" required></p>
        
        <p>MASA AKTIVITI<br>
        <input type="time" name="masaAktiviti" size="30%" required></p>
        
        <div>
            <button class="styled-button" name="hantar" type="submit">SIMPAN</button> <!-- Apply styled-button class -->
            <button class="styled-button" type="reset">RESET</button> <!-- Apply styled-button class -->
        </div>
        
        <font color="red">* Sila pastikan maklumat diisi dengan betul sebelum simpan.</font>
    </form>
</div>
</body>
</html>