<?php

namespace models;

class Tables
{

    /* public function getTables()
    {
        require '../../config/ConnectionDB.php';
        $get_table_query = "SELECT * FROM mesas_adicionadas";
        $get_table_response = $mysqli->query($get_table_query);
        return $get_table_response;
    } */

    public function postAddTables($request)
    {

        require '../../config/ConnectionDB.php';

        $cod_table = $mysqli->escape_string($request['cod-table']);
        $employee = $mysqli->escape_string($request['employee']);

        $table_report = "INSERT INTO mesas_adicionadas (cod_mesa, funcionario) VALUES ('$cod_table', '$employee')";
        $table_response = $mysqli->query($table_report);


        if ($table_response == 1) {
            session_start();
            $_SESSION['table_added_success'] = true;
            header('Location: ../views/all/tables.php');
        } else {
            session_start();
            $_SESSION['table_added_fail'] = true;
            header('Location: ../views/all/tables.php');
        }
    }

    /* public function putPastures($request, $retreat)
    {
        require 'Conexao.php';

        $retreat_id = $retreat['id'];
        $retreat_nome = $retreat['nome'];
        $id = $mysqli->escape_string($request['id']);
        $name = $mysqli->escape_string($request['name']);
        $farm = $mysqli->escape_string($request['farm']);
        
        $update_query = "UPDATE pastos SET nome = '$name', id_retiro = '$retreat_id', retiro = '$retreat_nome', fazenda = '$farm' WHERE id = $id";
        $update_response = $mysqli->query($update_query);

        if ($update_response == true) {
            session_start();
            $_SESSION['edit_pastures_success'] = true;
            header('Location: ../pages/areaPastures.php');
        } else {
            session_start();
            $_SESSION['edit_pastures_fail'] = true;
            header('Location: ../pages/areaPastures.php');
        }
    }

    public function deletePastures($id)
    {
        require 'Conexao.php';

        $delete_query = " DELETE FROM pastos WHERE id = $id";
        $delete_response = $mysqli->query($delete_query);

        if ($delete_response == true) {
            session_start();
            $_SESSION['delete_pastures_success'] = true;
            header('Location: ../pages/areaPastures.php');
        } else {
            session_start();
            $_SESSION['delete_pastures_fail'] = true;
            header('Location: ../pages/areaPastures.php');
        }
    } */
}
