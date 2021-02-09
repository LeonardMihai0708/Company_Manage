<?php

include_once('dbs.php');


if($_POST['select_persoane']!='Alegeți o persoană'){
    $select_persoane = "SELECT * FROM conturi where username = '".$_POST['select_persoane']."';";
    $select_sql = mysqli_query($conn,$select_persoane);
    $nume_prenume = mysqli_fetch_assoc($select_sql);
    $all_from_sql = "insert into plati (nume,prenume,start,stop,suma) VALUES ('".$nume_prenume['nume']."','".$nume_prenume['prenume']."',CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP(),0);";
    mysqli_query($conn,$all_from_sql);

    header('Location: ../angajati.php');
    exit();
} else {
    header('Location: ../angajati.php?status=selectati_o_persoana');
    exit();
}




