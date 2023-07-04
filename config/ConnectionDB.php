<?php 

    require_once 'Environment.php';
    use config\Environment;
    Environment::load();

    $host = "{$_ENV['HOST']}";
    $user = "{$_ENV['USER']}";
    $password = "{$_ENV['PASSWORD']}";
    $dataBase = "{$_ENV['DATABASE']}";

    $mysqli = new mysqli($host,$user,$password,$dataBase);
        if($mysqli->connect_errno) {
            echo "Conectar Falid: " . $mysqli->connect_error;
            exit();
        }
?>