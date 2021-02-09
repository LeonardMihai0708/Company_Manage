<?php

use Mpdf\Mpdf;
require_once '../vendor/autoload.php';
include_once("dbs.php");

if (isset($_POST['submit'])) {
    $nume = $_POST['name'];
    $prenom = $_POST['prenom']; 
    $telefon = $_POST['telefon'];
    $all_from_mysqli_select = "SELECT * FROM programari ORDER BY id desc;";
    $result_all_from_mysqli = mysqli_query($conn,$all_from_mysqli_select);
    $all_from_mysqli = mysqli_fetch_assoc($result_all_from_mysqli);
    $mpdf = new \Mpdf\Mpdf();
    $data = '';
    $data .= '<h2>Programarea a fost făcută!</h2><br><br>';
    $data .= '<p>Numele: <b>' . $nume . '</b></p>';
    $data .= '<p>Prenumele: <b>' . $prenom. '</b></p>';
    $data .= '<p>Număr de telefon: <b>' . $telefon. '</b></p>';
    date_default_timezone_set("Europe/Bucharest");
    $pch = strtok($all_from_mysqli['data_programare'],' -:');
    $nr = 0;
    while($pch!=NULL){
        $nr++;
        $vector[$nr] =  $pch;
        $pch = strtok(' -:');
    }
    if($nume != NULL && $prenom !=null && $telefon!=NULL){
        if(strlen($prenom) < 3 && strlen($nume) < 3){
            header("Location: ../formular.php?status=litere_insuficiente");
            exit();
        } else{
            if($telefon[0]== "0" && $telefon[1]== "7" && strlen($telefon) == 10){
                if(strchr($prenom,'0')!=NULL || strchr($prenom,'1')!=NULL || strchr($prenom,'2')!=NULL || strchr($prenom,'3')!=NULL || strchr($prenom,'4')!=NULL || strchr($prenom,'5')!=NULL || strchr($prenom,'6')!=NULL || strchr($prenom,'7')!=NULL || strchr($prenom,'8')!=NULL || strchr($prenom,'9')!=NULL){
                    header("Location: ../formular.php?status=prenume_incorect");
                    exit();
                } else if(strchr($nume,'0')!=NULL || strchr($nume,'1')!=NULL || strchr($nume,'2')!=NULL || strchr($nume,'3')!=NULL || strchr($nume,'4')!=NULL || strchr($nume,'5')!=NULL || strchr($nume,'6')!=NULL || strchr($nume,'7')!=NULL || strchr($nume,'8')!=NULL ||  strchr($nume,'_!@#$%^&*()/\{}:"<>?')!=NULL){
                    header("Location: ../formular.php?status=nume_incorect");
                    exit();
                } else if(date("D") == 1 || date("H")>20 || date("H")<6){
                    header("Location: ../formular.php?status=ora_nepotrivita");
                    exit();
                } else if($vector[3] == date("d")){
                    date_default_timezone_set("Europe/Bucharest");
                    $all_from_mysqli_select = "SELECT * FROM programari ORDER BY id desc;";
                    $result_all_from_mysqli = mysqli_query($conn,$all_from_mysqli_select);
                    $all_from_mysqli = mysqli_fetch_assoc($result_all_from_mysqli);
                    // print_r($all_from_mysqli['data_programare']);
                    if($vector[5] +15 >= 60){
                        $vector[5] = 60 - $vector[5];
                        $vector[4]++;
                    }else{
                        $vector[5] = $vector[5] + 15;
                    }
                    $programare_finala = date("$vector[1]-$vector[2]-$vector[3] $vector[4]:$vector[5]:$vector[6]");
                    $sql = "insert into programari (nume,prenume,telefon,data_accesare,data_programare) VALUES ('$nume', '$prenom', '$telefon', CURRENT_TIMESTAMP(), '$programare_finala');";
                    mysqli_query($conn,$sql);
                    $data .= '<p>Trebuie să fiți prezent astăzi la ora: <b>'. $programare_finala . '</b></p>';
                    $mpdf->WriteHTML($data);
                    $nume_document= 'programare'.date("H.i").'.pdf';
                    $mpdf->Output($nume_document, 'I');
                    header("Location: ../formular.php?status=succes");
                    exit(); 
                } else{
                    $programare_finala = date("Y-m-d H:i:s", strtotime("+15 minutes"));
                    $sql = "insert into programari (nume,prenume,telefon,data_accesare,data_programare) VALUES ('$nume', '$prenom', '$telefon', CURRENT_TIMESTAMP(), '$programare_finala');";
                    mysqli_query($conn,$sql);
                    $data .= '<p>Trebuie să fiți prezent astăzi la ora: <b>'. $programare_finala . '</b></p>';
                    $mpdf->WriteHTML($data);
                    $nume_document= 'programare'.date("H.i").'.pdf';
                    $mpdf->Output($nume_document, 'D');
                    header("Location: ../formular.php?status=succes");
                    exit();
                }
            }else {
                header("Location: ../formular.php?status=numar_incorect");
                exit();
            }
        }
        } else {
            header("Location: ../formular.php?status=failed");
            exit();
            }
}

