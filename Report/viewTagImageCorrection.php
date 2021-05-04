<?php

include_once 'Class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();

$rid = $_POST['rid'];
    $table = $crudcontroller->loadTagImageCorrection($rid);
    if (! empty($table)) {
    foreach ($table as $k => $v) {
        $imagename=$table[$k]['CorrectionImage']
       ?> 
       <img src='uploaded/<?php echo $imagename ?>' style="border-radius:10px;box-shadow: 2px 1px #666;height:50; width:50;margin:10px;">
       <?php
    }
}
?>