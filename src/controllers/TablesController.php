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

if (isset($_POST['view-products-of-tables'])) {

}
