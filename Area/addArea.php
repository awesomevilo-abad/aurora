<?php
include_once 'class.php';
$crudcontroller = new CrudController();

if (isset($_POST["Name"])) {
   if(empty($_POST['Name'])|| empty($_POST['percentage'])){
       echo "incomplete";

   }else  if($result = $crudcontroller->add($_POST)){
    echo "success";
    
   }
   else{
       echo "error";
   }
   

}
?>