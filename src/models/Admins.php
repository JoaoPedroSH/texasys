<?php

namespace services;

class Admins
{
    public function postAdmin($request)
    {

        require '../../config/ConnectionDB.php';

        $name = $mysqli->escape_string($request['name']);
        $user_name = $mysqli->escape_string($request['user_name']);
        $password = $mysqli->escape_string($request['password']);

        $registerAdmin = "INSERT INTO admins (nome,nome_usuario,senha) value('$name', '$user_name',
        '$password')";

        $registerAdmin_response = $mysqli->query($registerAdmin);

        if ($registerAdmin_response == true) {
            session_start();
            $_SESSION['register_admins_success'] = true;
            header('Location: ../views/admin/admins.php');
        } else {
            session_start();
            $_SESSION['register_admins_fail'] = true;
            header('Location: ../views/admin/admins.php');
        }
    }

    public function putAdmin()
    {
    }

    public function deleteAdmin()
    {
    }
}
