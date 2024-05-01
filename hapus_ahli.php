<?php
require 'database.php';
$HpDelete = $_GET['hp'];

// Delete related records from the peserta table
mysqli_query($con, "DELETE FROM peserta WHERE nomHP='$HpDelete'");

// Delete the record from the hp table
mysqli_query($con, "DELETE FROM hp WHERE nomHP='$HpDelete'");

echo "<script>alert('Rekod berjaya dihapuskan!');
window.location='senarai_ahli.php'</script>";
?>
