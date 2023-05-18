<?php
require_once '../models/Tables.php';

use models\Tables;

$tables = new Tables();

if (isset($_POST['add'])) {
    return $tables->postAddTables($_POST);
}

if (isset($_POST['add-products-of-tables'])) {
    return $tables->postAddProductOfTables($_POST);
}

if (isset($_POST['put_quant_tables'])) {
    return $tables->putQuantityTables($_POST);
}

if (isset($_POST['delete-product-added'])) {
    return $tables->deleteProductAddedTable($_POST);
}
