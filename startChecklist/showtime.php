<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();
 $dao = new Dao();
 $conn = $dao->openConnection();
 $Datetoday = $crudcontroller->getDate();

     $pid=$_POST['pid'];
   
    //check kung tugma ang   account na input sa database
    $showtime = $conn->prepare("SELECT * FROM checklist_grade where Pid = :pid and Date_Checked = '".$Datetoday."' ORDER BY timestamp ASC");
    $showtime->execute(array(":pid"=> $pid));
    $rowshowtime = $showtime->fetch(PDO::FETCH_ASSOC);
    $time=$rowshowtime['timestamp'];
    if (isset($time)) {
         $starttime = $time;
    }else{
         "No Data";
    }

     //check kung tugma ang   account na input sa database
     $endtime = $conn->prepare("SELECT * FROM checklist_grade where Pid = :pid and Date_Checked = '".$Datetoday."' ORDER BY timestamp DESC");
     $endtime->execute(array(":pid"=> $pid));
     $rowendtime = $endtime->fetch(PDO::FETCH_ASSOC);
     $timeend=$rowendtime['timestamp'];
     if (isset($timeend)) {
          $endtime = $timeend;
     }else{
          "No Data";
     }
   
     $dteStart = new DateTime($starttime); 
     $dteEnd   = new DateTime($endtime); 

    $dteDiff  = $dteStart->diff($dteEnd); 
    echo $dteDiff->format("%H:%I:%S"); 

?>  
