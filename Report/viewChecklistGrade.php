<?php
    include_once 'class.php';
    $crudcontroller = new CrudController();
    switch($_POST["type"]) {
    
    

        case "all":
            $result = $crudcontroller->viewChecklistGrade();
            require_once "ChooseBuilding.php";
            break;
            
        default:
        

    }

    

?>