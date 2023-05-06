<?php
require '../services/GeneratePdf.php';

if (isset($_POST['print'])) {
    return PrintBillTable($_POST);    
}
