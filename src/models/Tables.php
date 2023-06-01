<?php

namespace models;

class Tables
{

    public function finishTable($request)
    {
        require '../../config/ConnectionDB.php';

        print_r($request);

        /** Calcular margem de lucro com base nos valores dos produtos */

        /** Cadastrar na tabela 'vendas_mesas' */

        /** Alterar os registros das colunas 'status' e 'id_vendas_mesas' na tabela 'produtos_adicionados_mesas' */

        if ($teste == true) {
            session_start();
            $_SESSION['finish_sales_counter_success'] = true;
            header('Location: ../views/all/tables.php');
        } else {
            session_start();
            $_SESSION['finish_sales_counter_fail'] = true;
            header('Location: ../views/all/tables.php');
        }
    }

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

                if ($quantity_product !== '-1') {
                    if ($quantity_product == 0 || $quantity_product < $quantidade) {
                        $nome_produto = $products_value['produto'];
                        $message = "Quantidade insuficiente de " . $nome_produto . " no estoque! No pedido: " . $quantidade . ", em estoque: " . $quantity_product . ".";
                        echo "<script>
                                window.location.replace('../views/all/tables.php');
                                alert('$message');
                            </script>";
                    }
                } else {
                    /* Pegar valor do produto*/
                    $lucro = $products_value['valor_produto'] - $products_value['valor_fornecedor'];
                    $value_product = $products_value['valor_produto'] * $quantidade;

                    /* Subtrair valor da quantidade de produtos em estoque */
                    if ($quantity_product !== '-1') {
                        $quantidade_in_data = $products_value['quantidade'];
                        $new_quantidade = $quantidade_in_data - $quantidade;
                        $put_quant_product = "UPDATE produtos SET quantidade = '$new_quantidade' WHERE id = $id_produto";
                        $mysqli->query($put_quant_product);
                    }

                    /* Calcula o turno */
                    date_default_timezone_set('America/Belem');
                    $date = date('Y-m-d');
                    $time = date('H:i:s');

                    $time_atual = strtotime($time);
                    $time_comparation_01 = strtotime("09:00:00");
                    $time_comparation_02 = strtotime("15:00:00");
                    $time_comparation_03 = strtotime("23:00:00");
                    $time_comparation_04 = strtotime("01:00:00");

                    if ($time_atual >= $time_comparation_01 && $time_atual < $time_comparation_02) {
                        $turno = 1;
                    } elseif ($time_atual >= $time_comparation_02 && $time_atual < $time_comparation_03) {
                        $turno = 2;
                    } elseif ($time_atual >= $time_comparation_03 && $time_atual < $time_comparation_04) {
                        $turno = 2;
                    } else {
                        $turno = 0;
                    }

                    $status = 'aberto';

                    $product_add_table = "INSERT INTO produtos_adicionados_mesas (id_mesa, id_produto, quantidade, valor, lucro, data, hora, turno, status) VALUES ('$id_table', '$id_produto', '$quantidade', '$value_product', '$lucro', '$date', '$time', '$turno', '$status')";
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
}
