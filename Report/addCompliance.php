<?php
include_once 'class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();

$Pidcompliance= $_POST['Pidcompliance'];
$Fidcompliance= $_POST['Fidcompliance'];
$Compliance= $_POST['compliance'];
$Remarks= $_POST['Remarks'];
$Date= $_POST['Date'];
// $noncompliance= $_POST['noncompliance'];

    if($Compliance == ""){
        echo "Enter Compliance"."\n";
    }else{
        // Remarks
        $stmtequip = $conn->prepare("INSERT INTO remarkpoints_detailed
        (Fid,Pid,Date,category,compliance_concern,Date_Created)
        VALUES(:Fid,:Pid,:Date,:category,:compliance_concern,:Date_Created)");

        $stmtequip->bindParam(":Fid", $Fidcompliance);
        $stmtequip->bindParam(":Pid", $Pidcompliance);
        $stmtequip->bindParam(":Date", $Date);
        $stmtequip->bindParam(":category", $Compliance);
        $stmtequip->bindParam(":compliance_concern", $Remarks);
        $stmtequip->bindParam(":Date_Created", $Datetoday);
        $stmtequip->execute();


        echo "Added Succesfully";
        
    }




?>

