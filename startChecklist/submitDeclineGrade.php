<?php 
    include_once 'class.php';
    $crudcontroller = new CrudController();
    $dao = new Dao();
    $conn = $dao->openConnection();
    $Datetoday = $crudcontroller->getDate();
    
    // function weekOfMonth($qDate) {
    //     $dt = strtotime($qDate);
    //     $day  = date('j',$dt);
    //     $month = date('m',$dt);
    //     $year = date('Y',$dt);
    //     $totalDays = date('t',$dt);
    //     $weekCnt = 1;
    //     $retWeek = 0;
    //     for($i=1;$i<=$totalDays;$i++) {
    //         $curDay = date("N", mktime(0,0,0,$month,$i,$year));
    //         if($curDay==7) {
    //             if($i==$day) {
    //                 $retWeek = $weekCnt+1;
    //             }
    //             $weekCnt++;
    //         } else {
    //             if($i==$day) {
    //                 $retWeek = $weekCnt;
    //             }
    //         }
    //     }
    //     return $retWeek;
    // }
    // $weeknoinmonth = weekOfMonth($Datetoday);
    $weeknoinmonth = $_POST['week'];
    $month = $_POST['month'];
    $year = $_POST['year'];

   
        // // kapag last area na siya sa phase add phase completed status
        // // sanitation structural
        $cid = $_POST['cid']; //array
        $Cname = $_POST['cname']; //array
        $sangrade = $_POST['arraySani']; //array
        $strgrade = $_POST['arrayStr'];//array
        $pid = $_POST['pid'];
        $totalsanigrade = $_POST['totalsani']; 
        $totalstrgrade = $_POST['totalstr']; 

        // sanitation structure and equipement common
        $aid = $_POST['aid'];
        $bid = $_POST['bid'];
        $status = "Phase Completed";

            $count = sizeof($cid);
            for($i=0;$i<$count;$i++){
                $in_aid = $aid[$i];
                $in_cid = $cid[$i];
                $in_cname = $Cname[$i];
                $in_sangrade = $sangrade[$i];
                $in_strgrade = $strgrade[$i];

                $stmt = $conn->prepare("INSERT INTO checklist_grade
                (Bid,Pid,PidCounter,Aid,Cid,CName,San_Grade,Str_Grade,totalsanigrade,totalstrugrade,status,Date_Checked,week,month,year)
                VALUES(:bid,:pid,:pid,:aid,:cid,:in_cname,:in_sangrade,:in_strgrade,:totalsanigrade,:totalstrgrade,:status,:datechecked,:week,:month,:year)");
                $stmt->bindParam(":bid", $bid);
                $stmt->bindParam(":pid", $pid);
                $stmt->bindParam(":aid", $in_aid);
                $stmt->bindParam(":cid", $in_cid);
                $stmt->bindParam(":in_cname", $in_cname);
                $stmt->bindParam(":in_sangrade", $in_sangrade);
                $stmt->bindParam(":in_strgrade", $in_sangrade);
                $stmt->bindParam(":totalsanigrade", $totalsanigrade);
                $stmt->bindParam(":totalstrgrade", $totalsanigrade);
                $stmt->bindParam(":status", $status);
                $stmt->bindParam(":datechecked", $Datetoday);
                $stmt->bindParam(":week", $weeknoinmonth);
                $stmt->bindParam(":month", $month);
                $stmt->bindParam(":year", $year);
                $stmt->execute();
            }

        // equipement
        // print_r($eaid2 = $_POST['eaid']); //array
        $ename ="Declined"; //array
        $estatus = "Phase Completed"; //array
    //    print_r($egrade = $_POST['egrade2e']); //array
       if(isset($_POST['egrade2e'])){
        $egrade = $_POST['egrade2e']; //array
       }else{
         $egrade = 0000; //array
       }
        
       if(isset($_POST['eaid'])){
        $eaid2 = $_POST['eaid']; //array
       }else{
         $eaid2[] = 0000; //array
       }
        

       $eqty =00; //array
       $eid =0000; //array
        $totalequip = $_POST['totalegrade']; //array

        $countequip = sizeof($eaid2);
        for($i=0;$i<$countequip;$i++){
            $in_eaid2 = $eaid2[$i];
            $in_egrade = $egrade[$i];

            // equipement
          
            $stmtequip = $conn->prepare("INSERT INTO equipment_grade(eid,bid,pid,aid,eqty,egrade,totalequipgrade,Name,statusequip,Date_Checked_equipment,week,month,year)
            VALUES(:eid,:bid,:pid,:aid,:eqty,:egrade,:totalequipgrade,:Name,:statusequip,:datecheckedeq,:week,:month,:year)");
            $stmtequip->bindParam(":bid", $bid);
            $stmtequip->bindParam(":pid", $pid);
            $stmtequip->bindParam(":eid", $eid);
            $stmtequip->bindParam(":aid", $in_eaid2);
            $stmtequip->bindParam(":eqty", $eqty);
            $stmtequip->bindParam(":egrade", $in_egrade);
            $stmtequip->bindParam(":totalequipgrade", $totalequip);
            $stmtequip->bindParam(":Name", $ename);
            $stmtequip->bindParam(":statusequip", $estatus);
            $stmtequip->bindParam(":datecheckedeq", $Datetoday);
            $stmtequip->bindParam(":week", $weeknoinmonth);
            $stmtequip->bindParam(":month", $month);
            $stmtequip->bindParam(":year", $year);
            $stmtequip->execute();
            
        }
           
          
  


   echo "Decline Grade added to database"

    
?>