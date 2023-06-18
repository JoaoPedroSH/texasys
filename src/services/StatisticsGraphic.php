<?php
require_once '../../config/ConnectionDB.php';
date_default_timezone_set('America/Belem');
$data_atual = date('Y-m-d');
$timestamp_init = strtotime($data_atual . ' 09:00:00');
$data_seguinte = date('Y-m-d', strtotime($data_atual . ' +1 day'));
$timestamp_end = strtotime($data_seguinte . ' 01:00:00');

$query_balcao = "SELECT * FROM vendas_balcao_cliente WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end";
$result_balcao = $mysqli->query($query_balcao);
$query_mesas = "SELECT * FROM vendas_mesas WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end";
$result_mesas = $mysqli->query($query_mesas);

$timestampT9 = strtotime($data_atual . ' 09:00:00');
$timestampT15 = strtotime($data_atual . ' 15:00:00');
$timestampT23 = strtotime($data_atual . ' 23:00:00');
$timestampT00 = strtotime($data_seguinte . ' 00:00:00');
$timestampT01 = strtotime($data_seguinte . ' 01:00:00');
$TB9 = 0; $TB15 = 0; $TB23 = 0; $TB01 = 0;
$TM9 = 0; $TM15 = 0; $TM23 = 0; $TM01 = 0;

while ($response = $result_balcao->fetch_assoc()) {
    if ($response['carimbo_data_hora'] > $timestampT9 && $response['carimbo_data_hora'] < $timestampT15) {
        $TB15 = $TB15 += $response['valor_geral'];
    }
    if ($response['carimbo_data_hora'] >= $timestampT15 && $response['carimbo_data_hora'] <= $timestampT23) {
        $TB23 = $TB23 += $response['valor_geral'];
    }
    if ($response['carimbo_data_hora'] >= $timestampT23 && $response['carimbo_data_hora'] <= $timestampT01) {
        $TB01 = $TB01 += $response['valor_geral'];
    }
}
while ($response = $result_mesas->fetch_assoc()) {
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

$values_response_counter[] = [$TB9, $TB15, $TB23, $TB01];
$values_response_tables[] = [$TB9, $TB15, $TB23, $TB01];
$sumFunction = function ($balcao, $mesas) {
    return $balcao + $mesas;
};
$result_general = array_map($sumFunction, $values_response_counter, $values_response_tables);

$response_finish = array(
    'sales_grafic_counter' => $values_response_counter,
    'sales_grafic_tables' => $values_response_tables,
    'sales_grafic_general' => $result_general,
    'date_init' => $data_atual,
    'date_end' => $data_seguinte,
);

header('Content-Type: application/json');
echo json_encode($response_finish);
