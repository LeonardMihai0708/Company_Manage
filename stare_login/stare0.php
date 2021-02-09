<?php

echo '
            <header>
                <a href="index.html">Înapoi la pagina principala</a>
                <div class="logare">
                    <form action="baza_de_date/delogare.php" method="POST">
                        <button type="submit" name="submit" onclick="myFunction()">Delogare</button>
                    </form>
                </div>
            </header>
            ';
            echo '
            <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
            <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
            <div class="container">
            
                <h1>Bine ai revenit, '.$_SESSION['username'].'!</h1>
                <p>Mai jos aveți tabelul cu toate plățile efectuate de până acum!</p>
            </div>
            <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
    
            ';
            echo '<center>';
            echo '
            <form method="GET">
                <select name="date_select" class="select_persoane">
                    <option>Fără filtre</option>
                    <option>Ultima Zi</option>
                    <option>Ultima Săptămână</option>
                    <option>Ultima Lună</option>
                    <option>Ultimul an</option>
                </select>
                <button type="submit" name="submit"> Filtreză Tabelul </button><br><br>
            </form>
            ';
            echo '
                <ul>
                    <li class="special">Nume</li>
                    <li class="special">Prenume</li>
                    <li class="special">Start</li>
                    <li class="special">Stop</li>
                    <li class="special">Suma Finală</li>
                </ul>
            ';

                $username = $_SESSION['username'];
                $sql_cod = "SELECT * FROM conturi WHERE username = '".$username."'";
                $sql_rez = mysqli_query($conn,$sql_cod);
                $sql =mysqli_fetch_assoc($sql_rez);
                $nume = $sql['nume'];
                $prenume = $sql['prenume'];

            if(isset($_GET['date_select'])){
                if($_GET['date_select'] == 'Fără filtre'){
                    $sql_cod2 = "SELECT * FROM plati WHERE nume = '".$nume."' AND prenume = '".$prenume."' AND start >= current_date - 30 ORDER BY id DESC LIMIT 100;";
                } else if($_GET['date_select']== 'Ultima Zi'){
                    $sql_cod2 = "SELECT * FROM plati WHERE nume = '".$nume."' AND prenume = '".$prenume."' AND start >= current_date - 1 ORDER BY id DESC LIMIT 100;";
                } else if($_GET['date_select']== 'Ultima Săptămână'){
                    $sql_cod2 = "SELECT * FROM plati WHERE nume = '".$nume."' AND prenume = '".$prenume."' AND start >= current_date - 7 ORDER BY id DESC LIMIT 100;";
                } else if($_GET['date_select']== 'Ultima Lună'){
                    $sql_cod2 = "SELECT * FROM plati WHERE nume = '".$nume."' AND prenume = '".$prenume."' AND start >= current_date - 30 ORDER BY id DESC LIMIT 100;";
                } else if($_GET['date_select']== 'Ultimul an'){
                    $sql_cod2 = "SELECT * FROM plati WHERE nume = '".$nume."' AND prenume = '".$prenume."' AND start >= current_date - 365 ORDER BY id DESC LIMIT 100;";
                }
            } else {
                $sql_cod2 = "SELECT * FROM plati WHERE nume = '".$nume."' AND prenume = '".$prenume."' AND start >= current_date - 30 ORDER BY id DESC LIMIT 100;";
            }
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
            echo '</center>
            <div id="concediu">&nbsp;</div><div class="clearfix">&nbsp;</div>
            ';
            $date_concedii = date("Y-m-d");
            $zile_concediu = "SELECT zile_concediu_ramase FROM concedii WHERE username = '".$username."';";
            $zile_concediu_SQL = mysqli_query($conn,$zile_concediu);
            $zile_concediu_REZ = mysqli_fetch_assoc($zile_concediu_SQL);
            $zcr = $zile_concediu_REZ['zile_concediu_ramase'];
            echo '
            <div class="container">
                <center>
                    <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                    <p>Zile de concedii rămase: '.$zcr.'</p>
                    <p>Programează-ți un concediu mai jos!</p>
                    <form action="baza_de_date/concediu.php" method="POST">
                        <input type="date" name="startDate" min="'.$date_concedii.'"/>
                        <input type="date" name="endDate" min="'.$date_concedii.'"/><br><br>
                        <button type="submit" name="submit">Programează-te!</button>
                    </form>
                <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
            ';
            if(isset($_GET['status_concedii'])){
                $statusCheck = $_GET['status_concedii'];
                if($statusCheck == "numar_zile_mare"){
                    echo "<p>Vă rugăm să alegeți un număr mai mic de zile!</p>";
                } else if($statusCheck == "concediu_succes"){
                    echo "<p>Concediul a fost programat cu succes!</p>";
                } else if($statusCheck == "zile_incorecte"){
                    echo "<p>Vă rugăm să alegeți zilele corect!</p>";
                } else if($statusCheck == "interval_nespecificat"){
                    echo "<p>Vă rugăm să alegeți un interval de zile!</p>";
                } else if($statusCheck == "zile_insuficiente"){
                    echo "<p>Vă rugăm să alegeți un interval de zile mai mic!</p>";
                } else if($statusCheck == "nu_exista_alte_zile"){
                    echo "<p>Nu mai aveți alte zile de concediu disponibile!</p>";
                } else if($statusCheck == "aceasta_data_este_folosita"){
                    echo "<p>Alegeți alte date de concedii, acestea sunt deja folosite!<br> (vă puteți consulta cu tabelul de mai jos care vă informează despre ultimul concediu programat)</p>";
                }
            }
            echo '
                </center>
            </div>
            <div>&nbsp;</div><div class="clearfix">&nbsp;</div>'
            ;
            echo '
            <div class="container">
            <center>
                <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                <p>Mai jos aveți concediile pe care vi le-ati selectat ( Ziua-Luna-Anul )</p>
                <ul>
                    <li class="special">Nume</li>
                    <li class="special">Prenume</li>
                    <li class="special">Inceputul concediului</li>
                    <li class="special">Sfârșitul concediului</li>
                </ul>
            ';
            $sql_cod3 = "SELECT * FROM conturi WHERE username = '".$username."';";
            $sql_rez3 = mysqli_query($conn,$sql_cod3);
            $sql3 = mysqli_fetch_assoc($sql_rez3);
            $sql_cod4 = "SELECT * FROM zile_concedii WHERE username = '".$username."';";
            $sql_rez4 = mysqli_query($conn,$sql_cod4);
            while($sql4 = mysqli_fetch_assoc($sql_rez4)){
                echo '
                    <ul>
                        <li>'.$sql3['nume'].'</li>
                        <li>'.$sql3['prenume'].'</li>
                        <li>'.date("d-m-Y",strtotime($sql4['start'])).'</li>
                        <li>'.date("d-m-Y",strtotime($sql4['stop'])).'</li>
                    </ul>
                ';
                }
            
            echo '
            <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
            </center>
            </div>';