<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

				// $phase =;
				$SanitatinoGrade = [];
				$StructuralGrade = [];
				$EquipGrade = [];
				$grades = $conn->prepare("SELECT timedatephase.date_checked,AVG(timedatephase.protect_sani_grade) as Sanitation, AVG(timedatephase.protect_stru_grade) as Structural, AVG(timedatephase.protect_equip_grade) as Equipment, timedatephase.week, phase.PName FROM timedatephase left join phase on timedatephase.pid = phase.Pid where timedatephase.pid = '". $_POST['phase']."' Group by week");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
					$weekName = "Week ".$rowGrades['week'];
					
					array_push($SanitatinoGrade, [
						'label'   => $weekName,
						'y' => floatval($rowGrades['Sanitation'])
					  ]);

					  array_push($StructuralGrade, [
						'label'   => $weekName,
						'y' => floatval($rowGrades['Structural'])
					  ]);
					  
					  array_push($EquipGrade, [
						'label'   => $weekName,
						'y' => floatval($rowGrades['Equipment'])
					  ]);
				  
				}		
				
			

$jsonOBject =  array("phase" => $rowGrades['PName'],"sanitation" => $SanitatinoGrade,"structural" => $StructuralGrade,"equip" => $EquipGrade);
echo json_encode($jsonOBject);
?>

