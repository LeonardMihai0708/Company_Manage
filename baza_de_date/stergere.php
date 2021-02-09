<?php


include_once("dbs.php");


$username = $_POST['select_persoane'];
$sql = "DELETE FROM conturi WHERE username = '".$username."'";
$s = "DELETE FROM concedii WHERE username = '".$username."'";
mysqli_query($conn,$sql);
mysqli_query($conn,$s);
header("Location: ../angajati.php");
exit();