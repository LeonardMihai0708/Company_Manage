<?php

include_once("dbs.php");
session_start();
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$date1 = date("Y-m-d",strtotime($startDate));
$date2 = date("Y-m-d",strtotime($endDate));
$diff = strtotime($date2) - strtotime($date1);


$concedii = "SELECT zile_concediu_ramase FROM concedii WHERE username = '".$_SESSION['username']."';";
$concedii_sql = mysqli_query($conn,$concedii);
$concedii_sql_rez = mysqli_fetch_assoc($concedii_sql);
$zile_ramase = $concedii_sql_rez['zile_concediu_ramase'];


$id = "SELECT MAX(id) FROM zile_concedii where username = '".$_SESSION['username']."';";
$id_sql = mysqli_query($conn,$id);
$id_final = mysqli_fetch_assoc($id_sql);
$id_max = $id_final['MAX(id)']; 
$last_con = "SELECT stop from zile_concedii WHERE username = '".$_SESSION['username']."' AND id = ".$id_max.";";
$last_con_SQL = mysqli_query($conn,$last_con);
$last_con_REZ = mysqli_fetch_assoc($last_con_SQL);
$last_stop_concedii = $last_con_REZ['stop'];
$date3 = date("Y-m-d",strtotime($last_stop_concedii));
$date4 = date("Y-m-d",strtotime($startDate));

if(isset($_POST['submit'])){
    $s = strtotime($date4) - strtotime($date3);
    if( $s < 0 ){
        header('Location: ../angajati.php?status_concedii=aceasta_data_este_folosita#concediu');
        exit();
    } else{
        if($zile_ramase == 0){
            header('Location: ../angajati.php?status_concedii=nu_exista_alte_zile#concediu');
            exit();
        } else {
            if($startDate !=NULL && $endDate !=NULL && $zile_ramase > 0){
                if($date1 <= $date2){
                    $diff = (strtotime($date2) - strtotime($date1))/86400;
                    if($diff <= 30){
                        if($diff >= 7){
                            $week = intval($diff / 7);
                            $zile = $diff - (2*$week) + 1;
                        } else {
                            $zile = $diff + 1;
                        }
                        $username = $_SESSION['username'];
                        $sql1 = "INSERT INTO zile_concedii (username, start, stop) Values ('".$_SESSION['username']."','".$date1." 00:00:00','".$date2." 00:00:00');";
                        $zile_final = $zile_ramase - $zile;
                        if($zile_final >= 0 ){
                            $sql2 = "UPDATE concedii SET zile_concediu_ramase = $zile_final WHERE username = '".$_SESSION['username']."';";
                            mysqli_query($conn,$sql1);
                            mysqli_query($conn,$sql2);
                            header('Location: ../angajati.php?status_concedii=concediu_succes#concediu');   
                            exit();
                        } else{
                            header('Location: ../angajati.php?status_concedii=zile_insuficiente#concediu');   
                            exit();
                        }
                    } else{
                        header('Location: ../angajati.php?status_concedii=numar_zile_mare#concediu');
                        exit();
                    }
                } else {
                    header('Location: ../angajati.php?status_concedii=zile_incorecte#concediu');
                    exit();
                }
            } else{
                header('Location: ../angajati.php?status_concedii=interval_nespecificat#concediu');
                exit();
            }
        }
    }
}