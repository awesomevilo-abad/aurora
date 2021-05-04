<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();

    $result = $crudcontroller->loadFilterBuilding();
    ?>
    <option value="All">All Building</option>
    <?php
    foreach ($result as $k => $v) {
    ?>
    <option onclick="loadCheckFilterPhase('<?php echo $result[$k]['id']?>')" value="<?php echo $result[$k]['id']?>"><?php echo $result[$k]['Name']?> </option>
    <?php        
    }


?>  
