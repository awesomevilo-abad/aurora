<?php
    include_once 'class.php';
    $crudcontroller = new CrudController();
    switch($_POST["type"]) {
    
        case "single":
            
            if(isset($_POST["id"])) {
                $result = $crudcontroller->readSingle($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["Pid"] = $result[0]["Pid"];
                    $responseArray["PidCounter"] = $result[0]["PidCounter"];
                    $responseArray["Bid"] = $result[0]["Bid"];
                    $responseArray["PName"] = $result[0]["PName"];
                    $responseArray["Image"] = $result[0]["Image"];
                    $responseArray["Percentage"] = $result[0]["Percentage"];
                    echo json_encode($responseArray);
                }
            }
         break;

        case "all":
            $result = $crudcontroller->readData();
            require_once "MasterPhaseTable.php";
            break;
            
        default:
            break;
            

        case "delete":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->delete($_POST["id"]);
                header("Location: ../BuildingManagement.php");
            }

        break;
    }

    

?>