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

    public function postProducts($request, $file)
    {
        require '../../config/ConnectionDB.php';

        $category = $mysqli->escape_string($request['category']);
        $product = $mysqli->escape_string($request['product']);
        $value = $mysqli->escape_string($request['value']);
        $quantity = $mysqli->escape_string($request['quantity']);
        $supplier = $mysqli->escape_string($request['supplier']);
        $supplierValue = $mysqli->escape_string($request['supplier-value']);

        if (isset($file["photo"])) {
            $file = $file["photo"];
            $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
            $filename = uniqid() . "." . $extension;
            $tmp_path = $file["tmp_name"];
            $upload_path = "../storage/" . $filename;
            move_uploaded_file($tmp_path, $upload_path);
        } else {
            $filename = "default.svg";
            $upload_path = "../storage/" . $filename;
        }

        date_default_timezone_set('America/Belem');
        $data = date('Y-m-d');

        $registerProducts = "INSERT INTO produtos (categoria,produto,valor_produto,fornecedor,valor_fornecedor,quantidade,data,foto,caminho_foto) value('$category', '$product',
        '$value', '$supplier', '$supplierValue', '$quantity', '$data', '$filename', '$upload_path')";
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

    public function putProducts($request, $file)
    {
        require '../../config/ConnectionDB.php';

        $id = $mysqli->escape_string($request['id']);
        $category = $mysqli->escape_string($request['category']);
        $product = $mysqli->escape_string($request['product']);
        $value = $mysqli->escape_string($request['value']);
        $quantity = $mysqli->escape_string($request['quantity']);
        $supplier = $mysqli->escape_string($request['supplier']);
        $supplierValue = $mysqli->escape_string($request['supplier-value']);

        $get_products = "SELECT quantidade, foto FROM produtos WHERE id = $id";
        $get_products_response = $mysqli->query($get_products)->fetch_assoc();
        date_default_timezone_set('America/Belem');
        $data_atual = date('Y-m-d');

        if (isset($file["photo_edit"])) {
            $file = $file["photo_edit"];
            $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
            $filename = uniqid() . "." . $extension;
            $tmp_path = $file["tmp_name"];
            $upload_path = "../storage/" . $filename;
            move_uploaded_file($tmp_path, $upload_path);
        } else {
            $filename = $get_products_response['foto'];
            $upload_path = "../storage/" . $filename;
        }


        if ($get_products_response['quantidade'] < $quantity) {
            $update_query = "UPDATE produtos SET categoria = '$category', produto = '$product', valor_produto = '$value', fornecedor = '$supplier', valor_fornecedor = '$supplierValue', quantidade = '$quantity', data = '$data_atual', foto = '$filename', caminho_foto = '$upload_path' WHERE id = $id";
            $update_response = $mysqli->query($update_query);
        } else {
            $update_query = "UPDATE produtos SET categoria = '$category', produto = '$product', valor_produto = '$value', fornecedor = '$supplier', valor_fornecedor = '$supplierValue', quantidade = '$quantity', foto = '$filename', caminho_foto = '$upload_path' WHERE id = $id";
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
