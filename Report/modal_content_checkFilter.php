<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();

 ?>
 <option >Select Building</option>
 <?php    
    $result = $crudcontroller->loadFilterBuilding();
    foreach ($result as $k => $v) {
    ?>
    <option  value="<?php echo $result[$k]['id']?>"><?php echo $result[$k]['Name']?> </option>
    <?php        
    }


?>  
