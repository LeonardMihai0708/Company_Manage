<?php
    include_once("baza_de_date/dbs.php");
    require_once 'vendor/autoload.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rowdies&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="icon" type="image/jpg" href="img/hiclipart.com.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="angajati.css">
    <title>PFA</title>
</head>
<body>

    <script>
    function myFunction() {
        var r = alert("Vă vom deconecta! Conectati-va inapoi pentru a primi inapoi informațiile dorite");
    }
    function myFunction2() {
        var r = alert("Vom șterge un utilizator! Această alegere nu se poate restitui!");
    }
    </script>

    <?php

    if($_SESSION){
        if($_SESSION['stare']==1){
            include_once 'stare_login/stare1.php';
        } 
        else{
            include_once 'stare_login/stare0.php';
        }
    } else{
        include_once 'stare_login/stare_nedefinita.php';
    }
    ?>  
    <center><p class="copyright">&copy; 2020 Mihai Leonard. All rights reserved. &copy;</p></center>

</body>
</html>