<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();


 if (isset($_POST["user"])) {
    $result = $crudcontroller->removeAreaStaff($_POST);
   print_r($result);

}


?>
