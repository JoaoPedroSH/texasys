<?php

require_once '../models/Products.php';

use services\Products;

$products = new Products();


if (isset($_POST['add'])) {
    return $products->postProducts($_POST, $_FILES);    
}   

if (isset($_POST['edit'])) {
    if($_FILES["photo_edit"]["size"] === 0){
        return $products->putProducts($_POST, false);
    } else {
        return $products->putProducts($_POST, $_FILES);
    }
}

if (isset($_POST['delete'])) {
    return $products->deleteProducts($_POST['id']);
}

if (isset($_POST['add-categorie'])) {
    return $products->postCategories($_POST);
}

if (isset($_POST['delete-categorie'])) {
    return $products->deleteCategories($_POST['id']);
}
