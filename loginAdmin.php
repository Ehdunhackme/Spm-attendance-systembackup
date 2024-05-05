<?php
session_start(); // Start the session

require 'database.php'; // Include database connection

// Check if form data is set
if (isset($_POST['idAdmin'])) {
    $idAdmin = mysqli_real_escape_string($con, $_POST['idAdmin']); // Sanitize input
    $kataLaluanAdmin = mysqli_real_escape_string($con, $_POST['kataLaluanAdmin']); // Sanitize input

    // Query to check if admin exists and password is correct
    $query = mysqli_query($con, "
    SELECT * FROM admin
    WHERE nomKadPEngenalanAdmin='$idAdmin' AND kataLaluanAdmin='$kataLaluanAdmin'");
    
    $row = mysqli_fetch_assoc($query); // Fetch the first row

    if (mysqli_num_rows($query) == 0 || $row['kataLaluanAdmin'] != $kataLaluanAdmin) {
        // If admin ID or password is incorrect
        echo "<script>alert('ID atau kata laluan salah!'); 
        window.location='adminlogin.php'</script>";
    } else {
        // If login is successful
        $_SESSION['idAdmin'] = $row['idAdmin']; // Store admin ID in session
        $_SESSION['namaAdmin'] = $row['namaAdmin']; // Store admin name in session
        $_SESSION['level'] = $row['level']; // Store admin level in session

        // Display success message and redirect to dashboard
        echo "<script>alert('Berjaya Log Masuk Akaun Admin!'); 
        window.location='dashboardAdmin.php'</script>";
    }
}

?>
