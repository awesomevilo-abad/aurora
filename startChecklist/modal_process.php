<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();
 
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


    $user=$_POST['user'];
    $bldgid=$_POST['bldgid'];
    $pass=$_POST['pass'];
    $phase=$_POST['phseid'];
    $datechecked=$_POST['datechecked'];
    // $month = date("F",strtotime($datechecked));      
    // $year = date("Y",strtotime($datechecked));    
    $datereset=$_POST['datechecked'];
    $qastaff=$_POST['qastaff'];
    $totalsani=$_POST['totalsani'];
    $totalstru=$_POST['totalstru'];
    $totalequip=$_POST['totalequip'];
    
   
    if(isset($_POST['targetgradestatus_sani'])){
        $targetgradestatus_sani=$_POST['targetgradestatus_sani'];
    }else{
        $targetgradestatus_sani="Needs Improvement";
    }

    if(isset($_POST['targetgradestatus_str'])){
        $targetgradestatus_str=$_POST['targetgradestatus_str'];
    }else{
        $targetgradestatus_str="Needs Improvement";
    }

    if(isset($_POST['targetgradestatus_equip'])){
        $targetgradestatus_equip=$_POST['targetgradestatus_equip'];
    }else{
        $targetgradestatus_equip="Needs Improvement";
    }

    if(isset($_POST['reason'])){
        $reason=$_POST['reason'];
    }else{
        $reason="No Reason";
    }
    $weeknoinMonth=$_POST['week'];
    $month=$_POST['month'];
    $year=$_POST['year'];
    // $weeknoinMonth=weekOfMonth($datechecked);
    
    $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
    //check kung tugma ang account na input sa database
    $sql = "SELECT * FROM accounts where Acid = :user and Password =:pass";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":user"=>$user, ":pass"=>$pass));
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
     
    echo "Verified";

        $staff = $pdo->prepare("INSERT INTO timedatephase (Bid,qastaff,protect,protect_sani_grade,protect_stru_grade,protect_equip_grade,week,month,year,declineReason,targetGrade_status_sani,targetGrade_status_str,targetGrade_status_equip,date_checked,date_reset,pid) 
        VALUES(:bid,:qastaff,:protect,:protect_sani_grade,:protect_stru_grade,:protect_equip_grade,:week,:month,:year,:declineReason,:targetsani,:targetstr,:targeteq,:date_checked,:date_reset,:pid)");
        $staff->bindParam(":bid", $bldgid);
        $staff->bindParam(":qastaff", $qastaff);
        $staff->bindParam(":protect", $user);
        $staff->bindParam(":protect_sani_grade", $totalsani);
        $staff->bindParam(":protect_stru_grade", $totalstru);
        $staff->bindParam(":protect_equip_grade", $totalequip);
        $staff->bindParam(":week", $weeknoinMonth);
        $staff->bindParam(":month", $month);
        $staff->bindParam(":year", $year);
        $staff->bindParam(":targetsani", $targetgradestatus_sani);
        $staff->bindParam(":targetstr", $targetgradestatus_str);
        $staff->bindParam(":targeteq", $targetgradestatus_equip);
        $staff->bindParam(":declineReason", $reason);
        $staff->bindParam(":date_checked", $datechecked);
        $staff->bindParam(":date_reset", $datereset);
        $staff->bindParam(":pid", $phase);
        $staff->execute();


    }else{
        echo "Incorrect Password";
    }
   
?>  
