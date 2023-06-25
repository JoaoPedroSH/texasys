<?php

require_once '../models/Admins.php';

use services\Admins;

$admin = new Admins();


if (isset($_POST['add'])) {
    return $admin->postAdmin($_POST);    
}   

if (isset($_POST['delete'])) {
    return $admin->deleteAdmin($_POST['id']);
}