<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();


 if (isset($_POST["user"])) {
    $result = $crudcontroller->updatePhaseStaff($_POST);
   print_r($result);

}


?>
