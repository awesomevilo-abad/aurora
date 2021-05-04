<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();
 $dao = new Dao();
 $conn = $dao->openConnection();

 switch($_POST["category"]) {
    
    case "getBuilding":
        if(!empty($_POST["building"])) {
            
            $result = $crudcontroller->loadFilterPhase($_POST["building"]);
            ?>
            <option value="">Select Phase </option>
            <?php
            foreach ($result as $k => $v) {
            ?>
            <optgroup class="form-control" label="<?php echo $result[$k]['Name']?>">
                <option style="background-color:#777;border-color:#777" value="<?php echo $result[$k]['Pid']?>"><?php echo $result[$k]['PName']?> </option>
            </optgroup>
            <?php        
            }
        }
     break; 

     case "getBuildingfromPhase":
         if(!empty($_POST["phase"])) {
             
             $result = $crudcontroller->loadGetBuildingFromPhase($_POST["phase"]);
             foreach ($result as $k => $v) {
            $Bid= $result[$k]['Bid'];
            $BuildingDetails = $conn->prepare("SELECT * FROM Building where id = :bid ORDER BY id ASC");
            $BuildingDetails->execute(array(":bid"=>$Bid));
            $rowBuildingDetails = $BuildingDetails->fetch(PDO::FETCH_ASSOC);
            // echo $Name=$rowBuildingDetails['Name'];
            echo $id=$rowBuildingDetails['id'];
             }
            //  require_once "createRecord.php";
        
         }
      break;

    case "getPhase":
        if(!empty($_POST["phase"])) {
     
            $result = $crudcontroller->loadFilterArea($_POST["phase"]);
            ?>
            <option value="">Select Area </option>
            <?php
            foreach ($result as $k => $v) {
            ?>
            <option style="background-color:#777;border-color:#777" value="<?php echo $result[$k]['Aid']?>"><?php echo $result[$k]['AName']?> </option>
            <?php        
            }
        }
        break;
        
    case "getDate":
        if(!empty($_POST["date"])) {
    
            $result = $crudcontroller->loadFilterBuilding($_POST["date"]);
            ?>
            <option value="">Select Building </option>
            <?php
            foreach ($result as $k => $v) {
            ?>
            <option style="background-color:#777;border-color:#777" value="<?php echo $result[$k]['Bid']?>"><?php echo $result[$k]['Name']?> </option>
            <?php        
            }
        }
        break;
        
    case "dropdownBuilding":
    
            $result = $crudcontroller->loaddropdownBuilding($_POST["date"]);
            ?>
            <option value="">Select</option>
            <?php
            foreach ($result as $k => $v) {
            ?>
            <option style="background-color:#777;border-color:#777" value="<?php echo $result[$k]['Bid']?>"><?php echo $result[$k]['Name']?> </option>
            <?php        
            }
       
        break;
  
}


?>