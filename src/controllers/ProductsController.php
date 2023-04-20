<?php

require_once '../models/Products.php';

use services\Products;

$registerProducts = new Products();


if (isset($_POST['add'])) {
    return $registerProducts->postRegisterProducts($_POST);    
}   

if (isset($_POST['edit'])) {
    return $registerProducts->putRegisterProducts($_POST);
}

if (isset($_POST['delete'])) {
    return $registerProducts->deleteRegisterProducts($_POST['id']);
}
