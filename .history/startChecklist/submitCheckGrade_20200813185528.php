<?php 
    include_once 'class.php';
    $crudcontroller = new CrudController();
    $dao = new Dao();
    $conn = $dao->openConnection();
    $Datetoday = $crudcontroller->getDate();
    $Datetodayminusfive = date('Y-m-d', strtotime($Datetoday. ' - 4 days'));

    $gradesheader = $conn->prepare("SELECT Aid FROM checklist_grade WHERE Pid = :Pid AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday') GROUP BY Aid DESC ");
    $gradesheader->execute(array(":Pid"=> $_POST['pid']));
    while($rowgradesheader = $gradesheader->fetch(PDO::FETCH_ASSOC)){

        $allareaAid[] = $rowgradesheader['Aid'];
    }

    $gradesheader = $conn->prepare("SELECT Aid FROM area WHERE Pid = :Pid ");
    $gradesheader->execute(array(":Pid"=> $_POST['pid']));
    while($rowgradesheader = $gradesheader->fetch(PDO::FETCH_ASSOC)){

        $allareaAid[] = $rowgradesheader['Aid'];
    }
    
    if(isset($allareaAid)){

    }else{
        $allareaAid = [];
    }
    
    function weekOfMonth($qDate) {
        $dt = strtotime($qDate);
        $day  = date('j',$dt);
        $month = date('m',$dt);
        $year = date('Y',$dt);
        $totalDays = date('t',$dt);
        $weekCnt = 1;
        $retWeek = 0;
        for($i=1;$i<=$totalDays;$i++) {
            $curDay = date("N", mktime(0,0,0,$month,$i,$year));
            if($curDay==7) {
                if($i==$day) {
                    $retWeek = $weekCnt+1;
                }
                $weekCnt++;
            } else {
                if($i==$day) {
                    $retWeek = $weekCnt;
                }
            }
        }
        return $retWeek;
    }
    $weeknoinmonth = $_POST['week'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    
    print_r($allareaAid);
    echo $_POST['aid'];

    if(in_array($_POST['aid'], $allareaAid)){

        // $cid = $_POST['cid']; //array
        // $Cname = $_POST['checkname']; //array
        // $sangrade = $_POST['arraySani']; //array
        // $strgrade = $_POST['arraystr'];//array
        // $strdesc = $_POST['arraydesc'];//array
        // $remarks = $_POST['remarks']; //array
        // $pid = $_POST['pid'];
        // $totalsanigrade = $_POST['totalsani']; 
        // $totalstrgrade = $_POST['totalstru']; 

        // // sanitation structure and equipement common
        // $aid = $_POST['aid'];
        // $bid = $_POST['bid'];
        // $status = "Phase Completed";
        

        


        // $count = sizeof($cid);
        // for($i=0;$i<$count;$i++){
        //     $in_cid = $cid[$i];
        //     $in_cname = $Cname[$i];
        //     $in_sangrade = $sangrade[$i];
        //     $in_strgrade = $strgrade[$i];
        //     $in_strdesc = $strdesc[$i];
        //     $in_remarks = $remarks[$i];


        //     $stmt = $conn->prepare("INSERT INTO checklist_grade(Bid,Pid,PidCounter,Aid,Cid,CName,San_Grade,Str_Desc,Str_Grade,totalsanigrade,totalstrugrade,remarks,status,Date_Checked,week,month,year)
        //     VALUES(:bid,:pid,:pid,:aid,:cid,:in_cname,:in_sangrade,:in_strdesc,:in_strgrade,:totalsanigrade,:totalstrgrade,:in_remarks,:status,:datechecked,:week,:month,:year)");
        //     $stmt->bindParam(":bid", $bid);
        //     $stmt->bindParam(":pid", $pid);
        //     $stmt->bindParam(":aid", $aid);
        //     $stmt->bindParam(":cid", $in_cid);
        //     $stmt->bindParam(":in_cname", $in_cname);
        //     $stmt->bindParam(":in_sangrade", $in_sangrade);
        //     $stmt->bindParam(":in_strgrade", $in_strgrade);
        //     $stmt->bindParam(":in_strdesc", $in_strdesc);
        //     $stmt->bindParam(":totalsanigrade", $totalsanigrade);
        //     $stmt->bindParam(":totalstrgrade", $totalstrgrade);
        //     $stmt->bindParam(":in_remarks", $in_remarks);
        //     $stmt->bindParam(":status", $status);
        //     $stmt->bindParam(":datechecked", $Datetoday);
        //     $stmt->bindParam(":week", $weeknoinmonth);
        //     $stmt->bindParam(":month", $month);
        //     $stmt->bindParam(":year", $year);
        //     $stmt->execute();
        // }



        
        
        // if(isset($_POST['eid2'])){
        //     // equipement
        //     $eid2 = $_POST['eid2']; //array
        //     $ename = $_POST['ename']; //array
        //     $egrade = $_POST['egrade']; //array
        //     $edesc = $_POST['edesc']; //array
        //     $eqty = $_POST['eqty']; //array
        //     $remarksequip = $_POST['remarksequip']; //array
        //     // $imageequip = $_POST['imageequip']; //array
        //     $totalequip = $_POST['totalequip']; //array
    
        //     $countequip = sizeof($eid2);
        //     for($i=0;$i<$countequip;$i++){
        //         $in_eid2 = $eid2[$i];
        //         $in_ename = $ename[$i];
        //         $in_edesc = $edesc[$i];
        //         $in_egrade = $egrade[$i];
        //         $in_remarksequip = $remarksequip[$i];
        //         // $in_imageequip = $imageequip[$i];
    
        //         // equipement
        //         $stmtequip = $conn->prepare("INSERT INTO equipment_grade(eid,bid,pid,aid,edesc,eqty,egrade,totalequipgrade,Name,remarksequip,statusequip,Date_Checked_equipment,week,month,year)
        //         VALUES(:eid,:bid,:pid,:aid,:edesc,:eqty,:egrade,:totalequipgrade,:Name,:remarksequip,:statusequip,:datechecked,:week,:month,:year)");
        //         $stmtequip->bindParam(":bid", $bid);
        //         $stmtequip->bindParam(":pid", $pid);
        //         $stmtequip->bindParam(":eid", $in_eid2);
        //         $stmtequip->bindParam(":aid", $aid);
        //         $stmtequip->bindParam(":edesc", $in_edesc);
        //         $stmtequip->bindParam(":eqty", $eqty);
        //         $stmtequip->bindParam(":egrade", $in_egrade);
        //         $stmtequip->bindParam(":totalequipgrade", $totalequip);
        //         $stmtequip->bindParam(":Name", $in_ename);
        //         $stmtequip->bindParam(":remarksequip", $in_remarksequip);
        //         // $stmtequip->bindParam(":imageequip", $in_imageequip);
        //         $stmtequip->bindParam(":statusequip", $status);
        //         $stmtequip->bindParam(":datechecked", $Datetoday);
        //         $stmtequip->bindParam(":week", $weeknoinmonth);
        //         $stmtequip->bindParam(":month", $month);
        //         $stmtequip->bindParam(":year", $year);
        //         $stmtequip->execute();
        //     }
        //         }else{
            
        //     }
          
    }else{
        // // sanitation structural
        //     $cid = $_POST['cid']; //array
        //     $Cname = $_POST['checkname']; //array
        //     $sangrade = $_POST['arraySani']; //array
        //     $strgrade = $_POST['arraystr'];//array
        //     $strdesc = $_POST['arraydesc'];//array
        //     $remarks = $_POST['remarks']; //array
        //     $pid = $_POST['pid'];
        //     $totalsanigrade = $_POST['totalsani']; 
        //     $totalstrgrade = $_POST['totalstru']; 

        //     // sanitation structure and equipement common
        //     $aid = $_POST['aid'];
        //     $bid = $_POST['bid'];
        //     $status = "Phase On Going";

            


        //     $count = sizeof($cid);
        //     for($i=0;$i<$count;$i++){
        //         $in_cid = $cid[$i];
        //         $in_cname = $Cname[$i];
        //         $in_sangrade = $sangrade[$i];
        //         $in_strgrade = $strgrade[$i];
        //         $in_strdesc = $strdesc[$i];
        //         $in_remarks = $remarks[$i];  


        //         $stmt = $conn->prepare("INSERT INTO checklist_grade(Bid,Pid,PidCounter,Aid,Cid,CName,San_Grade,Str_Desc,Str_Grade,totalsanigrade,totalstrugrade,remarks,status,Date_Checked,week,month,year)
        //         VALUES(:bid,:pid,:pid,:aid,:cid,:in_cname,:in_sangrade,:in_strdesc,:in_strgrade,:totalsanigrade,:totalstrgrade,:in_remarks,:status,:datechecked,:week,:month,:year)");
        //         $stmt->bindParam(":bid", $bid);
        //         $stmt->bindParam(":pid", $pid);
        //         $stmt->bindParam(":aid", $aid);
        //         $stmt->bindParam(":cid", $in_cid);
        //         $stmt->bindParam(":in_cname", $in_cname);
        //         $stmt->bindParam(":in_sangrade", $in_sangrade);
        //         $stmt->bindParam(":in_strdesc", $in_strdesc);
        //         $stmt->bindParam(":in_strgrade", $in_strgrade);
        //         $stmt->bindParam(":totalsanigrade", $totalsanigrade);
        //         $stmt->bindParam(":totalstrgrade", $totalstrgrade);
        //         $stmt->bindParam(":in_remarks", $in_remarks);
        //         $stmt->bindParam(":status", $status);
        //         $stmt->bindParam(":datechecked", $Datetoday);
        //         $stmt->bindParam(":week", $weeknoinmonth);
        //         $stmt->bindParam(":month", $month);
        //         $stmt->bindParam(":year", $year);
        //         $stmt->execute();
        //     }

        //     if(isset($_POST['eid2'])){
        // // equipement
        // $eid2 = $_POST['eid2']; //array
        // $ename = $_POST['ename']; //array
        // $egrade = $_POST['egrade']; //array
        // $eqty = $_POST['eqty']; //array
        // $edesc = $_POST['edesc']; //array
        // $remarksequip = $_POST['remarksequip']; //array
        // // $imageequip = $_POST['imageequip']; //array
        // $totalequip = $_POST['totalequip']; //array
        
        // $countequip = sizeof($eid2);
        // for($i=0;$i<$countequip;$i++){
        //     $in_eid2 = $eid2[$i];
        //     $in_ename = $ename[$i];
        //     $in_egrade = $egrade[$i];
        //     $in_edesc = $edesc[$i];
        //     $in_remarksequip = $remarksequip[$i];
        //     // $in_imageequip = $imageequip[$i];

        //     // equipement
        //     $stmtequip = $conn->prepare("INSERT INTO equipment_grade(eid,bid,pid,aid,eqty,edesc,egrade,totalequipgrade,Name,remarksequip,statusequip,Date_Checked_equipment,week,month,year)
        //     VALUES(:eid,:bid,:pid,:aid,:eqty,:edesc,:egrade,:totalequipgrade,:Name,:remarksequip,:statusequip,:datechecked,:week,:month,:year)");
        //     $stmtequip->bindParam(":bid", $bid);
        //     $stmtequip->bindParam(":pid", $pid);
        //     $stmtequip->bindParam(":eid", $in_eid2);
        //     $stmtequip->bindParam(":aid", $aid);
        //     $stmtequip->bindParam(":edesc", $in_edesc);
        //     $stmtequip->bindParam(":eqty", $eqty);
        //     $stmtequip->bindParam(":egrade", $in_egrade);
        //     $stmtequip->bindParam(":totalequipgrade", $totalequip);
        //     $stmtequip->bindParam(":Name", $in_ename);
        //     $stmtequip->bindParam(":remarksequip", $in_remarksequip);
        //     // $stmtequip->bindParam(":imageequip", $in_imageequip);
        //     $stmtequip->bindParam(":statusequip", $status);
        //     $stmtequip->bindParam(":datechecked", $Datetoday);
        //     $stmtequip->bindParam(":week", $weeknoinmonth);
        //     $stmtequip->bindParam(":month", $month);
        //     $stmtequip->bindParam(":year", $year);
        //     $stmtequip->execute();
        // }
        //     }else{
            
        //     }
    }


   
 

    // //kunin ang last area id from checklist grade(updated record ng mga na submit na checklist per area )
    // $gradesheader = $conn->prepare("SELECT * FROM checklist_grade WHERE Pid=:Pid  AND Date_Checked = :datetoday ORDER BY Aid DESC ");
    // $gradesheader->execute(array(":Pid"=> $pid,":datetoday"=> $Datetoday));
    // $rowgradesheader = $gradesheader->fetch(PDO::FETCH_ASSOC);
    //  //if para malaman kkung may laman na ang checklist doon sa area na iyon

    //     if($gradesheader->rowCount() > 0){
    //         // echo $rowgradesheader['Aid'];
    //         //KUNG MAY LAMAN ANG CHECKLIST GRADE, IPAGBANGA ANG AREA AT CHECKLIST
    //         $showArea = $conn->prepare("SELECT Aid FROM area WHERE Aid NOT IN (SELECT Aid FROM checklist_grade WHERE Pid=:Pid  AND Date_Checked = :datetoday) and Pid = :Pid ORDER BY Aid DESC");
    //         $showArea->execute(array(":datetoday"=> $Datetoday, ":Pid" => $pid));
    //         $rowareaheader = $showArea->fetch(PDO::FETCH_ASSOC);
           
    //         if($rowareaheader['Aid'] == ""){
    //             echo "Next Phase";
    //         }else{
    //             echo "Next Area";
    //         }
            
    //     }
    //     else{
    //       echo "error";
            
    //     }


    
?>