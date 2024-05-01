<?php
require 'database.php';
$akDelete = $_GET['kodAktiviti'];

// Delete related records from the peserta table
mysqli_query($con, "DELETE FROM aktiviti WHERE kodAktiviti='$akDelete'");

echo "<script>alert('Rekod berjaya dihapuskan!');
window.location='aktiviti.php'</script>";
?>
