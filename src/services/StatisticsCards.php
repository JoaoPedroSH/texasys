<?php
require_once '../../config/ConnectionDB.php';
date_default_timezone_set('America/Belem');
$data_atual = date('Y-m-d');
$timestamp_init = strtotime($data_atual . ' 09:00:00');

$data_seguinte = date('Y-m-d', strtotime($data_atual . ' +1 day'));
$timestamp_end = strtotime($data_seguinte . ' 01:00:00');

/** Balcao */
$sql_sales_general = "SELECT COUNT(id) AS quant_vendas FROM vendas_balcao_cliente WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end ";
$sales_general_response = $mysqli->query($sql_sales_general)->fetch_assoc();
$sales_general = intval($sales_general_response['quant_vendas']);

$sql_valor_general = "SELECT SUM(valor_geral) AS valor_vendas FROM vendas_balcao_cliente WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end ";
$valor_general_response = $mysqli->query($sql_valor_general)->fetch_assoc();
$valor_general = floatval($valor_general_response['valor_vendas']);

$sql_lucro_general = "SELECT SUM(lucro_geral) AS lucro_vendas FROM vendas_balcao_cliente WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end ";
$lucro_general_response = $mysqli->query($sql_lucro_general)->fetch_assoc();
$lucro_general = floatval($lucro_general_response['lucro_vendas']);



$response = array(
    'vendas' => $sales_general,
    'receita' => $valor_general,
    'lucro' => $lucro_general
);

header('Content-Type: application/json');
echo json_encode($response);