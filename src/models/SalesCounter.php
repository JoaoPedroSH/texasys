<?php

namespace models;

class SalesCounter
{

    public function finishSalesCounter($request)
    {
        require '../../config/ConnectionDB.php';

        $id_employees = $request['employees-counter'];

        /** Soma valores e lucros dos produtos */
        $valor_sales_general = "SELECT SUM(valor) AS valor_total FROM produtos_adicionados_balcao WHERE status = 'aberto'";
        $valor_general_response = $mysqli->query($valor_sales_general)->fetch_assoc();
        $valor_general = $valor_general_response['valor_total'];

        $lucro_sales_general = "SELECT SUM(lucro) AS lucro_total FROM produtos_adicionados_balcao WHERE status = 'aberto'";
        $lucro_general_response = $mysqli->query($lucro_sales_general)->fetch_assoc();
        $lucro_general = $lucro_general_response['lucro_total'];

        date_default_timezone_set('America/Belem');
        $data_hora = date('Y-m-d H:i:s');
        $timestamp = strtotime($data_hora);

        $tipo_vendas = $request['radio-stacked-sales-counter'];

        /** Cadastrar na tabela 'vendas_balcao' */
        if ($tipo_vendas == 'client') {
            $finish_sales_client = "INSERT INTO vendas_balcao_cliente (valor_geral, lucro_geral, data_hora, carimbo_data_hora) VALUES ('$valor_general','$lucro_general','$data_hora', '$timestamp')";
            $insert_client =  $mysqli->query($finish_sales_client);

            $id_sales_client = "SELECT id FROM vendas_balcao_cliente ORDER BY id DESC LIMIT 1;";
            $id_sales_client_response = $mysqli->query($id_sales_client)->fetch_assoc();

            $id_vendas_balcao = $id_sales_client_response['id'];
        } elseif ($tipo_vendas == 'employees') {
            $finish_sales_employees = "INSERT INTO vendas_balcao_funcionario (id_funcionario, valor_geral, lucro_geral, data_hora, carimbo_data_hora, status) VALUES ('$id_employees', '$valor_general', '$lucro_general', '$data_hora', '$timestamp', 'pendente' )";
            $insert_employees = $mysqli->query($finish_sales_employees);

            $id_sales_employees = "SELECT id FROM vendas_balcao_funcionario ORDER BY id DESC LIMIT 1;";
            $id_sales_employees_response = $mysqli->query($id_sales_employees)->fetch_assoc();

            $id_vendas_balcao = $id_sales_employees_response['id'];
        }

        /** Alterar os registros das colunas 'status' e 'id_vendas_balcao' na tabela 'produtos_adicionados_balcao' */
        $finish_sales_counter = "UPDATE produtos_adicionados_balcao SET status = 'fechado', id_vendas_balcao = '$id_vendas_balcao', tipo_vendas = '$tipo_vendas' WHERE status = 'aberto'";
        $mysqli->query($finish_sales_counter);

        $valor_employees = "SELECT SUM(valor_geral) AS valor_total FROM vendas_balcao_funcionario WHERE status = 'pendente' AND id_funcionario = '$id_employees'";
        $valor_employees_response = $mysqli->query($valor_employees)->fetch_assoc();
        $valor_employees = $valor_employees_response['valor_total'];

        $add_value_employees = "UPDATE funcionarios SET debito = '$valor_employees' WHERE id = '$id_employees'";
        $mysqli->query($add_value_employees);

        if ($insert_client == true || $insert_employees == true) {
            session_start();
            $_SESSION['finish_sales_counter_success'] = true;
            header('Location: ../views/all/tables.php');
        } else {
            session_start();
            $_SESSION['finish_sales_counter_fail'] = true;
            header('Location: ../views/all/tables.php');
        }
    }

    public function postAddProductOfSalesCounter($request)
    {
        require '../../config/ConnectionDB.php';

        foreach ($request as $key => $value) {
            if (strpos($key, 'produto_') !== false) {
                $id_produto = substr($key, strlen('produto_'));
                $quantidade = $request['quantidade_' . $id_produto];

                $get_products_value = "SELECT * FROM produtos WHERE id = $id_produto";
                $get_products_value_response = $mysqli->query($get_products_value);
                $products_value = $get_products_value_response->fetch_assoc();

                $quantity_product = $products_value['quantidade'];
                $lucro = $products_value['valor_produto'] - $products_value['valor_fornecedor'];

                if ($quantity_product == 0 || $quantity_product < $quantidade) {

                    $nome_produto = $products_value['produto'];
                    $message = "Quantidade insuficiente de " . $nome_produto . " no estoque! No pedido: " . $quantidade . ", em estoque: " . $quantity_product . ".";
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

                    $product_add_table = "INSERT INTO produtos_adicionados_balcao (id_produto, quantidade, valor, lucro, data, hora, turno, status) VALUES ('$id_produto', '$quantidade', '$value_product', '$lucro', '$date', '$time', '$turno', '$status')";
                    $res_product_add_table = $mysqli->query($product_add_table);

                    if ($res_product_add_table != 0) {
                        session_start();
                        $_SESSION['product_sales_counter_added_success'] = true;
                        header('Location: ../views/all/tables.php');
                    } else {
                        session_start();
                        $_SESSION['product_sales_counter_added_fail'] = true;
                        header('Location: ../views/all/tables.php');
                    }
                }
            }
        }
    }

    public function deleteProductAddedSalesCounter($request)
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

        $delete_query = "DELETE FROM produtos_adicionados_balcao WHERE id = $cod_product_added";
        $delete_response = $mysqli->query($delete_query);

        if ($delete_response == true) {
            session_start();
            $_SESSION['removed_product_sales_counter_success'] = true;
            header('Location: ../views/all/tables.php');
        } else {
            session_start();
            $_SESSION['removed_product_sales_counter_fail'] = true;
            header('Location: ../views/all/tables.php');
        }
    }
}
