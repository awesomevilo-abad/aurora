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
    $date =$_POST['Date_visor'];
    if(isset($_POST['Area'])){
      $area =$_POST['Area'];
    }else{
      $area = "";
    }


    if($date != ""and $building  == ""and $phase  == ""and $area  == ""){
 
        $stmt=$db_con->prepare("SELECT building.Name,phase.PName,area.AName,image_visor.date_checked,timedatephase_visor.qastaff  FROM image_visor 
        left join area on image_visor.Aid = area.Aid 
        left join phase on image_visor.Pid = phase.Pid 
       left join building on image_visor.Bid = building.id 
       left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
        WHERE image_visor.Date_Checked LIKE '".$date."'
        Group By image_visor.Aid, image_visor.Date_checked
        ORDER BY image_visor.Aid DESC");
        
    }
    else if($date != ""and $building  == "Select Building"){

        $stmt=$db_con->prepare("SELECT building.Name,phase.PName,area.AName,image_visor.date_checked,timedatephase_visor.qastaff  FROM image_visor 
        left join area on image_visor.Aid = area.Aid 
        left join phase on image_visor.Pid = phase.Pid 
       left join building on image_visor.Bid = building.id 
       left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
        WHERE image_visor.Date_Checked LIKE '".$date."'
        Group By image_visor.Aid, image_visor.Date_checked
        ORDER BY image_visor.Aid DESC");
        
    }
    else if($date != "" and $building != "" and $phase !="" and $area !=""){

        $stmt=$db_con->prepare("SELECT building.Name,phase.PName,area.AName,image_visor.date_checked,timedatephase_visor.qastaff  FROM image_visor 
        left join area on image_visor.Aid = area.Aid 
        left join phase on image_visor.Pid = phase.Pid 
       left join building on image_visor.Bid = building.id 
       left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
        WHERE image_visor.Date_Checked LIKE '".$date."' AND image_visor.Bid LIKE  '".$building."' AND image_visor.Pid LIKE '".$phase."' AND image_visor.Aid LIKE '".$area."'
        Group By image_visor.Aid, image_visor.Date_checked
        ORDER BY image_visor.Aid DESC");
        
    }    
    else if($date != "" and $building != "" and $phase !="" and $area ="Select Area"){

        $stmt=$db_con->prepare("SELECT building.Name,phase.PName,area.AName,image_visor.date_checked,timedatephase_visor.qastaff  FROM image_visor 
        left join area on image_visor.Aid = area.Aid 
        left join phase on image_visor.Pid = phase.Pid 
       left join building on image_visor.Bid = building.id 
       left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
        WHERE image_visor.Date_Checked LIKE '".$date."' AND image_visor.Bid LIKE  '".$building."' AND image_visor.Pid LIKE '".$phase."'
        Group By image_visor.Aid, image_visor.Date_checked
        ORDER BY image_visor.Aid DESC");
        
    }
     
    else if($date != "" and $building != "" and $phase ="Select Phase" and $area =""){

        $stmt=$db_con->prepare("SELECT building.Name,phase.PName,area.AName,image_visor.date_checked,timedatephase_visor.qastaff  FROM image_visor 
        left join area on image_visor.Aid = area.Aid 
        left join phase on image_visor.Pid = phase.Pid 
       left join building on image_visor.Bid = building.id 
       left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
        WHERE image_visor.Date_Checked LIKE '".$date."' AND image_visor.Bid LIKE  '".$building."'
        Group By image_visor.Aid, image_visor.Date_checked
        ORDER BY image_visor.Aid DESC");
        
    }
    
    else if($date != "" and $building != "" and $phase =="Select Phase" and $area ==""){

        $stmt=$db_con->prepare("SELECT building.Name,phase.PName,area.AName,image_visor.date_checked,timedatephase_visor.qastaff  FROM image_visor 
        left join area on image_visor.Aid = area.Aid 
        left join phase on image_visor.Pid = phase.Pid 
       left join building on image_visor.Bid = building.id 
       left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
        WHERE image_visor.Date_Checked LIKE '".$date."' AND image_visor.Bid LIKE  '".$building."'
        Group By image_visor.Aid, image_visor.Date_checked
        ORDER BY image_visor.Aid DESC");
        
    }
      $stmt->execute();

      $columnHeader = "Building"."\t"."Phase"."\t"."Area"."\t"."Date Checked"."\t"."Auditted By"."\t";
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
      header("Content-Disposition: attachment; filename=Visor_History_".basename($date).".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      
      echo ucwords($columnHeader)."\n".$setData."\n";

    //   $query = "SELECT building.Name,phase.PName,area.AName,timedatephase.qastaff,Accounts.AcName FROM checklist_grade 
    //   left join area on checklist_grade.Aid = area.Aid 
    //   left join phase on checklist_grade.Pid = phase.Pid 
    //   left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
    //   left join accounts on timedatephase.protect = accounts.Acid
    //   left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked
    //   left join building on checklist_grade.Bid = building.id ";  
    //   $result = mysqli_query($connect, $query);  
    //   while($row = mysqli_fetch_assoc($result))  
    //   {  
    //        fputcsv($output, $row);  
    //   }  
    //   fclose($output);  
 }  
 ?>  