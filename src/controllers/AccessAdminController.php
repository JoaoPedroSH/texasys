<?php
require_once '../models/AccessAdmin.php';

use models\AccessAdmin;

$access = new AccessAdmin();

if ($_POST['admin_user'] != '' || $_POST['admin_password'] != '') {
    return $access->getAccessAdmin($_POST);
} else {
    header('Location: ../views/all/access_admin.php');
}