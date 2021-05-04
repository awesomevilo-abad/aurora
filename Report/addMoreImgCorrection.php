  <?php
	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();
  $Datetoday = $crudcontroller->getDate();

          if($_FILES['addmoreImg']!=""){
            $imagename = $_FILES['addmoreImg']['name'];
            $imagetmpname = $_FILES['addmoreImg']['tmp_name'];

            // save image query
            for($i=0; $i<count($imagetmpname);$i++){
              if(move_uploaded_file($imagetmpname[$i],"../uploaded/".$imagename[$i])){
              }
            }

            $CridImage = $_POST['CridImage'];
            $FidImageCorrection = $_POST['FidImageCorrection'];
            $image =  $_FILES['addmoreImg']['name'];
            // $Datetoday = $_POST['DateImage'];
        
            $countimage = sizeof($image);
            $CridImage = $_POST['CridImage'];
            echo "<div style='float:right;border:1px solid #e63f1b;background-color:#ff7152;border-radius:10px;width:50px;color:#ffffff;text-align:center;cursor:pointer;' onclick='DeleteImageCorrection(".$CridImage.");'>RESET</div>";
            for($i=0;$i<$countimage;$i++){
              
              $in_image = $image[$i];
        
              // Image
              $stmtequip = $conn->prepare("INSERT INTO image_points_correction(Fid,Crid,CorrectionImage,Date_Created)
              VALUES(:Fid,:CridImage,:in_image,:Datetoday)");
              
              $stmtequip->bindParam(":Fid", $FidImageCorrection);
              $stmtequip->bindParam(":CridImage", $CridImage);
              $stmtequip->bindParam(":in_image", $in_image);
              $stmtequip->bindParam(":Datetoday", $Datetoday);
              $stmtequip->execute();
              
              // echo '<img src="../uploaded/'.$in_image.'" alt="icon" />';
              
              $stmtshowImage = $conn->prepare("SELECT * FROM image_points_correction where Crid = :CridImage and Date_Created = :datechecked");
              $stmtshowImage->bindParam(":CridImage", $CridImage);
              $stmtshowImage->bindParam(":datechecked", $Datetoday);
              $stmtshowImage->execute();

              
              echo "<div class='isotope-item document col-sm-6 col-md-4 col-lg-3' style='position:relative;margin:20px'>
              <img src='uploaded/" . $in_image. "' style='margin-top:10px;height:50px;width:50px;'><br> 
              
              </div>";
           
  
          
            }

            // end save iamge query
            
          }else{
            echo "<label style='color:#ff7152'><strong>No Image Selected</strong> </label>";
          }

          
?>