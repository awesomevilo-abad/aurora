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
                // echo $buildingname_var;
				$building = [];
				$grades = $conn->prepare("SELECT equipment_grade.totalequipgrade,Accounts.AcName,timedatephase.qastaff,checklist_grade.Pid,area.AName,timedatephase.week,timedatephase.protect_equip_grade, timedatephase.pid,building.id, building.Name,phase.PName
                FROM timedatephase left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                left join area on timedatephase.pid = area.Pid
                left join checklist_grade on area.Aid  = checklist_grade.Aid
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid  = equipment_grade.aid
                Where DATE_FORMAT(equipment_grade.Date_Checked_equipment, '%M') ='".$month."' and equipment_grade.week = '".$week."'   and building.Name = '".$buildingname_var."' and phase.PName ='".$phase."'
                GROUP BY checklist_grade.Aid ORDER by checklist_grade.Aid ASC  ");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $AreaName = $rowGrades['AName'];
                    $BuildingCode = $rowGrades['id'];
                    $qa = $rowGrades['qastaff'];
                    $protech = $rowGrades['AcName'];
					
					array_push($building, [
                        'name'   => $AreaName,
                        'QA'   => $qa,
                        'Protech'   => $protech,
                        'type' => 'column',
                        'y' => floatval($rowGrades['totalequipgrade'])
					  ]);
				  
                }
             
                
                $areaWeight =array();
				$grades = $conn->prepare("SELECT area.percentageequip,Accounts.AcName,timedatephase.qastaff,checklist_grade.Pid,area.AName,timedatephase.week,timedatephase.protect_equip_grade, timedatephase.pid,building.id, building.Name,phase.PName
                FROM timedatephase left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                left join area on timedatephase.pid = area.Pid
                left join checklist_grade on area.Aid  = checklist_grade.Aid
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid  = equipment_grade.aid
                Where DATE_FORMAT(equipment_grade.Date_Checked_equipment, '%M') ='".$month."' and equipment_grade.week = '".$week."'   and building.Name = '".$buildingname_var."' and phase.PName ='".$phase."'
                GROUP BY checklist_grade.Aid ORDER by checklist_grade.Aid ASC  ");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $AreaName = $rowGrades['AName'];
                    $BuildingCode = $rowGrades['id'];
                    $qa = $rowGrades['qastaff'];
                    $protech = $rowGrades['AcName'];
                    $percentage =floatval($rowGrades['percentageequip'])*100;
					
					array_push($areaWeight, 
                        $percentage
					  );
				  
                }

             
                
			

$jsonOBject =  array("data" => $building,"areaWeight" => $areaWeight);
echo json_encode($jsonOBject);
?>

