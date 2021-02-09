<?php
include_once("baza_de_date/dbs.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rowdies&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="angajati.css">
    <title>Document</title>
</head>
<body>



    <center>

    <?php
    $sql_cod = 'SELECT * FROM plati AND start between date_sub(now(),INTERVAL 1 WEEK) and now() ORDER BY id DESC LIMIT 100;';
    $sql_rez = mysqli_query($conn,$sql_cod);
    echo '
    <ul>
        <li class="special">Nume</li>
        <li class="special">Prenume</li>
        <li class="special">Start</li>
        <li class="special">Stop</li>
        <li class="special">Suma Finală</li>
    </ul>
    ';
    while($sql = mysqli_fetch_assoc($sql_rez)){
        echo '
            <ul>
                <li>'.$sql['nume'].'</li>
                <li>'.$sql['prenume'].'</li>
                <li>'.$sql['start'].'</li>
                <li>'.$sql['stop'].'</li>
                <li>'.$sql['suma'].'</li>
            </ul>
        ';
    }


    ?>


</body>
</html>