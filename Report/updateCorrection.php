<?php

include_once 'class.php';
$crudcontroller = new CrudController();


if ($_POST["Correction"]!="") {

    $result = $crudcontroller->editCorrection($_POST);
    // header("Location: ../createRecord.php");
}else{
    echo "Enter Phase";
}

?>