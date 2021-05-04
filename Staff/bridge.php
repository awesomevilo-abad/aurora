<?php
    include_once 'class.php';
    $crudcontroller = new CrudController();
    switch($_POST["type"]) {
    
        case "single":
            
            if(isset($_POST["id"])) {
                $result = $crudcontroller->readSingle($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["Acid"] = $result[0]["Acid"];
                    $responseArray["AcName"] = $result[0]["AcName"];
                    $responseArray["Position"] = $result[0]["Position"];
                    $responseArray["Department"] = $result[0]["Department"];
                    $responseArray["Username"] = $result[0]["Username"];
                    $responseArray["Password"] = $result[0]["Password"];
                    echo json_encode($responseArray);
                }
            }
         break;

        case "all":
            $result = $crudcontroller->readData();
            require_once "MasterStaffTable.php";
            break;
            
         default:
            break;

         case "main":
             $result = $crudcontroller->readData();
             require_once "MasterStaffTable.php";
             break;
             break;
            

        case "updateBuilding":
            if (isset($_POST["id"])) {
                $result = $crudcontroller->edit($_POST);
                header("Location: ../EquipmentStaff.php");
            }
        break;

        case "delete":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->delete($_POST["id"]);
                header("Location: ../StaffManagement.php");
            }

        break;

        case "remove":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->remove($_POST["id"]);
                // header("Location: ../StaffManagement.php");
            }

        break;
    }

    

?>