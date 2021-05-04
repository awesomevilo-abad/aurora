<?php
    include_once 'class.php';
    $crudcontroller = new CrudController();
    switch($_POST["type"]) {
    
    

        case "all":
            $result = $crudcontroller->viewBuilding();
            require_once "ChooseBuilding.php";
            break;
            
        default:
            break;

        case "checklist":
                $result = $crudcontroller->viewChecklist();
                require_once "mainChecklistContent.php";
                break;

                
        case "checklistvisor":
                $result = $crudcontroller->viewChecklist();
                require_once "mainChecklistContentvisor.php";
                break;

         case "result":
                $result = $crudcontroller->viewChecklist();
                require_once "phaseresultcontent.php";
                break;
                
         case "result2":
                $result = $crudcontroller->viewChecklist();
                require_once "phaseresultcontentEquipment.php";
                break;
                
                    
         case "cat":
         $result = $crudcontroller->viewCat($_POST['id']);
         require_once "ChooseBuilding.php";
         break;

         
         case "cat_visor":
         $result = $crudcontroller->viewCat($_POST['id']);
         require_once "ChooseBuilding_visor.php";
         break;


         case "phase":
            $result = $crudcontroller->viewPhase($_POST['id2']);
            require_once "ChoosePhase.php";
            break;
         
         

    }

    

?>