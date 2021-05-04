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
    
    $phase= $_POST['Report_phase_checklist'];
    $phaseeq= $_POST['Report_phase_equip'];
    $date= $_POST['date2'];
    $area= "";
    $start_auditreport = date('Y-m-d',strtotime($_POST['start_auditreport_checklist']));
    $end_auditreport= date('Y-m-d',strtotime($_POST['end_auditreport_checklist']));
    $type= $_POST['Report_type'];
   

    if($type == 'sanitation'){
      if($phase != "" and $area =="" and $start_auditreport !="" and $end_auditreport !=""){

            $stmt=$db_con->prepare("SELECT checklist_grade.Date_Checked,phase.PName,area.AName,
            checklist_grade.CName,checklist_grade.San_Grade,checklist_grade.remarks
            ,timedatephase.targetGrade_status_sani,timedatephase.qastaff
            ,accounts.AcName FROM checklist_grade 
            left join area on checklist_grade.Aid = area.Aid 
            left join phase on checklist_grade.Pid = phase.Pid 
            left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
            left join accounts on timedatephase.protect = accounts.Acid
            left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
            left join building on checklist_grade.Bid = building.id 
            left join checklist on checklist_grade.Aid = checklist.Aid
            WHERE checklist_grade.Pid ='".$phase."' and checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."'
            Group By checklist_grade.Cid,checklist_grade.Date_Checked
            ORDER BY area.Aid ASC");
        
        }
        $stmt->execute();

        $columnHeader = "Date Auditted"."\t"."Phase"."\t"."Area"."\t"."Checklist"."\t"."Sanitation Grade"."\t"."Sanitation Remarks"."\t"."Status"."\t"."QA Staff"."\t"."Protech";
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
        header("Content-Disposition: attachment; filename=SanitationGrade".$phase."_".basename($date).".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        echo ucwords($columnHeader)."\n".$setData."\n";
    }
    else if($type == 'structural'){
       if($phase != "" and $area =="" and $start_auditreport !="" and $end_auditreport !=""){

            $stmt=$db_con->prepare("SELECT checklist_grade.Date_Checked,phase.PName,area.AName,
            checklist_grade.CName,checklist_grade.Str_Grade,checklist_grade.remarks
            ,timedatephase.targetGrade_status_str,timedatephase.qastaff
            ,accounts.AcName FROM checklist_grade 
            left join area on checklist_grade.Aid = area.Aid 
            left join phase on checklist_grade.Pid = phase.Pid 
            left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
            left join accounts on timedatephase.protect = accounts.Acid
            left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
            left join building on checklist_grade.Bid = building.id 
            left join checklist on checklist_grade.Aid = checklist.Aid
            WHERE checklist_grade.Pid ='".$phase."' and checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."'
            Group By checklist_grade.Cid,checklist_grade.Date_Checked
            ORDER BY area.Aid ASC");
        
        }
        $stmt->execute();

        $columnHeader = "Date Auditted"."\t"."Phase"."\t"."Area"."\t"."Checklist"."\t"."Structural Grade"."\t"."Structural Remarks"."\t"."Status"."\t"."QA Staff"."\t"."Protech";
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
        header("Content-Disposition: attachment; filename=StructuralGrade".$phase."_".basename($date).".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        echo ucwords($columnHeader)."\n".$setData."\n";
    }
    else if($type == 'sanitationremarks'){
        if($phase != "" and $area =="" and $start_auditreport !="" and $end_auditreport !=""){
 
             $stmt=$db_con->prepare("SELECT checklist_grade.Date_Checked,phase.PName,area.AName,
             checklist_grade.CName,checklist_grade.San_Grade,checklist.Sani_One,checklist.Sani_Two,checklist_grade.remarks
             ,timedatephase.targetGrade_status_sani,timedatephase.qastaff
             ,accounts.AcName FROM checklist_grade 
             left join area on checklist_grade.Aid = area.Aid 
             left join phase on checklist_grade.Pid = phase.Pid 
             left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
             left join accounts on timedatephase.protect = accounts.Acid
             left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
             left join building on checklist_grade.Bid = building.id 
             left join checklist on checklist_grade.Aid = checklist.Aid
             WHERE checklist_grade.Pid ='".$phase."' and checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."'
             Group By checklist_grade.Cid,checklist_grade.Date_Checked
             ORDER BY area.Aid ASC");
         
         }
         $stmt->execute();
 
         $columnHeader = "Date Auditted"."\t"."Phase"."\t"."Area"."\t"."Checklist"."\t"."Sanitation Remarks Grade"."\t"."Guidelines 50"."\t"."Guidelines 75"."\t"."Sanitation Remarks"."\t"."Status"."\t"."QA Staff"."\t"."Protech";
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
         header("Content-Disposition: attachment; filename=SanitationRemarks".$phase."_".basename($date).".xls");
         header("Pragma: no-cache");
         header("Expires: 0");
         
         echo ucwords($columnHeader)."\n".$setData."\n";
     }
      
    else if($type == 'firstoffensestr'){
        if($phase != "" and $area =="" and $start_auditreport !="" and $end_auditreport !=""){
 
             $stmt=$db_con->prepare("SELECT checklist_grade.Date_Checked,phase.PName,area.AName,
             checklist_grade.CName,checklist_grade.Str_Grade,checklist.Stru_Two,checklist_grade.remarks
             ,timedatephase.targetGrade_status_sani,timedatephase.qastaff
             ,accounts.AcName FROM checklist_grade 
             left join area on checklist_grade.Aid = area.Aid 
             left join phase on checklist_grade.Pid = phase.Pid 
             left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
             left join accounts on timedatephase.protect = accounts.Acid
             left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
             left join building on checklist_grade.Bid = building.id 
             left join checklist on checklist_grade.Aid = checklist.Aid
             WHERE checklist_grade.Pid ='".$phase."' and checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."' and checklist_grade.Str_Grade = 75
             Group By checklist_grade.Cid,checklist_grade.Date_Checked
             ORDER BY area.Aid ASC");
         
         }
         $stmt->execute();
 
         $columnHeader = "Date Auditted"."\t"."Phase"."\t"."Area"."\t"."Checklist"."\t"."Structural Grade"."\t"."Guidelines 75"."\t"."Structural1stOffense Remarks"."\t"."Status"."\t"."QA Staff"."\t"."Protech";
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
         header("Content-Disposition: attachment; filename=Structural1stOffense".$phase."_".basename($date).".xls");
         header("Pragma: no-cache");
         header("Expires: 0");
         
         echo ucwords($columnHeader)."\n".$setData."\n";
     }
    else if($type == 'equipment'){
        if($phaseeq != "" and $area =="" and $start_auditreport !="" and $end_auditreport !=""){
 
            $stmt=$db_con->prepare("SELECT equipment_grade.Date_Checked_equipment,
             phase.PName,Area.AName,
             equipment_grade.Name,equipment.Asset_Number,equipment_grade.egrade,equipment_grade.remarksequip
             ,timedatephase.targetGrade_status_equip
             ,timedatephase.qastaff,accounts.AcName
             FROM equipment_grade 
             left join area on equipment_grade.aid = area.Aid
            left join phase on area.Pid = phase.Pid
            left join timedatephase on area.Pid = timedatephase.Pid and equipment_grade.Date_Checked_equipment = timedatephase.Date_Checked 
            left join accounts on timedatephase.protect = accounts.Acid
            left join equipment on equipment_grade.eid = equipment.Eid
            WHERE area.Pid = '".$phaseeq."' and equipment_grade.Name != 'No Equipment' and equipment_grade.Date_Checked_equipment >='".$start_auditreport."' and equipment_grade.Date_Checked_equipment <='".$end_auditreport."' 
            Group By equipment_grade.eid, equipment_grade.Date_Checked_equipment
            ORDER BY area.Aid,equipment_grade.Date_Checked_equipment DESC");
        
        }
        $stmt->execute();

        $columnHeader = "Date Auditted"."\t"."Phase"."\t"."Area"."\t"."Equipment"."\t"."#"."\t"."Equipment Grade"."\t"."Equipment Remarks"."\t"."Status"."\t"."QA Staff"."\t"."Protech";
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
        header("Content-Disposition: attachment; filename=EquipmentGrade".$phase."_".basename($date).".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        echo ucwords($columnHeader)."\n".$setData."\n";
     }  

     else if($type == 'firstoffense'){
        if($phaseeq != "" and $area =="" and $start_auditreport !="" and $end_auditreport !=""){
 
            $stmt=$db_con->prepare("SELECT equipment_grade.Date_Checked_equipment,
             phase.PName,Area.AName,
             equipment_grade.Name,equipment_grade.egrade,equipment_grade.remarksequip
             ,timedatephase.targetGrade_status_equip
             ,timedatephase.qastaff,accounts.AcName
             FROM equipment_grade 
             left join area on equipment_grade.aid = area.Aid
            left join phase on area.Pid = phase.Pid
            left join timedatephase on area.Pid = timedatephase.Pid and equipment_grade.Date_Checked_equipment = timedatephase.Date_Checked 
            left join accounts on timedatephase.protect = accounts.Acid
            WHERE equipment_grade.egrade=75 and area.Pid = '".$phaseeq."' and equipment_grade.Name != 'No Equipment' and equipment_grade.Date_Checked_equipment >='".$start_auditreport."' and equipment_grade.Date_Checked_equipment <='".$end_auditreport."' 
            Group By equipment_grade.eid, equipment_grade.Date_Checked_equipment
            ORDER BY area.Aid,equipment_grade.Date_Checked_equipment ASC");
        
        }
        $stmt->execute();

        $columnHeader = "Date Auditted"."\t"."Phase"."\t"."Area"."\t"."Equipment"."\t"."Equipment Grade"."\t"."Equipment Remarks"."\t"."Status"."\t"."QA Staff"."\t"."Protech";
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
        header("Content-Disposition: attachment; filename=EquipmentGrade".$phase."_".basename($date).".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        echo ucwords($columnHeader)."\n".$setData."\n";
     }  

        

 }  
 ?>  