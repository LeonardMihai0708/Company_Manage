<?php
        include_once("dbs.php");
        session_start();


        echo '
                <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                <div class="container">
                <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                <center>
                        <form method="GET">
                        <select name="select_persoane" class="select_persoane">
                                <option>Alegeți o persoană</option>
                ';
        $all_from_mysqli_select = "SELECT * FROM conturi where stare = 0";
        $result_all_from_mysqli = mysqli_query($conn,$all_from_mysqli_select);
        while($utilizatori = mysqli_fetch_assoc($result_all_from_mysqli)){
                echo '
                <option>'.$utilizatori['username'].'</option>
                ';
        }
        echo '
                        </select>
                        <button type="submit" name="submit"> Start Program </button>
                </form>
                </center>
                <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
        ';
        $select_persoane = $_GET['select_persoane']; 
        $sql_cod4 = "SELECT * FROM zile_concedii WHERE username = '".$select_persoane."';";
        $all_from_mysqli_select = "SELECT * FROM conturi where username = '".$select_persoane."'";
        $result_all_from_mysqli = mysqli_query($conn,$all_from_mysqli_select);
        $result_all_REZ = mysqli_fetch_assoc($result_all_from_mysqli);
        $sql_rez4 = mysqli_query($conn,$sql_cod4);
        while($sql4 = mysqli_fetch_assoc($sql_rez4)){
            echo '
                <ul>
                    <li>'.$result_all_REZ['nume'].'</li>
                    <li>'.$result_all_REZ['prenume'].'</li>
                    <li>'.date("d-m-Y",strtotime($sql4['start'])).'</li>
                    <li>'.date("d-m-Y",strtotime($sql4['stop'])).'</li>
                </ul>
            ';
            }