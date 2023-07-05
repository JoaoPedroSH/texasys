<?php

namespace services;

class Products
{
    public function postCategories($request)
    {
        require '../../config/ConnectionDB.php';

        $category = $mysqli->escape_string($request['categorie']);
        $register_categories = "INSERT INTO categorias (descricao) value('$category')";
        $register_categories_response = $mysqli->query($register_categories);

        if ($register_categories_response == true) {
            session_start();
            $_SESSION['register_categories_success'] = true;
            header('Location: ../views/admin/products.php');
        } else {
            session_start();
            $_SESSION['register_categories_fail'] = true;
            header('Location: ../views/admin/products.php');
        }
    }

    public function deleteCategories($id)
    {
        require '../../config/ConnectionDB.php';

        $delete_query = " DELETE FROM categorias WHERE id = $id";
        $delete_response = $mysqli->query($delete_query);

        if ($delete_response == true) {
            session_start();
            $_SESSION['delete_categorie_success'] = true;
            header('Location: ../views/admin/products.php');
        } else {
            session_start();
            $_SESSION['delete_categorie_fail'] = true;
            header('Location: ../views/admin/products.php');
        }
    }

    public function postProducts($request)
    {
        require '../../config/ConnectionDB.php';

        $category = $mysqli->escape_string($request['category']);
        $product = $mysqli->escape_string($request['product']);
        $value = $mysqli->escape_string($request['value']);
        $quantity = $mysqli->escape_string($request['quantity']);
        $supplier = $mysqli->escape_string($request['supplier']);
        $supplierValue = $mysqli->escape_string($request['supplier-value']);

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

    public function putProducts($request)
    {
        require '../../config/ConnectionDB.php';

        $id = $mysqli->escape_string($request['id']);
        $category = $mysqli->escape_string($request['category']);
        $product = $mysqli->escape_string($request['product']);
        $value = $mysqli->escape_string($request['value']);
        $quantity = $mysqli->escape_string($request['quantity']);
        $supplier = $mysqli->escape_string($request['supplier']);
        $supplierValue = $mysqli->escape_string($request['supplier-value']);

        $get_products = "SELECT quantidade FROM produtos WHERE id = $id";
        $get_products_response = $mysqli->query($get_products)->fetch_assoc();
        date_default_timezone_set('America/Belem');
        $data_atual = date('Y-m-d');

        if ($get_products_response['quantidade'] < $quantity) {
            $update_query = "UPDATE produtos SET categoria = '$category', produto = '$product', valor_produto = '$value', fornecedor = '$supplier', valor_fornecedor = '$supplierValue', quantidade = '$quantity', data = '$data_atual' WHERE id = $id";
            $update_response = $mysqli->query($update_query);
        }else {
            $update_query = "UPDATE produtos SET categoria = '$category', produto = '$product', valor_produto = '$value', fornecedor = '$supplier', valor_fornecedor = '$supplierValue', quantidade = '$quantity' WHERE id = $id";
            $update_response = $mysqli->query($update_query);
        }

        if ($update_response == true) {
            session_start();
            $_SESSION['edit_products_success'] = true;
            header('Location: ../views/admin/products.php');
        } else {
            session_start();
            $_SESSION['edit_products_fail'] = true;
            header('Location: ../views/admin/products.php');
        }
    }

    public function deleteProducts($id)
    {
        require '../../config/ConnectionDB.php';

        $delete_query = " DELETE FROM produtos WHERE id = $id";
        $delete_response = $mysqli->query($delete_query);

        if ($delete_response == true) {
            session_start();
            $_SESSION['delete_products_success'] = true;
            header('Location: ../views/admin/products.php');
        } else {
            session_start();
            $_SESSION['delete_products_fail'] = true;
            header('Location: ../views/admin/products.php');
        }
    }
}
