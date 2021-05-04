<?php
    include_once 'class.php';
    $crudcontroller = new CrudController();
    switch($_POST["type"]) {
    
        case "single":
            
            if(isset($_POST["id"])) {
                $result = $crudcontroller->readSingle($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["Cid"] = $result[0]["Cid"];
                    $responseArray["Aid"] = $result[0]["Aid"];
                    $responseArray["CName"] = $result[0]["CName"];
                    $responseArray["Sani_One"] = $result[0]["Sani_One"];
                    $responseArray["Sani_Two"] = $result[0]["Sani_Two"];
                    $responseArray["Sani_Three"] = $result[0]["Sani_Three"];
                    $responseArray["Stru_One"] = $result[0]["Stru_One"];
                    $responseArray["Stru_Two"] = $result[0]["Stru_Two"];
                    echo json_encode($responseArray);
                }
            }
         break;

         
        case "changearea":
            
            if(isset($_POST["aid"])) {
                $result = $crudcontroller->changeArea($_POST["aid"]);
                if(!empty($result)) {
                    $responseArray["Bid"] = $result[0]["Bid"];
                    $responseArray["Pid"] = $result[0]["Pid"];
                    $responseArray["PName"] = $result[0]["PName"];
                    $responseArray["Name"] = $result[0]["Name"];
                    echo json_encode($responseArray);
                }
            }
         break;

         case "all":
         $result = $crudcontroller->readData();
         require_once "MasterChecklistTable.php";
         break;
         
     default:
         break;
         
         case "view":
            $result = $crudcontroller->readData();
            require_once "MasterChecklistTableView.php";
            break;
         

         case "filtered":
             $result = $crudcontroller->filteredreadData();
             require_once "MasterChecklistTableFiltered.php";
             break;
            
            

        case "updateBuilding":
            if (isset($_POST["id"])) {
                $result = $crudcontroller->edit($_POST);
                header("Location: ../ChecklistManagement.php");
            }
        break;

        case "delete":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->delete($_POST["id"]);
                header("Location: ../ChecklistManagement.php");
            }

        break;
        
    }

    

?>