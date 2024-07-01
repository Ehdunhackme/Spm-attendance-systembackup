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
        padding: 10px 20px; /* Padding for better button size */
        text-align: center; /* Center text */
        text-decoration: none; /* No underlines */
        display: inline-block; /* Display inline-block */
        font-size: 16px; /* Font size */
        border-radius: 8px; /* Rounded corners */
        cursor: pointer; /* Cursor becomes a hand on hover */
        transition: all 0.3s ease; /* Smooth transition for hover effects */
    }

    .styled-button:hover {
        background-color: #2980b9; /* Darker blue on hover */
        border-color: #1c5987; /* Darker border on hover */
        transform: scale(1.1); /* Slight scaling effect on hover */
        color: #e6f1ff; /* Lighter text color on hover */
    }
    
    .error-message {
        font-size: 10px; 
        color: red;
        margin-top: 5px;
    }
    </style>

    <!-- Adding JavaScript for form validation -->
    <script>
    function validateID() {
        var idMurid = document.forms["registrationForm"]["idMurid"].value;
        var idMuridError = "";

        if (idMurid == "") {
            idMuridError = "ID murid diperlukan";
        } else if (idMurid.length > 10) {
            idMuridError = "ID murid mesti tidak melebihi 10 aksara";
        } else if (!/^[a-zA-Z0-9]+$/.test(idMurid)) {
            idMuridError = "ID murid hanya boleh guna aksara a-z dan 0-9";
        }

        document.getElementById("idMuridError").innerHTML = idMuridError;
    }

    function validateForm() {
        var idMuridError = document.getElementById("idMuridError").innerHTML;
        if (idMuridError) {
            return false;
        }
        return true;
    }
    </script>
</head>
<body>
<div id="isi">
<h2>PENDAFTARAN MURID BARU</h2>

<!-- Registration Form -->
<form name="registrationForm" method="post" action="signup_simpan.php" onsubmit="return validateForm()">
    <font color="red">*Pastikan maklumat anda betul sebelum membuat pendaftaran.</font>
    <p>ID murid<br>
    <input type="text" name="idMurid" placeholder="TAIP SINI" minlength="5" maxlength="30" size="30" oninput="validateID()" required>
    <br>
    <span id="idMuridError" class="error-message">*5 digit sahaja</span></p>
    <p>Nama<br>
    <input type="text" name="namaMurid" placeholder="NAMA ANDA" size="60" required></p>
    <p>Jantina<br>
    <select name="jantina">
    <option value="">--PILIH--</option>
    <option value="L">LELAKI</option>
    <option value="P">PEREMPUAN</option>
    </select></p>
    <p>Nom HP<br>
    <input type="text" name="nomHP" placeholder="Tanpa (-)" minlength="10" maxlength="14" size="30" required>
    <br><br>
    <p>Kata laluan<br>
    <input type="password" name="kataLaluan" placeholder="********" size="30" minlength="6" maxlength="6" required></p>
    <div>
    <button class="styled-button" name="hantar" type="submit">DAFTAR</button> <!-- Apply styled-button class -->
    </div>
</form>
</div>
</body>
</html>
