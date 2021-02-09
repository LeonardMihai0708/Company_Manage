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
                <p>Angajații acestei companii sunt: <br><br>
            ';
            $all_from_mysqli_select = "SELECT * FROM conturi where stare = 0";
            $result_all_from_mysqli = mysqli_query($conn,$all_from_mysqli_select);
            while($utilizatori = mysqli_fetch_assoc($result_all_from_mysqli)){
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#9658; ';
                echo $utilizatori['username'].'<br>';
            } 
            echo '
            </p><br>
            <p>Mai jos aveți tabelul cu toate plățile efectuate de până acum!</p>
            </div>
            <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
            ';
            $sql_cod = 'SELECT * FROM plati WHERE start >= current_date - 30 ORDER BY id DESC LIMIT 100;';
            $sql_rez = mysqli_query($conn,$sql_cod);
            if($sql_rez){
                    echo '
                        <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                        <div class="container">
                            <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                            <center>
                                <form action="baza_de_date/start.php" method="POST">
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
                    echo '
                        <center>
                            <form action="baza_de_date/stop.php" method="POST">
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
                                <button type="submit" name="submit"> Stop Program </button>
                            </form>
                        </center>
                        <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                    </div>
                    <div id = "1">&nbsp;</div><div class="clearfix">&nbsp;</div>
                    ';
                echo '
                <center>
                <form method="GET" action="#1">
                <select name="nr_plati" class="select_persoane" >
                    <option>Toate_Plățile</option>
                ';
                $all_from_mysqli_select = "SELECT * FROM conturi where stare = 0";
                $result_all_from_mysqli = mysqli_query($conn,$all_from_mysqli_select);
                while($utilizatori = mysqli_fetch_assoc($result_all_from_mysqli)){
                    echo '
                    <option>'.$utilizatori['username'].'</option>
                    ';
                }
                echo '
                </select><br><br>
                <button type="submit" name="submit" > Apasă aici pentru a reface tabelul! </button>
                </form><br><br><br>
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
                if(isset($_GET['nr_plati'])){
                    if($_GET['nr_plati'] == "Toate_Plățile"){
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
                    } else{
                        $nr_plati = $_GET['nr_plati'];
                        $sql_cod = "SELECT * FROM conturi WHERE username = '".$nr_plati."'";
                        $sql_rez = mysqli_query($conn,$sql_cod);
                        $sql =mysqli_fetch_assoc($sql_rez);
                        $nume = $sql['nume'];
                        $prenume = $sql['prenume'];
                        $date = date('Y-m-d H:i:s',time()-(7*86400));
                        $sql_cod2 = "SELECT * FROM plati WHERE nume = '".$nume."' AND prenume = '".$prenume."' AND start >= current_date - 30 ORDER BY id DESC LIMIT 100;";
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
                echo '</center>';
            }
                $all_from_mysqli_select = "SELECT * FROM conturi where stare = 0";
                $result_all_from_mysqli = mysqli_query($conn,$all_from_mysqli_select);
                if($result_all_from_mysqli){
                    echo '
                    <div id = "2">&nbsp;</div><div class="clearfix">&nbsp;</div>
                    <div class="container">
                        <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                        <center>
                            <form action="baza_de_date/adaugare.php" method="POST">
                                <input type="text" placeholder="Username" name="username" required><br><br>
                                <input type="password" placeholder="Parola" name="parola" required><br><br>
                                <input type="text" placeholder="Numele" name="name" required><br><br>
                                <input type="text" placeholder="Prenume" name="prenom" required><br><br>
                                <select name="select_statut" class="select_persoane">
                                    <option>Angajat</option>
                                    <option>Manager</option>
                                </select><br><br>
                                <button type="submit" name="submit"> Adăugare utilizator </button>
                            </form>
                        </center>
                        <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                        <center>
                            <form action="baza_de_date/stergere.php" method="POST">
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
                                <button type="submit" name="submit" onclick="myFunction2()"> Sterge un utilizator </button>
                            </form>
                        </center>
                        <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                    </div>
                    <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                    ';
                    if(isset($_GET['status'])){
                        $statusCheck = $_GET['status'];
                        if($statusCheck == "utilizator_deja_folosit"){
                            echo "<center><p class='eroare'><b> Acest Username este deja folosit! Vă rugăm sa folosiți altul! </b></p></center>";
                        }
                    }

                    if(isset($_GET['status'])){
                        $statusCheck = $_GET['status'];
                        if($statusCheck == "selectati_o_persoana"){
                            echo "<center><p class='eroare'><b> Alegeți o persoană! </b></p></center>";
                        } else if($statusCheck == "stop_refolosit"){
                            echo "<center><p class='eroare'><b> Ați oprit deja programul, începeți altul! </b></p></center>";
                        }
                    }
                }
                echo '
                <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                <div class="container">
                <div id="concedii">&nbsp;</div><div class="clearfix">&nbsp;</div>
                <center>
                        <form method="GET" action="#concedii">
                        <select name="tabel_concedii_select" class="select_persoane">
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
                                <button type="submit" name="submit"> Afișează tabelul cu concedii </button>
                        </form>
                        <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                ';
                if( isset($_GET['tabel_concedii_select']) ){
                    if($_GET['tabel_concedii_select'] == "Alegeți o persoană"){
                        echo '
                        <ul>
                            <li class="special">Username</li>
                            <li class="special">Începutul Concediului</li>
                            <li class="special">Sfârștul Concediului</li>
                        </ul>
                        ';
                        $sql_cod4 = "SELECT * FROM zile_concedii;";
                        $sql_rez4 = mysqli_query($conn,$sql_cod4);
                        while($sql4 = mysqli_fetch_assoc($sql_rez4)){
                            echo '
                                <ul>
                                    <li>'.$sql4['username'].'</li>
                                    <li>'.date("d-m-Y",strtotime($sql4['start'])).'</li>
                                    <li>'.date("d-m-Y",strtotime($sql4['stop'])).'</li>
                                </ul>
                            ';
                        }
                    } else{
                        echo '
                        <ul>
                            <li class="special">Nume</li>
                            <li class="special">Prenume</li>
                            <li class="special">Începutul Concediului</li>
                            <li class="special">Sfârștul Concediului</li>
                        </ul>
                        ';
                        $select_persoane = $_GET['tabel_concedii_select'];
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
                    }
                } else {
                    echo '
                        <ul>
                            <li class="special">Username</li>
                            <li class="special">Începutul Concediului</li>
                            <li class="special">Sfârștul Concediului</li>
                        </ul>
                        ';
                    $sql_cod4 = "SELECT * FROM zile_concedii;";
                    $sql_rez4 = mysqli_query($conn,$sql_cod4);
                    while($sql4 = mysqli_fetch_assoc($sql_rez4)){
                        echo '
                            <ul>
                                <li>'.$sql4['username'].'</li>
                                <li>'.date("d-m-Y",strtotime($sql4['start'])).'</li>
                                <li>'.date("d-m-Y",strtotime($sql4['stop'])).'</li>
                            </ul>
                        ';
                    }
                }
                echo '
                <div>&nbsp;</div><div class="clearfix">&nbsp;</div>
                </div>
                ';