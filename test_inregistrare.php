<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    $dbServerName = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "pfa";

    $conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
    

    date_default_timezone_set("Europe/Bucharest");
    $last_id_select = "SELECT max(id) FROM programari";
    $result_last_id = mysqli_query($conn,$last_id_select);
    $last_id = mysqli_fetch_assoc($result_last_id);
    $all_from_mysqli_select = "SELECT * FROM programari ORDER BY id desc;";
    $result_all_from_mysqli = mysqli_query($conn,$all_from_mysqli_select);
    $all_from_mysqli = mysqli_fetch_assoc($result_all_from_mysqli);
    // print_r($all_from_mysqli['data_programare']);
    $pch = strtok($all_from_mysqli['data_programare'],' -:');
    $nr = 0;
    while($pch!=NULL){
        $nr++;
        $vector[$nr] =  $pch;
        $pch = strtok(' -:');
    }
    print_r($vector);
    if($vector[5]+20>60){
        $vector[5] = 60 - $vector[5];
        $vector[4]++;
    }else{
        $vector[5] = $vector[5] +20;
    }
    echo '<br>';
    $programare_finala = date("$vector[1]-$vector[2]-$vector[3] $vector[4]:$vector[5]:$vector[6]");
    echo $vector[3] ;   
    echo date("d");
    if($vector[3] > date("d")){
        date_default_timezone_set("Europe/Bucharest");
        $all_from_mysqli_select = "SELECT * FROM programari ORDER BY id desc;";
        $result_all_from_mysqli = mysqli_query($conn,$all_from_mysqli_select);
        $all_from_mysqli = mysqli_fetch_assoc($result_all_from_mysqli);
        // print_r($all_from_mysqli['data_programare']);
        if($vector[5]+15>=60){
            $vector[5] = 60 - $vector[5];
            $vector[4]++;
        }else{
            $vector[5] = $vector[5] +15;
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
        $mpdf->Output($nume_document, 'I');
        header("Location: ../formular.php?status=succes");
        exit();
    }

    ?>
</body>
</html>