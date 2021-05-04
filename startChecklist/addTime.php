<?php 
    include_once 'class.php';
    $crudcontroller = new CrudController();
    $dao = new Dao();
    $conn = $dao->openConnection();
    $Datetoday = $crudcontroller->getDate();
    
        $phaseid = $_POST['pid'];
        $qastafftime = $_POST['qastafftime']; 
        $datetoday = $_POST['datetoday'];
        $qastaff = $_POST['qastaff'];
     
        $stmt = $conn->prepare("INSERT INTO qaduration
        (qastaff,qatime,pid,date_checked_qa)
        VALUES(:qastaff,:qatime,:pid,:date_checked_qa)");
        $stmt->bindParam(":qastaff", $qastaff);
        $stmt->bindParam(":qatime", $qastafftime);
        $stmt->bindParam(":pid", $phaseid);
        $stmt->bindParam(":date_checked_qa", $datetoday);
        $stmt->execute();

   echo "Added to QA Time Duration per Audit";

    
?>