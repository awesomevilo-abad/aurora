<?php

include_once 'Class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();

$pid = $_POST['pid'];
    $table = $crudcontroller->loadTagImage($pid);
    if (! empty($table)) {
    foreach ($table as $k => $v) {
        $imagename=$table[$k]['imagename']
       ?> 
       <img src='uploaded/<?php echo $imagename ?>' style="border-radius:10px;box-shadow: 2px 1px #666;height:50px; width:50px;margin:10px;">
       <?php
    }
}
?>