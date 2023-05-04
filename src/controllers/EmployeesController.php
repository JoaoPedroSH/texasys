<?php

require_once '../models/Employees.php';

use services\Employees;

$employees = new Employees();


if (isset($_POST['add'])) {
    return $employees->postEmployees($_POST);    
}   

if (isset($_POST['edit'])) {
    return $employees->putEmployees($_POST);
}

if (isset($_POST['delete'])) {
    return $employees->deleteEmployees($_POST['id']);
}