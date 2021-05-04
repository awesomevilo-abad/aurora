
<?php
include_once 'Class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();
// Image
$CorrectionrecordId =$_POST['CorrectionrecordId'];
$recordId =$_POST['recordId'];
$imagename =$_POST['imagename'];
$correctionDate =$_POST['correctionDate'];

$stmtequip = $conn->prepare("INSERT INTO image_points_correction(Fid,Crid,CorrectionImage,Date_Created)
VALUES(:Fid,:CridImage,:in_image,:Datetoday)");

$stmtequip->bindParam(":Fid", $recordId);
$stmtequip->bindParam(":CridImage", $CorrectionrecordId);
$stmtequip->bindParam(":in_image", $imagename);
$stmtequip->bindParam(":Datetoday", $correctionDate);
$stmtequip->execute();

// echo '<img src="../uploaded/'.$in_image.'" alt="icon" />';

$stmtshowImage = $conn->prepare("SELECT * FROM image_points_correction where Crid = :crid and Date_Created = :datechecked");
$stmtshowImage->bindParam(":crid", $CorrectionrecordId);
$stmtshowImage->bindParam(":datechecked", $correctionDate);
$stmtshowImage->execute();


echo "<div class='isotope-item document col-sm-6 col-md-4 col-lg-3' style='position:relative;margin:20px'>
<img src='uploaded/" . $imagename. "' style='margin-top:10px;height:50px;width:50px;'><br> 
<small>".$imagename."</small>
<button type='button' 
id='viewtagImage' 
onclick='loadTagImageCorrection(".$CorrectionrecordId.",".$recordId.")'
 class='btn-xs btn btn-default'>
 <img src='icons/allimage.png'
  style='height:25px; width:25px;float:right' 
  data-toggle='tooltip'
   title='View All photo'></button>

</div>";
?>