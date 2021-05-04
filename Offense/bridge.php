<?php
    include_once 'class.php';
    $crudcontroller = new CrudController();
    switch($_POST["type"]) {
    

    case "viewEquipmentOffense":
         $result = $crudcontroller->viewEquipmentOffense($_POST['year'],$_POST['month'],$_POST['week'],$_POST['offense']);
         require_once "TableEquipmentOffense.php";
         
         break;
         
     default:
   
     case "viewOffenseStructural":
        $result = $crudcontroller->viewOffenseStructural($_POST['year'],$_POST['month'],$_POST['week'],$_POST['offense']);
        require_once "TableStructuralOffense.php";
     
     break;

     case "viewOffenseSanitation":
        $result = $crudcontroller->viewOffenseSanitation($_POST['year'],$_POST['month'],$_POST['week'],$_POST['offense']);
        require_once "TableSanitationOffense.php";
     
     break;
     
        
    }

    

?>