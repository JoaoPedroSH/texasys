<?php

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

function PrintBillTable($REQUEST)
{
    date_default_timezone_set('America/Belem');

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

    $html .= '
        <table>
            <thead id="thead-cabecalho">
                <tr>
                    <td>
                        <h4> Mesa ' . $REQUEST['id-tables-print'] . '</h4>
                        <h4> Valor: R$</h4>
                    </td>
                    <td>
                        <img src="https://raw.githubusercontent.com/impulse-devs/TexaSys/main/assets/img/logo.png" width="80px" height="40px"> 
                    </td>
                </tr>
            </thead>
        </table>
    ';

    $html .= '<table style="margin-top: 15px;">';

    $html .= '
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor</th>
        </tr>
    ';

    $html .= '
        <tr>
            <td id="td-sub-cabecalho"></td>
            <td id="td-sub-cabecalho"></td>
            <td id="td-sub-cabecalho">R$</td>
        </tr>';

    $html .= '</table>';

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A6', 'portrait');

    $dompdf->render();

    $dompdf->stream("conta_mesa_" . time() . ".pdf", array("Attachment" => false));
}
