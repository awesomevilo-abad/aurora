<?php
    include_once 'class.php';
    $crudcontroller = new CrudController();
    switch($_POST["type"]) {
    
        case "single":
            
            if(isset($_POST["id"])) {
                $result = $crudcontroller->readSingle($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["id"] = $result[0]["id"];
                    $responseArray["Name"] = $result[0]["Name"];
                    $responseArray["Image"] = $result[0]["Image"];
                    $responseArray["Category"] = $result[0]["Category"];
                    $responseArray["Color"] = $result[0]["Color"];
                    $responseArray["Percentage"] = $result[0]["Percentage"];
                    $responseArray["Date Created"] = $result[0]["Date Created"];
                    echo json_encode($responseArray);
                }
            }
         break;

        case "check":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->readSingle($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["Bldgid"] = $result[0]["Bldgid"];
                    $responseArray["Bldgname"] = $result[0]["Bldgname"];
                    echo json_encode($responseArray);
                }
            }
        break;

        case "checkcat":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->readCheckCat($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["Aid"] = $result[0]["Aid"];
                    $responseArray["Aname"] = $result[0]["Aname"];
                    $responseArray["aPic"] = $result[0]["aPic"];
                    echo json_encode($responseArray);
                 }
              }
        break;

        case "all":
            $result = $crudcontroller->readData();
            require_once "MasterBuildingTable.php";
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