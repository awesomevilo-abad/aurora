<?php
    include_once 'class.php';
    $crudcontroller = new CrudController();
    switch($_POST["type"]) {
    
        case "single":
            
            if(isset($_POST["id"])) {
                $result = $crudcontroller->readSingle($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["Aid"] = $result[0]["Aid"];
                    $responseArray["Pid"] = $result[0]["Pid"];
                    $responseArray["AName"] = $result[0]["AName"];
                    $responseArray["Image"] = $result[0]["Image"];
                    $responseArray["Percentage"] = $result[0]["Percentage"];
                    $responseArray["percentageequip"] = $result[0]["percentageequip"];
                    echo json_encode($responseArray);
                }
            }
         break;

        case "all":
            $result = $crudcontroller->readData();
            require_once "MasterAreaTable.php";
            break;
            
        default:
            break;
            

        case "updateBuilding":
            if (isset($_POST["id"])) {
                $result = $crudcontroller->edit($_POST);
                header("Location: ../BuildingManagement.php");
            }
        break;

        case "delete":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->delete($_POST["id"]);
                header("Location: ../BuildingManagement.php");
            }

        break;
    }

    

?>