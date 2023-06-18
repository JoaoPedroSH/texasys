<?php
require_once '../../config/ConnectionDB.php';
date_default_timezone_set('America/Belem');
$data_atual = date('Y-m-d');
$timestamp_init = strtotime($data_atual . ' 09:00:00');

$data_seguinte = date('Y-m-d', strtotime($data_atual . ' +1 day'));
$timestamp_end = strtotime($data_seguinte . ' 01:00:00');

/** Balcao */
$sql_sales_general_balcao = "SELECT COUNT(id) AS quant_vendas FROM vendas_balcao_cliente WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end ";
$sales_general_balcao_response = $mysqli->query($sql_sales_general_balcao)->fetch_assoc();
$sales_general_balcao = intval($sales_general_balcao_response['quant_vendas']);

$sql_valor_general_balcao = "SELECT SUM(valor_geral) AS valor_vendas FROM vendas_balcao_cliente WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end ";
$valor_general_balcao_response = $mysqli->query($sql_valor_general_balcao)->fetch_assoc();
$valor_general_balcao = floatval($valor_general_balcao_response['valor_vendas']);

$sql_lucro_general_balcao = "SELECT SUM(lucro_geral) AS lucro_vendas FROM vendas_balcao_cliente WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end ";
$lucro_general_balcao_response = $mysqli->query($sql_lucro_general_balcao)->fetch_assoc();
$lucro_general_balcao = floatval($lucro_general_balcao_response['lucro_vendas']);

/** Mesas */
$sql_sales_general_mesas = "SELECT COUNT(id) AS quant_vendas FROM vendas_mesas WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end ";
$sales_general_mesas_response = $mysqli->query($sql_sales_general_mesas)->fetch_assoc();
$sales_general_mesas = intval($sales_general_mesas_response['quant_vendas']);

$sql_valor_general_mesas = "SELECT SUM(valor) AS valor_vendas FROM vendas_mesas WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end ";
$valor_general_mesas_response = $mysqli->query($sql_valor_general_mesas)->fetch_assoc();
$valor_general_mesas = floatval($valor_general_mesas_response['valor_vendas']);

$sql_lucro_general_mesas = "SELECT SUM(lucro) AS lucro_vendas FROM vendas_mesas WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end ";
$lucro_general_mesas_response = $mysqli->query($sql_lucro_general_mesas)->fetch_assoc();
$lucro_general_mesas = floatval($lucro_general_mesas_response['lucro_vendas']);

$response = array(
    'vendas' => $sales_general_balcao + $sales_general_mesas,
    'receita' => $valor_general_balcao + $valor_general_mesas,
    'lucro' => $lucro_general_balcao + $lucro_general_mesas
);

header('Content-Type: application/json');
echo json_encode($response);