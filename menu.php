<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    /* Styles for the menu */
    #menu {
        padding: 20px; /* Padding around the menu */
    }

    #menu ul {
        list-style-type: none; /* No list markers */
        margin: 0; /* No margin */
        padding: 0; /* No padding */
        text-align: center; /* Center the menu */
    }

    #menu ul li {
        display: inline-block; /* Display items inline */
        margin: 10px; /* Spacing between items */
    }

    #menu ul li a {
        display: block; /* Block-level element for padding */
        width: 150px; /* Consistent width for all buttons */
        padding: 15px; /* Padding for better button size */
        text-decoration: none; /* No underlines */
        background-color: #3498db; /* Blue background */
        color: white; /* White text color */
        border: 1px solid #2980b9; /* Border color */
        border-radius: 10px; /* Rounded corners */
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
    <!-- ADMIN MENU -->
    <ul>
        <li><a href="logout.php">LOG KELUAR</a></li>
    </ul>
</div>
</body>
</html>