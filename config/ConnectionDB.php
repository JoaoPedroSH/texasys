<?php 

    require_once 'Environment.php';
    use config\Environment;
    Environment::load();

    $host = "localhost";
    $user = "root";
    $password = "";
    $dataBase = "texasys";
    $mysqli = new mysqli($host,$user,$password,$dataBase);
        if($mysqli->connect_errno) {
            echo "Conectar Falid: " . $mysqli->connect_error;
            exit();
        }
?>