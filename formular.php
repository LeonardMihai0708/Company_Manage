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
    <link rel="stylesheet" href="formular.css">
    <title>PFA</title>
</head>
<body>

    <a href="index.html"><i class="fas fa-undo"><p>Înapoi</p></i></a>


    <center>
        <div class="container">
            <p>Completează formularul de mai jos pentru a te programa!</p><br>
            <center>
                <?php
                    date_default_timezone_set("Europe/Bucharest");
                    if(date("D") == 1 || date("H")>20 || date("H")<6){
                        echo '<form action="baza_de_date/inregistrare.php" method="POST">';
                    } else{
                        echo '<form action="baza_de_date/inregistrare.php" method="POST" target="_blank">';
                    }
                ?>
                <input type="text" placeholder="Numele" name="name" required><br><br>
                <input type="text" placeholder="Prenume" name="prenom" required><br><br>
                <input type="tel" id="telefon" name="telefon" placeholder="Numar Telefon" required><br><br>
                <button type="submit" name="submit">Programează-te</button>
            </form>
            </center>
        </div>
        <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
        <?php
        if(!isset($_GET['status'])){
            exit();
        } else {
            $statusCheck = $_GET['status'];
            if($statusCheck == "failed"){
                echo "<center><p class='eroare'><b> Nu ai completat casutele </b></p></center>";
                exit();
            } else if($statusCheck == "litere_insuficiente"){
                echo "<center><p class='eroare'><b> Nu sunt destule litere (minim 3 litere)! </b></p></center>";
                exit();
            } else if($statusCheck == "numar_incorect"){
                echo "<center><p class='eroare'><b> Numarul de telefon nu este corect! </b></p></center>";
                exit();
            } else if($statusCheck =="nume_incorect"){
                echo "<center><p class='eroare'><b> Numele nu este corect! </b></p></center>";
                exit();
            } else if($statusCheck =="prenume_incorect"){
                echo "<center><p class='eroare'><b> Prenumele nu este corect! </b></p></center>";
                exit();
            } else if($statusCheck == "ora_nepotrivita"){
                echo "<center><p class='eroare'><b> Vă rugăm sa reveniți mâine dupa ora 7! </b></p></center>";
                exit();
            } else if($statusCheck == "succes") {
                date_default_timezone_set("Europe/Bucharest");
                echo "<center><p class='eroare'><b>Programarea a fost facuta!</b></p></center>";
                exit();
            }
        }
        ?>

    </center>
    
</body>
</html>