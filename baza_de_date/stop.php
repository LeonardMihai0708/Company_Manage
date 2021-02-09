<?php


include_once('dbs.php');


if($_POST['select_persoane']!='Alegeți o persoană'){
    date_default_timezone_set("Europe/Bucharest");
    $persoana = $_POST['select_persoane'];
    $select_persoane = "SELECT * FROM conturi where username = '".$persoana."';";
    $select_sql = mysqli_query($conn,$select_persoane);
    $nume_prenume = mysqli_fetch_assoc($select_sql);
    $nume = $nume_prenume['nume'];
    $prenume = $nume_prenume['prenume'];
    $id = "SELECT MAX(id) FROM plati where nume = '".$nume."' And prenume = '".$prenume."';";
    $id_sql = mysqli_query($conn,$id);
    $id_final = mysqli_fetch_assoc($id_sql);
    $id_max = $id_final['MAX(id)']; 
    $verificare = "SELECT * FROM plati where nume = '".$nume."' And prenume = '".$prenume."' AND id = '".$id_max."';";
    $verificare_sql = mysqli_query($conn,$verificare);
    $verificare_sql_final = mysqli_fetch_assoc($verificare_sql);
    if($verificare_sql_final['start'] == $verificare_sql_final['stop']){
        $all_from_sql = "UPDATE plati SET stop = CURRENT_TIMESTAMP() WHERE nume = '".$nume."' AND prenume = '".$prenume."' AND id = '".$id_max."';";
        mysqli_query($conn,$all_from_sql);
        $select_persoana2 = "SELECT * FROM plati where nume = '".$nume."' And prenume = '".$prenume."' AND id = '".$id_max."';";
        $select_persoana2_sql = mysqli_query($conn,$select_persoana2);
        $select2_sql= mysqli_fetch_assoc($select_persoana2_sql);
        $a = $select2_sql['start'];
        $select_persoane = "SELECT * FROM plati where nume = '".$nume."' And prenume = '".$prenume."' AND id = '".$id_max."';"; 
        $date1 = date("Y-m-d H:i:s",strtotime($a));
        $date2 = date("Y-m-d H:i:s");
        $diff = strtotime($date2) - strtotime($date1);
        $suma = ($diff/3600)*8;
        $sql = "UPDATE plati SET suma = '$suma' WHERE nume = '".$nume."' AND prenume = '".$prenume."' AND id = '".$id_max."';";
        mysqli_query($conn,$sql);
        header('Location: ../angajati.php');
        exit();
    } else{
        header('Location: ../angajati.php?status=stop_refolosit');
        exit();
    }
} else {
    header('Location: ../angajati.php?status=selectati_o_persoana');
    exit();
}