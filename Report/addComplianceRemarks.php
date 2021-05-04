<?php
include_once 'class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();

$complianceid= $_POST['complianceid'];
$complianceremarks= $_POST['ComplianceRemarks'];
// $noncompliance= $_POST['noncompliance'];

    if($complianceremarks == ""){
        echo "Enter Compliance"."\n";
    }else{
        // Remarks
        $stmtequip = $conn->prepare("INSERT INTO remarkpoints_detailed_complianceremarks
        (complianceid,Complianceremarks,Date_Created)
        VALUES(:complianceid,:Complianceremarks,:Date_Created)");

        $stmtequip->bindParam(":complianceid", $complianceid);
        $stmtequip->bindParam(":Complianceremarks", $complianceremarks);
        $stmtequip->bindParam(":Date_Created", $Datetoday);
        $stmtequip->execute();


        echo "Added Succesfully";
        
    }




?>

