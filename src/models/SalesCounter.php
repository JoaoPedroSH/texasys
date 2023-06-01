<?php

namespace models;

class SalesCounter
{

    public function finishSalesCounter($request)
    {
        require '../../config/ConnectionDB.php';

        print_r($request);

        /** Calcular margem de lucro com base nos valores dos produtos */

        /** Cadastrar na tabela 'vendas_balcao' */

        /** Deletar os registros da tabela 'produtos_adicionados_balcao' */

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

                    $product_add_table = "INSERT INTO produtos_adicionados_balcao (id_produto, quantidade, valor) VALUES ('$id_produto', '$quantidade', '$value_product')";
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
