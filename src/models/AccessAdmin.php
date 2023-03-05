<?php

namespace models;

class AccessAdmin
{
    public function getAccessAdmin($request)
    {
        require '../../config/ConnectionDB.php';

        $usuario = $mysqli->escape_string($request['admin_user']);
        $senha = $mysqli->escape_string($request['admin_password']);

        $user_query = "SELECT * FROM admins WHERE nome_usuario='$usuario' AND senha='$senha'";
        $user_response = $mysqli->query($user_query);
        $user_result = $user_response->num_rows;

        if ($user_result == 1) {
            session_start();
            $user = $user_response->fetch_assoc();
            $_SESSION[$user['nome']] = true;
            $_SESSION['access_admin_success'] = true;
            header('Location: ../views/admin/dashboard.php');
        } else {
            session_start();
            $_SESSION['access_admin_fail'] = true;
            header('Location: ../views/all/access_admin.php');
        }
    }
}
