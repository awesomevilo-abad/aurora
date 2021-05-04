
<?php
include_once 'Class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();
// Image
$recordId =$_POST['recordId'];
$imagename =$_POST['imagename'];
$pid =$_POST['pid'];
$tagImageDate =$_POST['tagImageDate'];
$type =$_POST['type'];

$stmtequip = $conn->prepare("INSERT INTO image_points(Fid,Pid,imagename,type,Date)
VALUES(:fidperoRecordIdValue,:pid,:imagename,:type,:datechecked)");

$stmtequip->bindParam(":fidperoRecordIdValue", $recordId);
$stmtequip->bindParam(":pid", $pid);
$stmtequip->bindParam(":type", $type);
$stmtequip->bindParam(":imagename", $imagename);
$stmtequip->bindParam(":datechecked", $tagImageDate);
$stmtequip->execute();

// echo '<img src="../uploaded/'.$in_image.'" alt="icon" />';

$stmtshowImage = $conn->prepare("SELECT * FROM image_points where Fid = :fid and Date = :datechecked");
$stmtshowImage->bindParam(":fid", $recordId);
$stmtshowImage->bindParam(":datechecked", $tagImageDate);
$stmtshowImage->execute();


echo "<div class='isotope-item document col-sm-6 col-md-4 col-lg-3' style='position:relative;margin:20px'>
<img src='uploaded/" . $imagename. "' style='margin-top:10px;height:50px;width:50px;'><br> 
<small>".$imagename."</small>
<button type='button' 
id='viewtagImage' 
onclick='loadTagImage(".$recordId.",".$pid.")'
 class='btn-xs btn btn-default'>
 <img src='icons/allimage.png'
  style='height:25px; width:25px;float:right' 
  data-toggle='tooltip'
   title='View All photo'></button>

</div>";
?>