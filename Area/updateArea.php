<?php

include_once 'class.php';
$crudcontroller = new CrudController();


if (isset($_POST["Name"])) {

    $result = $crudcontroller->edit($_POST);
    header("Location: ../AreaManagement.php");
}

?>