<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();

    $result = $crudcontroller->filterArea_reports($_POST['phase']);
  ?>
    <option value=""> </option>
  <?php
    foreach ($result as $k => $v) {
    ?>
   <optgroup label="<?php echo $result[$k]['PName']?>">
        <option value="<?php echo $result[$k]['Aid']?>"><?php echo $result[$k]['AName']?></option>
    </optgroup>	
    <?php        
    }


?>  
