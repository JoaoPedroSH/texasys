<?php

namespace models;

class Tables
{

    public function putQuantityTables($request)
    {
        require '../../config/ConnectionDB.php';

        $quantity_tables = $mysqli->escape_string($request['quantity-tables']);
        $table_quant_report = "UPDATE mesas_quantidade SET quantidade = '$quantity_tables' WHERE id = 1";
        $table_quant_response = $mysqli->query($table_quant_report);

        if ($table_quant_response == 1) {
            session_start();
            $_SESSION['num_table_added_success'] = true;
            header('Location: ../views/all/tables.php');
        } else {
            session_start();
            $_SESSION['num_table_added_fail'] = true;
            header('Location: ../views/all/tables.php');
        }
    }

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


                $get_products_value = "SELECT * FROM produtos WHERE id = $id_produto";
                $get_products_value_response = $mysqli->query($get_products_value);
                $products_value = $get_products_value_response->fetch_assoc();

                $quantity_product = $products_value['quantidade'];

                if ($quantity_product == 0 || $quantity_product < $quantidade) {

                    $nome_produto = $products_value['produto'];
                    $message = "Quantidade insuficiente de " . $nome_produto . " no estoque! No pedido: " . $quantidade . ", em estoque: " . $quantity_product .".";
                    echo "<script>
                                window.location.replace('../views/all/tables.php');
                                alert('$message');
                            </script>";
                } else {
                    /* Pegar valor do produto*/
                    $value_product = $products_value['valor_produto'] * $quantidade;

                    /* Subtrair valor da quantidade de produtos em estoque */
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
    }

    public function deleteProductAddedTable($request)
    {
        require '../../config/ConnectionDB.php';

        $cod_product_added = $mysqli->escape_string($request['cod-product-added']);
        $id_product = $mysqli->escape_string($request['id-product']);
        $quant_product = $mysqli->escape_string($request['quant-product']);

        $get_quant_product_query = "SELECT * FROM produtos WHERE id = $id_product";
        $get_quant_product_response = $mysqli->query($get_quant_product_query);
        $get_quant_db = $get_quant_product_response->fetch_assoc();
        $quantidade_db = $get_quant_db['quantidade'];
        $new_quant = $quantidade_db + $quant_product;

        $put_quant_product_query = "UPDATE produtos SET quantidade = '$new_quant' WHERE id = $id_product";
        $mysqli->query($put_quant_product_query);

        $delete_query = "DELETE FROM produtos_adicionados_mesas WHERE id = $cod_product_added";
        $delete_response = $mysqli->query($delete_query);

        print_r($put_quant_product_response);

        if ($delete_response == true) {
            session_start();
            $_SESSION['removed_product_success'] = true;
            header('Location: ../views/all/tables.php');
        } else {
            session_start();
            $_SESSION['removed_product_fail'] = true;
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
