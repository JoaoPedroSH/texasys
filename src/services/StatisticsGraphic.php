<?php
require_once '../../config/ConnectionDB.php';
header('Content-Type: application/json');
date_default_timezone_set('America/Belem');
$data_atual = date('Y-m-d');
$timestamp_init = strtotime($data_atual . ' 09:00:00');

$data_seguinte = date('Y-m-d', strtotime($data_atual . ' +1 day'));
$timestamp_end = strtotime($data_seguinte . ' 01:00:00');

$query = "SELECT * FROM vendas_balcao_cliente WHERE carimbo_data_hora > $timestamp_init AND carimbo_data_hora < $timestamp_end";
$result = $mysqli->query($query);

$values_response = array();
while ($response = $result->fetch_assoc()) {

    $timestampT9 = strtotime($data_atual . ' 09:00:00');
    $timestampT10 = strtotime($data_atual . ' 10:00:00');
    $timestampT11 = strtotime($data_atual . ' 11:00:00');
    $timestampT12 = strtotime($data_atual . ' 12:00:00');
    $timestampT13 = strtotime($data_atual . ' 13:00:00');
    $timestampT14 = strtotime($data_atual . ' 14:00:00');
    $timestampT15 = strtotime($data_atual . ' 15:00:00');
    $timestampT16 = strtotime($data_atual . ' 16:00:00');
    $timestampT17 = strtotime($data_atual . ' 17:00:00');
    $timestampT18 = strtotime($data_atual . ' 18:00:00');
    $timestampT19 = strtotime($data_atual . ' 19:00:00');
    $timestampT20 = strtotime($data_atual . ' 20:00:00');
    $timestampT21 = strtotime($data_atual . ' 21:00:00');
    $timestampT22 = strtotime($data_atual . ' 22:00:00');
    $timestampT23 = strtotime($data_atual . ' 23:00:00');
    $timestampT00 = strtotime($data_seguinte . ' 00:00:00');
    $timestampT01 = strtotime($data_seguinte . ' 01:00:00');
    $timestampT01_3 = strtotime($data_seguinte . ' 01:30:00');

    if ($response['carimbo_data_hora'] > $timestampT9 && $response['carimbo_data_hora'] < $timestampT10) {
        
    }
    if ($response['carimbo_data_hora'] >= $timestampT10 && $response['carimbo_data_hora'] <= $timestampT11) {

    }
    if ($response['carimbo_data_hora'] >= $timestampT11 && $response['carimbo_data_hora'] <= $timestampT12) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT12 && $response['carimbo_data_hora'] <= $timestampT13) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT13 && $response['carimbo_data_hora'] <= $timestampT14) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT14 && $response['carimbo_data_hora'] <= $timestampT15) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT15 && $response['carimbo_data_hora'] <= $timestampT16) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT16 && $response['carimbo_data_hora'] <= $timestampT17) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT17 && $response['carimbo_data_hora'] <= $timestampT18) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT18 && $response['carimbo_data_hora'] <= $timestampT19) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT19 && $response['carimbo_data_hora'] <= $timestampT20) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT20 && $response['carimbo_data_hora'] <= $timestampT21) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT21 && $response['carimbo_data_hora'] <= $timestampT22) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT22 && $response['carimbo_data_hora'] <= $timestampT23) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT23 && $response['carimbo_data_hora'] <= $timestampT00) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT00 && $response['carimbo_data_hora'] <= $timestampT01) {
        # code...
    }
    if ($response['carimbo_data_hora'] >= $timestampT01 && $response['carimbo_data_hora'] <= $timestampT01_3) {
        # code...
    }
$T9 = 30;
    $values_response[] = [$T9, $T10, $T11, $T12, $T13, $T14, $T15, $T16, $T17, $T18, $T19, $T20, $T21, $T22, $T23, $T00, $T01];
}

$response_finish = array(
    'sales_counter' => $values_response,
    'date_init' => $data_atual,
    'date_end' => $data_seguinte,
);

header('Content-Type: application/json');
echo json_encode($response_finish);
