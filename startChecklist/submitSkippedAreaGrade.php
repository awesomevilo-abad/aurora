<?php 
    include_once 'class.php';
    $crudcontroller = new CrudController();
    $dao = new Dao();
    $conn = $dao->openConnection();
    $Datetoday = $crudcontroller->getDate();
    

   
        // // kapag last area na siya sa phase add phase completed status
        // // sanitation structural
        $cid = $_POST['cid']; //array
        $Cname = $_POST['cname']; //array
        $sangrade = $_POST['arraySani']; //array
        $strgrade = $_POST['arrayStr'];//array
        $pid = $_POST['pid'];
        $totalsanigrade = $_POST['totalsani']; 
        $totalstrgrade = $_POST['totalstru']; 

        // sanitation structure and equipement common
        $aid = $_POST['aid'];
        $bid = $_POST['bid'];
        $status = "Skipped";

            $count = sizeof($cid);
            for($i=0;$i<$count;$i++){
                $in_cid = $cid[$i];
                $in_cname = $Cname[$i];
                $in_sangrade = $sangrade[$i];
                $in_strgrade = $strgrade[$i];

                $stmt = $conn->prepare("INSERT INTO checklist_grade(Bid,Pid,PidCounter,Aid,Cid,CName,San_Grade,Str_Grade,totalsanigrade,totalstrugrade,status,Date_Checked)
                VALUES(:bid,:pid,:pid,:aid,:cid,:in_cname,:in_sangrade,:in_strgrade,:totalsanigrade,:totalstrgrade,:status,:datechecked)");
                $stmt->bindParam(":bid", $bid);
                $stmt->bindParam(":pid", $pid);
                $stmt->bindParam(":aid", $aid);
                $stmt->bindParam(":cid", $in_cid);
                $stmt->bindParam(":in_cname", $in_cname);
                $stmt->bindParam(":in_sangrade", $in_sangrade);
                $stmt->bindParam(":in_strgrade", $in_strgrade);
                $stmt->bindParam(":totalsanigrade", $totalsanigrade);
                $stmt->bindParam(":totalstrgrade", $totalstrgrade);
                $stmt->bindParam(":status", $status);
                $stmt->bindParam(":datechecked", $Datetoday);
                $stmt->execute();
            }

        // // equipement
        // $eid2 = $_POST['eid2']; //array
        // $ename ="Declined"; //array
        // $estatus = "Phase Completed"; //array
        // $egrade = $_POST['egrade']; //array
        // $eqty =00; //array
        // $totalequip = $_POST['totalegrade']; //array

        // $countequip = sizeof($eid2);
        // for($i=0;$i<$countequip;$i++){
        //     $in_eid2 = $eid2[$i];
        //     $in_aid2 = $aid[$i];
        //     $in_egrade = $egrade[$i];

        //     // equipement
        //     $stmtequip = $conn->prepare("INSERT INTO equipment_grade(eid,aid,eqty,egrade,totalequipgrade,Name,statusequip,Date_Checked)
        //     VALUES(:eid,:aid,:eqty,:egrade,:totalequipgrade,:Name,:statusequip,:datecheckedeq)");
            
        //     $stmtequip->bindParam(":eid", $in_eid2);
        //     $stmtequip->bindParam(":aid", $in_aid2);
        //     $stmtequip->bindParam(":eqty", $eqty);
        //     $stmtequip->bindParam(":egrade", $in_egrade);
        //     $stmtequip->bindParam(":totalequipgrade", $totalequip);
        //     $stmtequip->bindParam(":Name", $ename);
        //     $stmtequip->bindParam(":statusequip", $estatus);
        //     $stmtequip->bindParam(":datecheckedeq", $Datetoday);
        //     $stmtequip->execute();
        // }
           
          
  


   echo "Skipped Area"

    
?>