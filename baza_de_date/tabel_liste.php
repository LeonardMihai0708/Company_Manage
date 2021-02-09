<?php

if(isset($_GET['nr_plati'])){
    $sql_cod = "SELECT * FROM conturi WHERE username = '".$username."'";
    $sql_rez = mysqli_query($conn,$sql_cod);
    $sql =mysqli_fetch_assoc($sql_rez);
    $nume = $sql['nume'];
    $prenume = $sql['prenume'];
    $sql_cod2 = "SELECT * FROM plati WHERE name = '".$name."' AND prenume = '".$prenume."'";
    $sql_rez2 = mysqli_query($conn,$sql_cod2);
    while($sql2 = mysqli_fetch_assoc($sql_rez2)){
        echo '
        <ul>
            <li>'.$sql2['nume'].'</li>
            <li>'.$sql2['prenume'].'</li>
            <li>'.$sql2['start'].'</li>
            <li>'.$sql2['stop'].'</li>
            <li>'.$sql2['suma'].'</li>
        </ul>
        ';
        }
} else{
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
}