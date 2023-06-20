<?php
require_once '../../config/ConnectionDB.php';
date_default_timezone_set('America/Belem');

$agora = time();
$dia_atual = date('Y-m-d', $agora);
$hora_atual = date('H:i:s', $agora);
$timestamp_init = strtotime($dia_atual . ' 09:00:00');
$timestamp_end = strtotime($dia_atual . ' 01:00:00') + (24 * 60 * 60);

if ($agora < $timestamp_init  && $hora_atual < '06:00:00') {
    $dia_anterior = date('Y-m-d', strtotime('-1 day', $agora));

    $timestamp_init = strtotime($dia_anterior . ' 09:00:00');
    $timestamp_end = strtotime($dia_atual . ' 01:00:00');

    $timestampT9 = strtotime($dia_anterior . ' 09:00:00');
    $timestampT15 = strtotime($dia_anterior . ' 15:00:00');
    $timestampT23 = strtotime($dia_anterior . ' 23:00:00');
    $timestampT00 = strtotime($dia_atual . ' 00:00:00');
    $timestampT01 = strtotime($dia_atual . ' 01:00:00');

    $date_init = $dia_anterior;
    $date_end = $dia_atual;
} else {
    $data_atual = date('Y-m-d');
    $data_seguinte = date('Y-m-d', strtotime($data_atual . ' +1 day'));

    $timestamp_init = strtotime($data_atual . ' 09:00:00');
    $timestamp_end = strtotime($data_seguinte . ' 01:00:00');

    $timestampT9 = strtotime($data_atual . ' 09:00:00');
    $timestampT15 = strtotime($data_atual . ' 15:00:00');
    $timestampT23 = strtotime($data_atual . ' 23:00:00');
    $timestampT00 = strtotime($data_seguinte . ' 00:00:00');
    $timestampT01 = strtotime($data_seguinte . ' 01:00:00');

    $date_init = $data_atual;
    $date_end = $data_seguinte;
}

$query_balcao = "SELECT * FROM vendas_balcao_cliente WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end";
$result_balcao = $mysqli->query($query_balcao);
$query_mesas = "SELECT * FROM vendas_mesas WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end";
$result_mesas = $mysqli->query($query_mesas);


$TB9 = 0;
$TB15 = 0;
$TB23 = 0;
$TB01 = 0;
$TM9 = 0;
$TM15 = 0;
$TM23 = 0;
$TM01 = 0;

while ($response_b = $result_balcao->fetch_assoc()) {
    if ($response_b['carimbo_data_hora'] > $timestampT9 && $response_b['carimbo_data_hora'] < $timestampT15) {
        $TB15 = $TB15 += $response_b['valor_geral'];
    }
    if ($response_b['carimbo_data_hora'] >= $timestampT15 && $response_b['carimbo_data_hora'] <= $timestampT23) {
        $TB23 = $TB23 += $response_b['valor_geral'];
    }
    if ($response_b['carimbo_data_hora'] >= $timestampT23 && $response_b['carimbo_data_hora'] <= $timestampT01) {
        $TB01 = $TB01 += $response_b['valor_geral'];
    }
}
while ($response_m = $result_mesas->fetch_assoc()) {
    if ($response_m['carimbo_data_hora'] > $timestampT9 && $response_m['carimbo_data_hora'] < $timestampT15) {
        $TM15 = $TM15 += $response_m['valor'];
    }
    if ($response_m['carimbo_data_hora'] >= $timestampT15 && $response_m['carimbo_data_hora'] <= $timestampT23) {
        $TM23 = $TM23 += $response_m['valor'];
    }
    if ($response_m['carimbo_data_hora'] >= $timestampT23 && $response_m['carimbo_data_hora'] <= $timestampT01) {
        $TM01 = $TM01 += $response_m['valor'];
    }
}

$values_response_counter[] = [$TB9, $TB15, $TB23, $TB01];
$values_response_tables[] = [$TM9, $TM15, $TM23, $TM01];

$response_finish = array(
    'sales_grafic_counter' => $values_response_counter,
    'sales_grafic_tables' => $values_response_tables,
    'date_init' => $date_init,
    'date_end' => $date_end,
);

header('Content-Type: application/json');
echo json_encode($response_finish);
