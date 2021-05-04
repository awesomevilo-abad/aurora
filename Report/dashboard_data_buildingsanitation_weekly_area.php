<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $year = $_POST['year'] ;
                if(isset($buildingname_var)){
                $buildingname_var="Building 1";
                }else{
                $buildingname_var = $_POST['building'] ;
                }

                $week = $_POST['week'];
                $phase = $_POST['phase'];
				$building = [];
				$grades = $conn->prepare("SELECT Accounts.AcName,timedatephase.qastaff,checklist_grade.Pid,checklist_grade.totalsanigrade,area.AName,timedatephase.week,timedatephase.protect_sani_grade, timedatephase.pid,building.id, building.Name,phase.PName
                FROM timedatephase left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                left join area on timedatephase.pid = area.Pid
                left join checklist_grade on area.Aid  = checklist_grade.Aid
                left join accounts on timedatephase.protect = accounts.Acid
                Where DATE_FORMAT(checklist_grade.Date_Checked, '%M') ='".$month."' and checklist_grade.week = '".$week."' and  timedatephase.year = '".$year."' and building.Name = '".$buildingname_var."' and phase.PName ='".$phase."' and checklist_grade.Date_Checked = timedatephase.date_checked
                GROUP BY checklist_grade.Aid,timedatephase.week ORDER by checklist_grade.Aid ASC  ");
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
                        'y' => floatval($rowGrades['totalsanigrade'])
					  ]);
				  
                }

                $areaWeight =array();
				$grades = $conn->prepare("SELECT area.Percentage,Accounts.AcName,timedatephase.qastaff,checklist_grade.Pid,checklist_grade.totalsanigrade,area.AName,timedatephase.week,timedatephase.protect_sani_grade, timedatephase.pid,building.id, building.Name,phase.PName
                FROM timedatephase left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                left join area on timedatephase.pid = area.Pid
                left join checklist_grade on area.Aid  = checklist_grade.Aid
                left join accounts on timedatephase.protect = accounts.Acid
                WHERE DATE_FORMAT(checklist_grade.Date_Checked, '%M') ='".$month."' and checklist_grade.week = '".$week."' and building.Name = '".$buildingname_var."' and phase.PName ='".$phase."'
                GROUP BY checklist_grade.Aid ORDER by checklist_grade.Aid ASC  ");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $AreaName = $rowGrades['AName'];
                    $BuildingCode = $rowGrades['id'];
                    $qa = $rowGrades['qastaff'];
                    $protech = $rowGrades['AcName'];
                    $percentage =floatval($rowGrades['Percentage'])*100;
					
					array_push($areaWeight, 
                        $percentage
					  );
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $building,"dataWeight" => $areaWeight);
echo json_encode($jsonOBject);
?>

