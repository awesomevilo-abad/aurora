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
  
            $aid = $_POST['Aideq'];
            $eid = $_POST['Eid'];
            $image =  $_FILES['addmoreImg']['name'];
            $cid = "0000";
            $Datetoday = $_POST['Dateeq'];
        
            $countimage = sizeof($image);
            // echo "<div style='float:right;border:1px solid #e63f1b;background-color:#ff7152;border-radius:10px;width:50px;color:#ffffff;text-align:center;cursor:pointer;' onclick='DeleteImage_equip(".$_POST['Eid'].");'>RESET</div>";
            for($i=0;$i<$countimage;$i++){
              
              $in_image = $image[$i];
        
              // Image
              $stmtequip = $conn->prepare("INSERT INTO image(imagename,Aid,Cid,Eid,Date_Checked)
              VALUES(:imagename,:aid,:cid,:eid,:datechecked)");
              
              $stmtequip->bindParam(":imagename", $in_image);
              $stmtequip->bindParam(":aid", $aid);
              $stmtequip->bindParam(":cid", $cid);
              $stmtequip->bindParam(":eid", $eid);
              $stmtequip->bindParam(":datechecked", $Datetoday);
              $stmtequip->execute();
              
              // echo '<img src="../uploaded/'.$in_image.'" alt="icon" />';
              
              $stmtshowImage = $conn->prepare("SELECT * FROM image where Eid = :eid and Date_Checked = :datechecked");
              $stmtshowImage->bindParam(":eid", $eid);
              $stmtshowImage->bindParam(":datechecked", $Datetoday);
              $stmtshowImage->execute();

              
              echo "<div class='isotope-item document col-sm-6 col-md-4 col-lg-3' style='position:relative;margin:20px'>
              <img src='uploaded/" . $in_image. "' style='margin-top:10px;height:50px;width:50px;'><br> 
              <small>".$in_image."</small>
              
              </div>";
           
  
          
            }

            // end save iamge query
            
          }else{
            echo "<label style='color:#ff7152'><strong>No Image Selected</strong> </label>";
          }

          
?>