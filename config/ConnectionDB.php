<?php 

    $host = "localhost";
    $user = "root";
    $password = "21160422";
    $dataBase = "texasys";

    $mysqli = new mysqli($host,$user,$password,$dataBase);
        if($mysqli->connect_errno) {
            echo "Conectar Falid: " . $mysqli->connect_error;
            exit();
        }
?>