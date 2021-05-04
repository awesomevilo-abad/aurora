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
    //   $connect = mysqli_connect("localhost", "root", "", "aurora");  
    //   header("Content-type: application/octet-stream");
    //   header("Content-Disposition: attachment; filename=Book record sheet.xls");
    //   $output = fopen("php://output", "w");  
    //   fputcsv($output, array('Building', 'Phase', 'Area', 'QA Staff', 'Protech'));  
    
    $building =$_POST['Building'];
    $phase =$_POST['Phase'];
    $date =$_POST['Date'];
    if(isset($_POST['Area'])){
      $area =$_POST['Area'];
    }else{
      $area = "";
    }


      if($date != "" and $building != "" and $phase !="" and $area !=""){
        $stmt=$db_con->prepare("SELECT building.Name,phase.PName,area.AName,timedatephase.qastaff,Accounts.AcName,checklist_grade.totalsanigrade,checklist_grade.totalstrugrade, checklist_grade.CName,checklist_grade.San_grade,checklist_grade.Str_Grade,checklist_grade.remarks,checklist_grade.Date_Checked FROM checklist_grade 
        left join area on checklist_grade.Aid = area.Aid 
        left join phase on checklist_grade.Pid = phase.Pid 
        left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
        left join accounts on timedatephase.protect = accounts.Acid
        left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
        left join building on checklist_grade.Bid = building.id 
        where Accounts.AcName != ' 'and checklist_grade.Date_Checked LIKE '".$date."' AND checklist_grade.Bid LIKE  '".$building."' AND checklist_grade.Pid LIKE '".$phase."' AND checklist_grade.Aid LIKE '".$area."'
        Group By checklist_grade.Aid, checklist_grade.Date_checked
        ORDER BY checklist_grade.Aid ASC");
       
        
      }else if($date != "" and $building != "" and $phase !="" and $area ="Select Area"){

        $stmt=$db_con->prepare("SELECT building.Name,phase.PName,area.AName,timedatephase.qastaff,Accounts.AcName,checklist_grade.totalsanigrade,checklist_grade.totalstrugrade, checklist_grade.CName,checklist_grade.San_grade,checklist_grade.Str_Grade,checklist_grade.remarks,checklist_grade.Date_Checked FROM checklist_grade 
         left join area on checklist_grade.Aid = area.Aid 
        left join phase on checklist_grade.Pid = phase.Pid 
        left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
        left join accounts on timedatephase.protect = accounts.Acid
        left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
        left join building on checklist_grade.Bid = building.id 
        where Accounts.AcName != ''and checklist_grade.Date_Checked LIKE '".$date."' AND checklist_grade.Bid LIKE  '".$building."' AND checklist_grade.Pid LIKE '".$phase."'
        Group By checklist_grade.Aid, checklist_grade.Date_checked
        ORDER BY checklist_grade.Aid ASC");
       
      }else if($date != "" and $building = "Select Building" and $phase !="" and $area !=""){

        $stmt=$db_con->prepare("SELECT building.Name,phase.PName,area.AName,timedatephase.qastaff,Accounts.AcName,checklist_grade.totalsanigrade,checklist_grade.totalstrugrade, checklist_grade.CName,checklist_grade.San_grade,checklist_grade.Str_Grade,checklist_grade.remarks,checklist_grade.Date_Checked FROM checklist_grade 
         left join area on checklist_grade.Aid = area.Aid 
          left join phase on checklist_grade.Pid = phase.Pid 
          left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
          left join accounts on timedatephase.protect = accounts.Acid
          left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
          left join building on checklist_grade.Bid = building.id 
          where Accounts.AcName != ''and checklist_grade.Date_Checked LIKE '".$date."' AND checklist_grade.Bid LIKE  '".$building."'
          Group By checklist_grade.Aid, checklist_grade.Date_checked
          ORDER BY checklist_grade.Aid ASC");
      }  
      
      else if($date != "" and $building = "" and $phase ="" and $area =""){

        $stmt=$db_con->prepare("SELECT building.Name,phase.PName,area.AName,timedatephase.qastaff,Accounts.AcName,checklist_grade.totalsanigrade,checklist_grade.totalstrugrade, checklist_grade.CName,checklist_grade.San_grade,checklist_grade.Str_Grade,checklist_grade.remarks,checklist_grade.Date_Checked FROM checklist_grade 
         left join area on checklist_grade.Aid = area.Aid 
          left join phase on checklist_grade.Pid = phase.Pid 
          left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
          left join accounts on timedatephase.protect = accounts.Acid
          left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
          left join building on checklist_grade.Bid = building.id 
          where Accounts.AcName != ''and checklist_grade.Date_Checked LIKE '".$date."'
          Group By checklist_grade.Aid, checklist_grade.Date_checked
          ORDER BY checklist_grade.Aid ASC");
      }  

    else{

      $stmt=$db_con->prepare("SELECT building.Name,phase.PName,area.AName,timedatephase.qastaff,Accounts.AcName,checklist_grade.totalsanigrade,checklist_grade.totalstrugrade, checklist_grade.CName,checklist_grade.San_grade,checklist_grade.Str_Grade,checklist_grade.remarks,checklist_grade.Date_Checked FROM checklist_grade 
      left join area on checklist_grade.Aid = area.Aid 
      left join phase on checklist_grade.Pid = phase.Pid 
      left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
      left join accounts on timedatephase.protect = accounts.Acid
      left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
      left join building on checklist_grade.Bid = building.id 
      where Accounts.AcName != ''and checklist_grade.Date_Checked LIKE '".$date."'
      Group By checklist_grade.Aid, checklist_grade.Date_checked
      ORDER BY checklist_grade.Aid ASC");
    
    }
      $stmt->execute();

      $columnHeader = "Building"."\t"."Phase"."\t"."Area"."\t"."QA Staff"."\t"."Protech"."\t"."Sanitation"."\t"."Structural"."\t"."Checklist"."\t"."Sanitation"."\t"."Structural"."\t"."Remarks"."\t"."Date Checked"."\t";
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
      header("Content-Disposition: attachment; filename=ChecklistGrade_".basename($date).".xls");
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