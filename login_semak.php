<?php
# Connect to database
require 'database.php';

# Start session
session_start();

# Handle POST request
if (isset($_POST['idMurid'])) {
    # Get POST values and sanitize
    $user = mysqli_real_escape_string($con, $_POST['idMurid']);
    $pass = mysqli_real_escape_string($con, $_POST['kataLaluan']);

    # Execute SQL query
    $query = mysqli_query($con, "
    SELECT * FROM peserta AS t1
    INNER JOIN hp AS t2
    ON t1.nomHP = t2.nomHP
    WHERE t1.idMurid = '$user' AND t1.kataLaluan = '$pass'");

    $row = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) == 0 || $row['kataLaluan'] != $pass) {
        # If login fails, show error message
        echo "<script>alert('ID atau kata laluan salah!'); window.location='index.php';</script>";
    } else {
        # If login succeeds, create session variables
        $_SESSION['idMurid'] = $row['idMurid'];
        $_SESSION['namaMurid'] = $row['namaMurid'];
        $_SESSION['level'] = $row['aras'];

        # Show success pop-up and redirect to dashboard
        echo "<script>alert('Log Masuk Akaun Murid Berjaya!'); window.location='dashboard.php';</script>";
    }
}
