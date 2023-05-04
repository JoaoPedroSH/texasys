<?php

namespace services;

class Employees
{
    public function postEmployees($request)
    {

        require '../../config/ConnectionDB.php';

        $function = $mysqli->escape_string($request['function']);
        $name = $mysqli->escape_string($request['name']);
        $lastname = $mysqli->escape_string($request['lastname']);
        $telefone = $mysqli->escape_string($request['telefone']);

        $registerEmployees = "INSERT INTO funcionarios (funcao,nome,sobrenome,numero) value('$function', '$name',
        '$lastname', '$telefone')";
        $registerEmployees_response = $mysqli->query($registerEmployees);

        if ($registerEmployees_response == true) {
            session_start();
            $_SESSION['register_employees_success'] = true;
            header('Location: ../views/admin/employees.php');
        } else {
            session_start();
            $_SESSION['register_employees_fail'] = true;
            header('Location: ../views/admin/employees.php');
        }
    }

    public function putEmployees()
    {
    }

    public function deleteEmployees()
    {
    }
}
