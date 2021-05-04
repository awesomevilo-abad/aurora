<?php
include_once 'class.php';
$crudcontroller = new CrudController();

if (isset($_POST["buildingname"])) {
   if(empty($_POST['buildingname'])|| empty($_POST['percentage'])){
       echo "incomplete";

   }else  if($result = $crudcontroller->add($_POST)){
    echo "success";
    
   }
   else{
       echo "error";
   }
   

}
?>