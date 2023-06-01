<?php
require_once '../models/SalesCounter.php';

use models\SalesCounter;

$sales_counter = new SalesCounter();

if (isset($_POST['add-product-sales-counter'])) {
    return $sales_counter->postAddProductOfSalesCounter($_POST);
}

if (isset($_POST['delete-product-added-sales-counter'])) {
    return $sales_counter->deleteProductAddedSalesCounter($_POST);
}

if (isset($_POST['finish-sales-counter'])) {
    return $sales_counter->finishSalesCounter($_POST);
} 

else {
    require_once '../../config/ConnectionDB.php';
    $product_value_query = "SELECT SUM(valor) as total FROM produtos_adicionados_balcao ";
    $product_value_result = $mysqli->query($product_value_query);
    $values = $product_value_result->fetch_assoc();
    $response = array(
        'valor_total' => $values["total"]
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}
