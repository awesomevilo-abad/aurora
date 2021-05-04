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
				$grades = $conn->prepare("SELECT Accounts.AcName,timedatephase.qastaff,checklist_grade.Pid,checklist_grade.CName,checklist_grade.San_Grade,checklist_grade.totalsanigrade,area.AName,timedatephase.week,timedatephase.protect_sani_grade, timedatephase.pid,building.id, building.Name,phase.PName
                FROM timedatephase left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                left join area on timedatephase.pid = area.Pid
                left join checklist_grade on area.Aid  = checklist_grade.Aid
                left join accounts on timedatephase.protect = accounts.Acid
                Where DATE_FORMAT(checklist_grade.Date_Checked, '%M') ='".$month."' and checklist_grade.week = '".$week."' and building.Name = '".$buildingname_var."' and phase.PName ='".$phase."' and area.AName ='".$area."'
                GROUP BY checklist_grade.Cid ORDER by checklist_grade.Aid ASC  ");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $AreaName = $rowGrades['CName'];
                    $BuildingCode = $rowGrades['id'];
                    $qa = $rowGrades['qastaff'];
                    $protech = $rowGrades['AcName'];
					
					array_push($building, [
                        'name'   => $AreaName,
                        'QA'   => $qa,
                        'Protech'   => $protech,
                        'type' => 'column',
                        'y' => floatval($rowGrades['San_Grade']),
                        'drilldown' => $BuildingCode
					  ]);
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $building);
echo json_encode($jsonOBject);
?>

