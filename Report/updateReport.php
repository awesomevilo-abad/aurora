<?php

include_once 'class.php';
$crudcontroller = new CrudController();


if ($_POST["Bid"]=="") {

    $result = $crudcontroller->edit($_POST);
    header("Location: ../createRecord.php");
}else{
    echo "Enter Phase";
}

?>