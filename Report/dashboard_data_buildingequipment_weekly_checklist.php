<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                if(isset($buildingname_var)){
                $buildingname_var="Building 1";
                }else{
                $buildingname_var = $_POST['building'] ;
                }

                $week = $_POST['week'];
                $phase = $_POST['phase'];
                $area = $_POST['area'];
                // echo $buildingname_var;
				$building = [];
				$grades = $conn->prepare("SELECT *
                FROM equipment_grade left join area on
                equipment_grade.aid = area.Aid left join phase on
                equipment_grade.pid = phase.Pid left join timedatephase on
                equipment_grade.pid = phase.Pid left join accounts on
                timedatephase.protect = accounts.AcName  left join equipment on
                equipment_grade.eid = equipment.Eid
                Where DATE_FORMAT(equipment_grade.Date_Checked_equipment, '%M') ='".$month."' and equipment_grade.week = '".$week."'  and phase.PName ='".$phase."' and area.AName ='".$area."'
                GROUP BY equipment_grade.eid ORDER by equipment_grade.eid ASC  ");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $EquipmentName = $rowGrades['Name']." # ".$rowGrades['Asset_Number'];
                    $qa = $rowGrades['qastaff'];
                    $protech = $rowGrades['AcName'];
                    $id = $rowGrades['eid'];
					
					array_push($building, [
                        'name'   => $EquipmentName,
                        'id'   => $id,
                        'QA'   => $qa,
                        'Protech'   => $protech,
                        'type' => 'column',
                        'y' => floatval($rowGrades['egrade']),
					  ]);
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $building);
echo json_encode($jsonOBject);
?>

