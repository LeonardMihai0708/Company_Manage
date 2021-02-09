<?php


include_once("dbs.php");

$username = $_POST['username'];
$nume = $_POST['name'];
$prenume = $_POST['prenom'];
$parola = $_POST['parola'];

$verificare = "SELECT * FROM conturi where username = '".$username."'";
$verificare_sql = mysqli_query($conn,$verificare);
$verificare_sql_TAB = mysqli_fetch_assoc($verificare_sql);
print_r($verificare_sql_TAB);
if($verificare_sql_TAB != NULL){
    header("Location: ../angajati.php?status=utilizator_deja_folosit#2");
    exit();
} else{
    if($_POST['select_statut'] == 'Angajat'){
        $stare = 0;
    } else {
        $stare = 1;
    }
    $sql = "INSERT INTO conturi (username,parola,stare,nume,prenume) Values ('".$username."','".$parola."','".$stare."','".$nume."','".$prenume."');";
    mysqli_query($conn,$sql);
    $s = "INSERT INTO concedii (username, zile_concediu_ramase) VALUES ('".$username."', 30);";
    $s_v = mysqli_query($conn,$s);
    header("Location: ../angajati.php?utilizator_adaugat_cu_succes");
    exit();
}
