<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();

    $result = $crudcontroller->changeArea($_POST['aid']);
  ?>
  <?php
    foreach ($result as $k => $v) {
 
    echo $result[$k]['Pid'];
       
    }
?>  
