<?php

namespace services;

class Employees
{

    public function putDischangeDebit($id)
    {

        require '../../config/ConnectionDB.php';

        $put_vendas = "UPDATE vendas_balcao_funcionario SET status = 'quitado' WHERE status = 'pendente' AND id_funcionario = '$id'";
        $put_vendas_result = $mysqli->query($put_vendas);

        if ($put_vendas_result == true) {
            $put_employees = "UPDATE funcionarios SET debito = 0 WHERE id = '$id'";
            $put_employees_result = $mysqli->query($put_employees);
        }

        if ($put_vendas_result == true && $put_employees_result == true) {
            session_start();
            $_SESSION['dischange_debit_success'] = true;
            header('Location: ../views/admin/employees.php');
        } else {
            session_start();
            $_SESSION['dischange_debit_fail'] = true;
            header('Location: ../views/admin/employees.php');
        }
    }

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

    public function putEmployees($request)
    {
        require '../../config/ConnectionDB.php';

        $function = $mysqli->escape_string($request['function']);
        $name = $mysqli->escape_string($request['name']);
        $lastname = $mysqli->escape_string($request['lastname']);
        $telefone = $mysqli->escape_string($request['telefone']);
    }

    public function deleteEmployees()
    {
    }
}
