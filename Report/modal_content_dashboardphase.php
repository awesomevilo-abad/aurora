<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();

    $result = $crudcontroller->loadFilterDashPhase();
    foreach ($result as $k => $v) {
    ?>
    <option  value="<?php echo $result[$k]['Pid']?>"><?php echo $result[$k]['PName']?> </option>
    <?php        
    }


?>  
