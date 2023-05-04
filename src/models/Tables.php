<?php

namespace models;

class Tables
{
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

    public function postAddProductOfTables($request)
    {
        require '../../config/ConnectionDB.php';

        $id_table = $request['id-tables'];

        foreach ($request as $key => $value) {
            if (strpos($key, 'produto_') !== false) {
                $id_produto = substr($key, strlen('produto_'));
                $quantidade = $request['quantidade_' . $id_produto];

                /* Pegar valor do produto*/
                $get_products_value = "SELECT * FROM produtos WHERE id = $id_produto";
                $get_products_value_response = $mysqli->query($get_products_value);
                $products_value = $get_products_value_response->fetch_assoc();
                $value_product = $products_value['valor_produto'] * $quantidade;

                /* Subitrair valor da quantidade de produtos em estoque */
                $quantidade_in_data = $products_value['quantidade'];
                $new_quantidade = $quantidade_in_data - $quantidade;
                $put_quant_product = "UPDATE produtos SET quantidade = '$new_quantidade' WHERE id = $id_produto";
                $mysqli->query($put_quant_product);

                $product_add_table = "INSERT INTO produtos_adicionados_mesas (id_mesa, id_produto, quantidade, valor) VALUES ('$id_table', '$id_produto', '$quantidade', '$value_product')";
                $res_product_add_table = $mysqli->query($product_add_table);

                if ($res_product_add_table != 0) {
                    session_start();
                    $_SESSION['product_table_added_success'] = true;
                    header('Location: ../views/all/tables.php');
                } else {
                    session_start();
                    $_SESSION['product_table_added_fail'] = true;
                    header('Location: ../views/all/tables.php');
                }
            }
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
