<?php
    include_once 'class.php';
    $crudcontroller = new CrudController();
    switch($_POST["type"]) {
    
        case "single":
            
            if(isset($_POST["id"])) {
                $result = $crudcontroller->readSingle($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["Eid"] = $result[0]["Eid"];
                    $responseArray["Aid"] = $result[0]["Aid"];
                    $responseArray["EName"] = $result[0]["EName"];
                    $responseArray["Asset_Tag"] = $result[0]["Asset_Tag"];
                    $responseArray["Asset_Number"] = $result[0]["Asset_Number"];
                    $responseArray["status"] = $result[0]["status"];
                    echo json_encode($responseArray);
                }
            }
         break;

        case "all":
            $result = $crudcontroller->readData();
            require_once "MasterEquipmentTable.php";
            break;
            
        default:
            break;
            
         case "view":
            $result = $crudcontroller->readData();
            require_once "MasterEquipmentTableView.php";
            break;
         

        case "updateBuilding":
            if (isset($_POST["id"])) {
                $result = $crudcontroller->edit($_POST);
                header("Location: ../EquipmentManagement.php");
            }
        break;

        case "delete":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->delete($_POST["id"]);
                header("Location: ../EquipmentManagement.php");
            }

        break;
        
         case "filtered":
             $result = $crudcontroller->filteredreadData();
             require_once "MasterEquipmentTableFiltered.php";
             break;
            
            
    }

    

?>