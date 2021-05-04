<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();

    $result = $crudcontroller->loadFilterDate_visor();
    ?>
    <option value="">Select Date</option>
    <?php
    foreach ($result as $k => $v) {
    ?>
    <option  value="<?php echo $result[$k]['Date_Checked']?>"><?php echo $result[$k]['Date_Checked']?> </option>
    <?php        
    }


?>  
