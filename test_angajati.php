<?php
    include_once("baza_de_date/dbs.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="baza_de_date/test.php" method="POST">
        <input type="date" name="startDate"/>
        <input type="date" name="endDate" /><br><br>
        <button type="submit" name="submit">Programează-te!</button>
    </form>
</body>
</html>