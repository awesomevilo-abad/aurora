<?php
	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();
    // echo $Datetoday = $crudcontroller->getDate();
    $Crid=$_POST['rid'];
    $Datetoday=$_POST['date'];
        
  
                
                // echo "<div style='float:right;border:1px solid #e63f1b;background-color:#ff7152;border-radius:10px;width:50px;color:#ffffff;text-align:center;cursor:pointer;' onclick='DeleteImageCorrection(".$_POST['rid'].");'>RESET</div>";
                $stmtshowImage = $conn->prepare("SELECT * FROM image_points_correction where Crid = :Crid and Date_Created = :datechecked");
                $stmtshowImage->execute(array(":Crid"=>$Crid,":datechecked"=>$Datetoday));
                while($rowstmtshowImage = $stmtshowImage->fetch(PDO::FETCH_ASSOC)){
                $imagename=$rowstmtshowImage['CorrectionImage'];

              
              
                echo "<div class='isotope-item document col-sm-6 col-md-4 col-lg-3' style='position:relative;margin:20px'>
                <img src='uploaded/" . $imagename. "' style='margin-top:10px;height:50px;width:50px;'><br> 
                
                </div>";
                }
  
          
            

            // end save iamge query
            
          

          
?>