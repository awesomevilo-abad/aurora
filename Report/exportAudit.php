<?php  
      //export.php  
  
 if(isset($_POST["export"]))  
 {  
    
    $DB_host = "localhost";
    $DB_user = "root";
    $DB_pass = "";
    $DB_name = "aurora";

    try
    {
        $db_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "ERROR : ".$e->getMessage();
    }
    
    $building= $_POST['building_viewscores'];
    $phase= $_POST['phase'];
    $date= $_POST['date'];
    $start_auditreport = date('Y-m-d',strtotime($_POST['start_auditreport']));
    $end_auditreport= date('Y-m-d',strtotime($_POST['end_auditreport']));


    if($building != "" and $phase !="" and $start_auditreport =="" and $end_auditreport ==""){
        $stmt=$db_con->prepare("SELECT checklist_grade.Date_Checked,phase.PName,area.AName,area.Percentage,checklist_grade.totalsanigrade,checklist_grade.totalstrugrade, equipment_grade.totalequipgrade,timedatephase.qastaff,Accounts.AcName FROM checklist_grade 
        left join area on checklist_grade.Aid = area.Aid 
        left join phase on checklist_grade.Pid = phase.Pid 
        left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
        left join accounts on timedatephase.protect = accounts.Acid
        left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
        left join building on checklist_grade.Bid = building.id 
        where Accounts.AcName != '' and  checklist_grade.Pid LIKE '".$phase."'
        Group By checklist_grade.Aid, checklist_grade.Date_checked
        ORDER BY checklist_grade.Aid ASC ");
       
        
    }else if($building != "" and $phase !="" and $start_auditreport !="" and $end_auditreport !="" ){

        $stmt=$db_con->prepare("SELECT checklist_grade.Date_Checked,phase.PName,area.AName,area.Percentage,checklist_grade.totalsanigrade,checklist_grade.totalstrugrade, equipment_grade.totalequipgrade,timedatephase.qastaff,Accounts.AcName FROM checklist_grade 
         left join area on checklist_grade.Aid = area.Aid 
        left join phase on checklist_grade.Pid = phase.Pid 
        left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
        left join accounts on timedatephase.protect = accounts.Acid
        left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
        left join building on checklist_grade.Bid = building.id 
        where Accounts.AcName != '' and  checklist_grade.Pid LIKE '".$phase."' AND checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."'
        Group By checklist_grade.Aid, checklist_grade.Date_checked
        ORDER BY checklist_grade.Aid ASC");
       
    }
      $stmt->execute();

      $columnHeader = "Date Auditted"."\t"."Phase"."\t"."Area"."\t"."Distribution"."\t"."Sanitation"."\t"."Structural"."\t"."Equipment"."\t"."QA Staff"."\t"."Protech";
      $setData='';

      while($rec =$stmt->FETCH(PDO::FETCH_ASSOC))
      {
        $rowData = '';
        foreach($rec as $value)
        {
          $value = '"' . $value . '"' . "\t";   
          $rowData .= $value;
        }
        $setData .= trim($rowData)."\n";
      }

      header("Content-type: application/octet-stream");
      header("Content-Disposition: attachment; filename=AuditReport_".$building."_".basename($date).".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      
      echo ucwords($columnHeader)."\n".$setData."\n";

    //   $query = "SELECT building.Name,phase.PName,area.AName,timedatephase.qastaff,Accounts.AcName FROM checklist_grade 
    //   left join area on checklist_grade.Aid = area.Aid 
    //   left join phase on checklist_grade.Pid = phase.Pid 
    //   left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
    //   left join accounts on timedatephase.protect = accounts.Acid
    //   left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
    //   left join building on checklist_grade.Bid = building.id ";  
    //   $result = mysqli_query($connect, $query);  
    //   while($row = mysqli_fetch_assoc($result))  
    //   {  
    //        fputcsv($output, $row);  
    //   }  
    //   fclose($output);  
 }  
 ?>  