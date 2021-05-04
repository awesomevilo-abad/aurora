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
				$building = [];
				$grades = $conn->prepare("SELECT timedatephase.week,timedatephase.protect_sani_grade, timedatephase.pid,building.id, building.Name,phase.PName
                FROM timedatephase left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                Where  timedatephase.month = '".$month."' and timedatephase.week = '".$week."' and timedatephase.year = '".$year."' and building.Name = '".$buildingname_var."'
                GROUP BY timedatephase.pid ORDER by timedatephase.protect_sani_grade DESC  ");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $PhaseName = $rowGrades['PName'];
                    $BuildingCode = $rowGrades['id'];
					
					array_push($building, [
                        'name'   => $PhaseName,
                        'type' => 'column',
                        'y' => floatval($rowGrades['protect_sani_grade']),
                        'drilldown' => $BuildingCode
					  ]);
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $building);
echo json_encode($jsonOBject);
?>

