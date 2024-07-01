<?php
# MULA SESI
session_start();
# SAMBUNG KE PANGKALAN DATA
require 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- PANGGIL CSS EXTERNAL -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- NAMA SISTEM DI TITLE BAR BROWSER -->
    <title><?php echo $namaSistem; ?></title>

    <style>
        .font-selector {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            z-index: 1000;
        }

        .font-selector label {
            margin-right: 5px;
        }

        .font-selector select {
            padding: 5px;
            font-size: 14px;
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const fontSelect = document.getElementById('font-select');
            const body = document.body;
            
            // Apply saved font preference from local storage
            const savedFont = localStorage.getItem('fontFamily');
            if (savedFont) {
                body.style.fontFamily = savedFont;
                fontSelect.value = savedFont;
            }
            
            // Change font when a new font is selected
            fontSelect.addEventListener('change', () => {
                const selectedFont = fontSelect.value;
                body.style.fontFamily = selectedFont;
                localStorage.setItem('fontFamily', selectedFont);
            });
        });
    </script>
</head>
<body>
    <!--- PAPAR MAKLUMAT SISTEM DI BANER -->
    <div class="header">
        <br>
        <h1 style="font-size: 45px;"><?php echo $namasys1; ?></h1>
        <!-- PAAPR UTIKITI BUTANG ZOOM IN OUT WARNA -->
        <?php include('utiliti.php'); ?>
        <!-- Font Selection Box -->
        <div class="font-selector">
            <label for="font-select">Fon Teks: </label>
            <select id="font-select">
                <option value="Arial">Arial</option>
                <option value="Verdana">Verdana</option>
                <option value="Helvetica">Helvetica</option>
                <option value="Times New Roman">Times New Roman</option>
                <option value="Courier New">Courier New</option>
                <option value="Georgia">Georgia</option>
                <option value="Palatino">Palatino</option>
                <option value="Garamond">Garamond</option>
                <option value="Bookman">Bookman</option>
                <option value="Trebuchet MS">Trebuchet MS</option>
            </select>
        </div>
    </div>
</body>
</html>

