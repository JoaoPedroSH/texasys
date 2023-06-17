<?php
require_once '../../config/ConnectionDB.php';
date_default_timezone_set('America/Belem');
$data_atual = date('Y-m-d');
$timestamp_init = strtotime($data_atual . ' 09:00:00');

$data_seguinte = date('Y-m-d', strtotime($data_atual . ' +1 day'));
$timestamp_end = strtotime($data_seguinte . ' 01:00:00');

$query = "SELECT * FROM vendas_balcao_cliente WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end";
$result = $mysqli->query($query);

$T9 = 0; $T15 = 0; $T23 = 0; $T01 = 0;

$values_response = array();
while ($response = $result->fetch_assoc()) {

    $timestampT9 = strtotime($data_atual . ' 09:00:00');
    $timestampT15 = strtotime($data_atual . ' 15:00:00');
    $timestampT23 = strtotime($data_atual . ' 23:00:00');
    $timestampT00 = strtotime($data_seguinte . ' 00:00:00');
    $timestampT01 = strtotime($data_seguinte . ' 01:00:00');
    $timestampT01_3 = strtotime($data_seguinte . ' 01:30:00');

    if ($response['carimbo_data_hora'] > $timestampT9 && $response['carimbo_data_hora'] < $timestampT15) {
        $T15 = $T15 += $response['valor_geral'];
    }
    if ($response['carimbo_data_hora'] >= $timestampT15 && $response['carimbo_data_hora'] <= $timestampT23) {
        $T23 = $T23 += $response['valor_geral'];
    }
    if ($response['carimbo_data_hora'] >= $timestampT23 && $response['carimbo_data_hora'] <= $timestampT01) {
        $T01 = $T01 += $response['valor_geral'];
    }
}

$values_response_counter[] = [$T9, $T15, $T23, $T01];

$response_finish = array(
    'sales_grafic_counter' => $values_response_counter,
    'date_init' => $data_atual,
    'date_end' => $data_seguinte,
);

header('Content-Type: application/json');
echo json_encode($response_finish);
