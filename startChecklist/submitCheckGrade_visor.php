<?php 
    include_once 'class.php';
    $crudcontroller = new CrudController();
    $dao = new Dao();
    $conn = $dao->openConnection();
    $Datetoday = $crudcontroller->getDate();

   
        // sanitation structural
        $aid = $_POST['aid']; //array
        $remarks = $_POST['remarks']; //array
        $pid = $_POST['pid'];

        // sanitation structure and equipement common
        $bid = $_POST['bid'];
        $status = "Phase Completed";
        

        


        $count = sizeof($aid);
        for($i=0;$i<$count;$i++){
            $in_aid = $aid[$i];
            $in_remarks = $remarks[$i];


            $stmt = $conn->prepare("INSERT INTO checklist_grade_visor(Bid,Pid,Aid,remarks,status,Date_Checked)
            VALUES(:bid,:pid,:aid,:in_remarks,:status,:datechecked)");
            $stmt->bindParam(":bid", $bid);
            $stmt->bindParam(":pid", $pid);
            $stmt->bindParam(":aid", $in_aid);
            $stmt->bindParam(":in_remarks", $in_remarks);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":datechecked", $Datetoday);
            $stmt->execute();
        }
          
      
          echo "Next Phase";
      


    
?>