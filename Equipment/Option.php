<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();

 switch($_POST["category"]) {
    
    case "getBuilding":
        if(!empty($_POST["building"])) {
            
            $result = $crudcontroller->loadFilterPhase($_POST["building"]);
            ?>
            <option value="">Select Phase </option>
            <?php
            foreach ($result as $k => $v) {
            ?>
            <option style="background-color:#777;border-color:#777" value="<?php echo $result[$k]['Pid']?>"><?php echo $result[$k]['PName']?> </option>
            <?php        
            }
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
  
}


?>