<?php

require '../../config/ConnectionDB.php';
$calendario = $_POST['calendario'];
$turno = $_POST['turno'];

$status = true;

header('Content-Type: application/json');
$response = array('status' => $status);
echo json_encode($response);
