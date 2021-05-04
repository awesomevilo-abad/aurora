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
   
        $stmt=$db_con->prepare("SELECT checklist.Cid,checklist.CName,building.Name,phase.PName,area.AName,checklist.Sani_One,checklist.Sani_Two,checklist.Sani_Three,checklist.Stru_One,checklist.Stru_Two,checklist.Stru_Three FROM checklist
        inner join area
        on checklist.Aid = Area.Aid
        inner join phase 
        on area.Pid = phase.Pid
        inner join building 
        on phase.Bid = building.id
        ORDER BY checklist.Cid DESC");
       
    }
    else{
      if($building != "" and $phase !="" and $area !=""){
          $stmt=$db_con->prepare("SELECT checklist.Cid,checklist.CName,building.Name,phase.PName,area.AName,checklist.Sani_One,checklist.Sani_Two,checklist.Sani_Three,checklist.Stru_One,checklist.Stru_Two,checklist.Stru_Three FROM checklist
          inner join area
          on checklist.Aid = Area.Aid
          inner join phase 
          on area.Pid = phase.Pid
          inner join building 
          on phase.Bid = building.id
          WHERE checklist.Aid LIKE '".$area."' AND checklist.Bid LIKE '".$building."'  AND checklist.Pid LIKE '".$phase."'
          ORDER BY checklist.Cid DESC");
        
          
        }
        else if($building != "" and $phase !="" and $area ="Select Area"){

          $stmt=$db_con->prepare("SELECT checklist.Cid,checklist.CName,building.Name,phase.PName,area.AName,checklist.Sani_One,checklist.Sani_Two,checklist.Sani_Three,checklist.Stru_One,checklist.Stru_Two,checklist.Stru_Three FROM checklist
          inner join area
          on checklist.Aid = Area.Aid
          inner join phase 
          on area.Pid = phase.Pid
          inner join building 
          on phase.Bid = building.id
          WHERE checklist.Bid LIKE '".$building."'  AND checklist.Pid LIKE '".$phase."'
          ORDER BY checklist.Cid DESC");
        
        
        }  

      else{

        $stmt=$db_con->prepare("SELECT checklist.Cid,checklist.CName,building.Name,phase.PName,area.AName,checklist.Sani_One,checklist.Sani_Two,checklist.Sani_Three,checklist.Stru_One,checklist.Stru_Two,checklist.Stru_Three FROM checklist
        inner join area
        on checklist.Aid = Area.Aid
        inner join phase 
        on area.Pid = phase.Pid
        inner join building 
        on phase.Bid = building.id
        WHERE checklist.Bid LIKE '".$building."'
        ORDER BY checklist.Cid DESC");
      
      }
    }
      $stmt->execute();

      $columnHeader = "Checklist Code"."\t"."Checklist Name"."\t"."Building"."\t"."Phase"."\t"."Area"."\t"."Sanitation (1)"."\t"."Sanitation (2)"."\t"."Sanitation (3)"."\t"."Structural (1)"."\t"."Structural (2)"."\t"."Structural (3)"."\t";
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
      header("Content-Disposition: attachment; filename=".$BName."_Checklist_".basename($Datetoday).".xls");
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