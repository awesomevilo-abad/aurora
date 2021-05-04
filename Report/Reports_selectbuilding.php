<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();

    $result = $crudcontroller->filterPhase_reports($_POST['building']);
  ?>
  <option value="">Select Phase </option>
  <?php
    foreach ($result as $k => $v) {
    ?>
   <optgroup label="<?php echo $result[$k]['Name']?>">
        <option value="<?php echo $result[$k]['Pid']?>"><?php echo $result[$k]['PName']?></option>
    </optgroup>	
    <?php        
    }
?>  
