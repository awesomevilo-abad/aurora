<?php

include_once 'class.php';
$crudcontroller = new CrudController();


if ($_POST["GBPoints"]!="") {

    $result = $crudcontroller->editRemarks($_POST);
    header("Location: ../createRecord.php");
}else{
    echo "Enter Phase";
}

?>