<?php
	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();
    // echo $Datetoday = $crudcontroller->getDate();
    $cid=$_POST['cid'];
    $Datetoday=$_POST['date'];
        
  
                
                // echo "<div style='float:right;border:1px solid #e63f1b;background-color:#ff7152;border-radius:10px;width:50px;color:#ffffff;text-align:center;cursor:pointer;' onclick='DeleteImage(".$_POST['cid'].");'>RESET</div>";
                $stmtshowImage = $conn->prepare("SELECT * FROM image where Cid = :cid and Date_Checked = :datechecked");
                $stmtshowImage->execute(array(":cid"=>$cid,":datechecked"=>$Datetoday));
                while($rowstmtshowImage = $stmtshowImage->fetch(PDO::FETCH_ASSOC)){
                $imagename=$rowstmtshowImage['imagename'];

              
              
                echo "<div class='isotope-item document col-sm-6 col-md-4 col-lg-3' style='position:relative;margin:20px'>
                <img src='uploaded/" . $imagename. "' style='margin-top:10px;height:50px;width:50px;'><br> 
                <small>".$imagename."</small>
                
                </div>";
                }
  
          
            

            // end save iamge query
            
          

          
?>