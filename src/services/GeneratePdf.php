<?php

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

function PrintBillTable($REQUEST)
{
    date_default_timezone_set('America/Belem');
    require_once '../../config/ConnectionDB.php';
    $dompdf = new Dompdf(['enable_remote' => true]);

    $html = '
        <style>
            body {
                justify-content:center;
                background-position: center;
            }
            td, th {
                border: 1px solid black;
                padding: 5px; 
                text-align: center;
            }

            th {
                background-color: #D1D1D1;
            }

            #td-sub-cabecalho {
                background-color: #EEEEEE;
            }

            #thead-cabecalho {
                background-color: white;
            }

            thead {
                background-color: #CCF0FF;
            }

            table {
                border: 1px solid black;
                border-collapse: collapse;
                width: 100%;
                font-size: 12px;
            }

            h4 {
                margin: 0px;
            }
        </style>
    ';

    $id_mesa_value = $REQUEST['id-tables-print'];
    $product_sum_table_query = "SELECT SUM(valor) as valor_total FROM produtos_adicionados_mesas WHERE id_mesa = $id_mesa_value AND status = 'aberto'";
    $product_sum_table_result = $mysqli->query($product_sum_table_query)->fetch_assoc();
    $product_sum_table = floatval($product_sum_table_result['valor_total']);

    $html .= '
        <table>
            <thead id="thead-cabecalho">
                <tr>
                    <td>
                        <h4> Mesa ' . $REQUEST['id-tables-print'] . '</h4>
                        <h4> Valor: R$'.$product_sum_table.'</h4>
                    </td>
                    <td>
                        <img src="https://raw.githubusercontent.com/impulse-devs/TexaSys/main/assets/img/logo.png" width="80px" height="40px"> 
                    </td>
                </tr>
            </thead>
        </table>
    ';


    $code_mesa = $REQUEST['id-tables-print'];
    $get_products_table_query = "SELECT * FROM produtos_adicionados_mesas WHERE id_mesa = $code_mesa AND status = 'aberto'";
    $get_products_table_response = $mysqli->query($get_products_table_query);



    $html .= '<table style="margin-top: 15px;">';

    $html .= '
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor</th>
        </tr>';


    while ($products_added = $get_products_table_response->fetch_assoc()) {
        $code_produto = $products_added['id_produto'];
        $get_products_unic_query = "SELECT * FROM produtos WHERE id = $code_produto";
        $get_products_unic_response = $mysqli->query($get_products_unic_query);
        $products_unic = $get_products_unic_response->fetch_assoc();
        $html .= '
        <tr>
        <td id="td-sub-cabecalho">' . $products_unic['produto'] . '</td>
            <td id="td-sub-cabecalho">' . $products_added['quantidade'] . '</td>
            <td id="td-sub-cabecalho">R$' . $products_added['valor'] . '</td> 
        </tr>';
    }

    $html .= '</table>';

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A6', 'portrait');

    $dompdf->render();

    $dompdf->stream("conta_mesa_" . time() . ".pdf", array("Attachment" => false));
}
