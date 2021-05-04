  <?php
	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();
  $Datetoday = $crudcontroller->getDate();

        if($_FILES['addmoreImg']['name'][0] != ""){
            $imagename = $_FILES['addmoreImg']['name'];
            $imagetmpname = $_FILES['addmoreImg']['tmp_name'];

            // save image query
            for($i=0; $i<count($imagetmpname);$i++){
              if(move_uploaded_file($imagetmpname[$i],"../uploaded/".$imagename[$i])){
              }
            }
  
            $compliance = $_POST['noncompliance'];
            $aid = $_POST['Aid2'];
            $bidimg = $_POST['bidimg2'];
            $pidimg = $_POST['pidimg2'];
            $image =  $_FILES['addmoreImg']['name'];
            $Datetoday = $_POST['Date2'];
        
            $countimage = sizeof($image);
            // echo "<div style='float:right;border:1px solid #e63f1b;background-color:#ff7152;border-radius:10px;width:50px;color:#ffffff;text-align:center;cursor:pointer;' onclick='DeleteImage_visor(".$_POST['Aid'].");'>RESET</div>";
            for($i=0;$i<$countimage;$i++){
              
              $in_image = $image[$i];
        
              // Image
              $stmtequip = $conn->prepare("INSERT INTO image_visor(imagename,type,Aid,Bid,Pid,Date_Checked)
              VALUES(:imagename,:type,:aid,:bid,:pid,:datechecked)");
              
              $stmtequip->bindParam(":imagename", $in_image);
              $stmtequip->bindParam(":type", $compliance);
              $stmtequip->bindParam(":aid", $aid);
              $stmtequip->bindParam(":bid", $bidimg);
              $stmtequip->bindParam(":pid", $pidimg);
              $stmtequip->bindParam(":datechecked", $Datetoday);
              $stmtequip->execute();
              
              // echo '<img src="../uploaded/'.$in_image.'" alt="icon" />';
              
              $stmtshowImage = $conn->prepare("SELECT * FROM image_visor where Aid = :aid and Date_Checked = :datechecked and type='noncompliance'");
              $stmtshowImage->bindParam(":aid", $aid);
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