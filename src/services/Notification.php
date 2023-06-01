<?php
require_once '../../config/ConnectionDB.php';

$product_notification_query = "SELECT * FROM produtos WHERE quantidade > -1 AND quantidade < 10";
$product_notification_result = $mysqli->query($product_notification_query);
$num_notification = $product_notification_result->num_rows;

$response = array(
    'notification' => $product_notification_result->fetch_all(MYSQLI_ASSOC),
    'quant' => $num_notification
);

header('Content-Type: application/json');
echo json_encode($response);
