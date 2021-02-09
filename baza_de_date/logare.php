<?php
session_start();
include_once("dbs.php");



if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $parola = $_POST['password'];
    $codul = "Select * from conturi where username='$name' and parola='$parola'";
    $rezultat = mysqli_query($conn,$codul);
    $rezultat_final = mysqli_fetch_assoc($rezultat);
    if($rezultat_final != NULL){
        $_SESSION['username']=$name;
        $_SESSION['stare'] = $rezultat_final['stare'];
        header("Location: ../angajati.php");
        exit();
    } else{
        header("Location: ../angajati.php?stare=date_incorecte");
        exit();
    }
}


