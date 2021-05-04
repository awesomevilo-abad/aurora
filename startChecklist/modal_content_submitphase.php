<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();

    $result = $crudcontroller->showphaseUser($_POST["pid"]);
    foreach ($result as $k => $v) {
    ?>
    <option value="<?php echo $result[$k]['Acid']?>"><?php echo $result[$k]['AcName']?> </option>
    <?php        
    }


?>  
