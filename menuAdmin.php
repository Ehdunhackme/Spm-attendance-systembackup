<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    #menu {
        margin: 0px; /* Optional: Add some margin around the menu */
        text-align: center; /* Center-align the menu content */
    }

    #menu ul {
        list-style-type: none; /* No list markers */
        margin: 0; /* No margin */
        padding: 0; /* No padding */
    }

    #menu ul li {
        margin: 10px 0; /* Add vertical spacing between items */
    }

    #menu ul li a {
        display: block; /* Block-level element for padding */
        width: 150px; /* Consistent width for all buttons */
        padding: 10px; /* Padding for a better button size */
        text-decoration: none; /* Remove underlines */
        background-color: #3498db; /* Blue background */
        color: white; /* White text color */
        border: 1px solid #2980b9; /* Border color (darker blue) */
        border-radius: 8px; /* Rounded corners */
        text-align: center; /* Center text */
        transition: all 0.3s ease; /* Smooth transition for animations */
    }

    #menu ul li a:hover {
        background-color: #2980b9; /* Darker blue on hover */
        border-color: #1c5987; /* Darker border on hover */
        transform: scale(1.1); /* Slight scaling effect on hover */
        color: #e6f1ff; /* Lighter text color on hover */
    }
    </style>
</head>
<body>
<div id="menu">
    <!--ADMIN PRIVILEGE-->
    <ul>
        <li><a href="aktiviti.php">SENARAI AKTIVITI</a></li>
        <li><a href="senarai_ahli.php">SENARAI MURID</a></li>
        <li><a href="carian.php">CARIAN KEHADIRAN MURID</a></li>
        <li><a href="laporan1.php">LAPORAN KEHADIRAN MURID</a></li>
        <li><a href="laporan2.php">LAPORAN TIDAK HADIR MURID</a></li>
        <li><a href="logout.php">LOG KELUAR</a></li>
    </ul>
</div>
</body>
</html>
