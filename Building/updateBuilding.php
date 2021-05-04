<?php

include_once 'class.php';
$crudcontroller = new CrudController();


if (isset($_POST["buildingname"])) {
    $result = $crudcontroller->edit($_POST);
    header("Location: ../BuildingManagement.php");
}

?>