<?php

namespace services;

class Products
{
    public function getRegisterProducts()
    {

        require '../../config/ConnectionDB.php';

        $registerProducts_query = "SELECT * FROM produtos";
        $registerProducts_response = $mysqli->query($registerProducts_query);
        return $registerProducts_response;
    }

    public function postRegisterProducts()
    {

        require '../../config/ConnectionDB.php';

        $category = $mysqli->escape_string($_POST['category']);
        $product = $mysqli->escape_string($_POST['product']);
        $value = $mysqli->escape_string($_POST['value']);
        $quantity = $mysqli->escape_string($_POST['quantity']);
        $supplier = $mysqli->escape_string($_POST['supplier']);
        $supplierValue = $mysqli->escape_string($_POST['supplier-value']);

        date_default_timezone_set('America/Belem');
        $data = date('Y-m-d');

        $registerProducts = "INSERT INTO produtos (categoria,produto,valor_produto,fornecedor,valor_fornecedor,quantidade,data) value('$category', '$product',
        '$value', '$supplier', '$supplierValue', '$quantity', '$data')";
        $registerProducts_response = $mysqli->query($registerProducts);

        if ($registerProducts_response == true) {
            session_start();
            $_SESSION['register_products_success'] = true;
            header('Location: ../views/admin/products.php');
        } else {
            session_start();
            $_SESSION['register_products_fail'] = true;
            header('Location: ../views/admin/products.php');
        }
    }

    public function putRegisterProducts()
    {
    }

    public function deleteRegisterProducts()
    {
    }
}
