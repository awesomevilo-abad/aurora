<?php
include_once 'class.php';
$crudcontroller = new CrudController();

if (isset($_POST["user"])) {
    $result = $crudcontroller->assigningPhaseStaff($_POST);
   print_r($result);

}
?>