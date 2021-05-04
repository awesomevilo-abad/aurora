<?php
	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();
     $Datetoday = $crudcontroller->getDate();
     $fid=$_POST['fid'];
    // $Datetoday=$_POST['date'];
     $type=$_POST['typeImg'];
        
  
                
                // echo "<div style='float:right;border:1px solid #e63f1b;background-color:#ff7152;border-radius:10px;width:50px;color:#ffffff;text-align:center;cursor:pointer;' onclick='DeleteImagePoints(".$_POST['fid'].");'>RESET</div>";
                $stmtshowImage = $conn->prepare("SELECT * FROM image_points where Fid = :fid and Date = :datechecked");
                $stmtshowImage->execute(array(":fid"=>$fid,":datechecked"=>$Datetoday));
                while($rowstmtshowImage = $stmtshowImage->fetch(PDO::FETCH_ASSOC)){
                $imagename=$rowstmtshowImage['imagename'];

              
              
                echo "<div class='isotope-item document col-sm-6 col-md-4 col-lg-3' style='position:relative;margin:20px'>
                <img src='uploaded/" . $imagename. "' style='margin-top:10px;height:50px;width:50px;'><br> 
                <small>".$imagename."</small>
                
                </div>";
                }
  
          
            

            // end save iamge query
            
          

          
?>