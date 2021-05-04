<?php  
      //export.php  
        include_once 'class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();
        $Datetoday = $crudcontroller->getDate();
  
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
    $showbuilding = $conn->prepare("SELECT * FROM Building WHERE id = :id ORDER BY id ASC ");
    $showbuilding->execute(array(":id"=> $building));
    $rowshowbuilding = $showbuilding->fetch(PDO::FETCH_ASSOC);
    if($building == "All"){
    $BName="All Building";
    }else{
    $BName=$rowshowbuilding['Name'];
    }

    $phase =$_POST['Phase'];
    if(isset($_POST['Area'])){
      $area =$_POST['Area'];
    }else{
      $area = "";
    }

    if($_POST['Building'] == "All"){
   
        $stmt=$db_con->prepare("SELECT equipment.Eid, building.Name,phase.PName,area.AName,equipment.Asset_Tag, equipment.EName,equipment.Asset_Number,equipment.status,equipment.Date_Created   FROM equipment
        inner join area
        on equipment.Aid = Area.Aid
        inner join phase 
        on area.Pid = phase.Pid
        inner join building 
        on phase.Bid = building.id
        ORDER BY equipment.Eid DESC");
       
    }
    else{
      if($building != "" and $phase !="" and $area !=""){
          $stmt=$db_con->prepare("SELECT equipment.Eid, building.Name,phase.PName,area.AName,equipment.Asset_Tag, equipment.EName,equipment.Asset_Number,equipment.status,equipment.Date_Created   FROM equipment
          inner join area
          on equipment.Aid = Area.Aid
          inner join phase 
          on area.Pid = phase.Pid
          inner join building 
          on phase.Bid = building.id
          WHERE equipment.Aid LIKE '".$area."' AND phase.Bid LIKE '".$building."'  AND phase.Pid LIKE '".$phase."'
          ORDER BY equipment.Eid DESC");
        
          
        }
        else if($building != "" and $phase !="" and $area ="Select Area"){

          $stmt=$db_con->prepare("SELECT equipment.Eid, building.Name,phase.PName,area.AName,equipment.Asset_Tag, equipment.EName,equipment.Asset_Number,equipment.status,equipment.Date_Created   FROM equipment
          inner join area
          on equipment.Aid = Area.Aid
          inner join phase 
          on area.Pid = phase.Pid
          inner join building 
          on phase.Bid = building.id
          WHERE phase.Bid LIKE '".$building."'  AND phase.Pid LIKE '".$phase."'
          ORDER BY equipment.Eid DESC");
        
        
        }  

      else{

        $stmt=$db_con->prepare("SELECT equipment.Eid, building.Name,phase.PName,area.AName,equipment.Asset_Tag, equipment.EName,equipment.Asset_Number,equipment.status,equipment.Date_Created   FROM equipment
        inner join area
        on equipment.Aid = Area.Aid
        inner join phase 
        on area.Pid = phase.Pid
        inner join building 
        on phase.Bid = building.id
        WHERE phase.Bid LIKE '".$building."'
        ORDER BY equipment.Eid DESC");
      
      }
    }
      $stmt->execute();

      $columnHeader = "Equipment Code"."\t"."Building"."\t"."Phase"."\t"."Area"."\t"."Asset Tag #"."\t"."Equipment"."\t"."Equipment Number"."\t"."status"."\t"."Date_Created"."\t";
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
      header("Content-Disposition: attachment; filename=".$BName."Equipment".basename($Datetoday).".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      
      echo ucwords($columnHeader)."\n".$setData."\n";

    //   $query = "SELECT building.Name,phase.PName,area.AName,timedatephase.qastaff,Accounts.AcName  FROM equipment_grade 
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