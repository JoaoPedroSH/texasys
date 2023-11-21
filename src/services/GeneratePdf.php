<?php

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

function PrintBillSales()
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

    $product_sum_sales_query = "SELECT SUM(valor) as valor_total FROM produtos_adicionados_balcao WHERE status = 'aberto'";
    $product_sum_sales_result = $mysqli->query($product_sum_sales_query)->fetch_assoc();
    $product_sum_sales = floatval($product_sum_sales_result['valor_total']);

    $html .= '
        <table>
            <thead id="thead-cabecalho">
                <tr>
                    <td>
                        <h4> VALOR TOTAL: R$ ' . $product_sum_sales . '</h4>
                    </td>
                    <td>
                        <img src="https://raw.githubusercontent.com/impulse-devs/TexaSys/main/assets/img/logo.png" width="80px" height="40px"> 
                    </td>
                </tr>
            </thead>
        </table>
    ';

    $get_products_sales_query = "SELECT * FROM produtos_adicionados_balcao WHERE status = 'aberto'";
    $get_products_sales_response = $mysqli->query($get_products_sales_query);

    $html .= '<table style="margin-top: 15px;">';
    $html .= '
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor</th>
        </tr>';
        while ($products_added = $get_products_sales_response->fetch_assoc()) {
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
                        <h4> MESA ' . $REQUEST['id-tables-print'] . '</h4>
                        <h4> VALOR TOTAL: R$ ' . $product_sum_table . '</h4>
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

function PrintReportsDay($REQUEST)
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

            .td-sub-cabecalho {
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
                font-size: 14px;
            }

            h4 {
                margin: 0px;
            }
        </style>
    ';

    $html .= '<center> <img src="https://raw.githubusercontent.com/impulse-devs/TexaSys/main/assets/img/logo.png" width="130px" height="80px" style="margin-bottom: 20px;"> </center>';

    $html .= '
        <table>
            <thead id="thead-cabecalho">
                <tr>
                    <td>
                        RELATÓRIO DO DIA <b>' . date("d/m/Y", strtotime($REQUEST['dado-data1'])) . '</b>
                    </td>
                    <td>';
                        if ($REQUEST['tipo-filtro'] == 'total') {
                            $html .= 'TODOS OS TURNOS';
                        }
                        if ($REQUEST['tipo-filtro'] == '1') {
                            $html .= 'TURNO 1 (9H - 15H)';
                        }
                        if ($REQUEST['tipo-filtro'] == '2') {
                            $html .= 'TURNO 2 (15H - 23H)';
                        }
                        if ($REQUEST['tipo-filtro'] == '3') {
                            $html .= 'TURNO 3 (23H - 1H)';
                        }
                    $html .= '
                    </td>
                </tr>
            </thead>
        </table>
        <br>
    ';

    $html .= '
        <table>
            <thead id="thead-cabecalho">
                <tr>
                    <th>
                        Receita
                    </th>
                    <th>
                        Lucro
                    </th>
                </tr>';
                if ($REQUEST['tipo-filtro'] == 'total') {
                $html .= '
                <tr>
                    <td>
                        Turno 1: R$' . round($REQUEST['dado-receita-1'], 2) . '
                    </td>
                    <td>
                        Turno 1: R$' . round($REQUEST['dado-lucro-1'], 2) . '
                    </td>
                </tr>
                <tr>
                    <td>
                        Turno 2: R$' . round($REQUEST['dado-receita-2'], 2) . '
                    </td>
                    <td>
                        Turno 2: R$' . round($REQUEST['dado-lucro-2'], 2) . '
                    </td>
                </tr>
                <tr>
                    <td>
                        Turno 3: R$' . round($REQUEST['dado-receita-3'], 2) . '
                    </td>
                    <td>
                        Turno 3: R$' . round($REQUEST['dado-lucro-3'], 2) . '
                    </td>
                </tr>';
                }
                $html .= '
                <tr>
                    <td class="td-sub-cabecalho">
                        Total: <b>R$' . round($REQUEST['dado-receita'], 2) . '</b>
                    </td>
                    <td class="td-sub-cabecalho">
                        Total: <b>R$' . round($REQUEST['dado-lucro'], 2) . '</b>
                    </td>
                </tr>
            </thead>
        </table>
        <br>
    ';

    $html .= '
        <table>
            <thead id="thead-cabecalho">
                <tr>
                    <th>
                        <b> Produtos vendidos </b>
                    </th>
                </tr>
            </thead>
        </table>
    ';

    $html .= '
        <table>
            <tr>
                <td class="td-sub-cabecalho">Produto</td>
                <td class="td-sub-cabecalho">Quantidade</td>
                <td class="td-sub-cabecalho">Receita</td> 
                <td class="td-sub-cabecalho">Lucro</td>
            </tr>';
            $json_products = $REQUEST['dado-produtos'];
            $produtos_dados = json_decode($json_products, true);
            if ($produtos_dados !== null) {
            foreach ($produtos_dados as $produto) {
            $code_produto = $produto['id_produto'];
            $get_products = "SELECT produto FROM produtos WHERE id = $code_produto";
            $get_products_response = $mysqli->query($get_products);
            $name_product = $get_products_response->fetch_assoc();
            $html .= '
            <tr>
                <td>'.$name_product['produto'].'</td>
                <td>'.$produto['quantidade'].'</td>
                <td>R$ '.$produto['valor'].'</td>
                <td>R$ '.$produto['lucro'].'</td>
            </tr>';
            }}
    $html .= '</table>';


    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("relatorio_" . date("d-m-Y", strtotime($REQUEST['dado-data1'])) . "_turno-". $REQUEST['tipo-filtro'] .".pdf", array("Attachment" => false));
}
