<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $year = $_POST['year'] ;
             
				$building = [];
				$grades = $conn->prepare("SELECT AVG(BuildingGrade) as newBuildingGrade,Name 
                FROM (SELECT AVG(timedatephase.protect_stru_grade) as BuildingGrade, timedatephase.pid,phase.PName,building.id, building.Name 
                FROM timedatephase 
                left join phase on timedatephase.pid = phase.Pid
                left join building on phase.Bid = building.id 
                Where timedatephase.month = '".$month."' and timedatephase.year = '".$year."'
                group by timedatephase.week,timedatephase.Bid ORDER by Name) as newque group by Name");

				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $BuildingName = $rowGrades['Name'];
					
					array_push($building, [
                        'name'   => $BuildingName,
                        'type' => 'column',
                        'y' => floatval($rowGrades['newBuildingGrade']),
					  ]);
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $building);
echo json_encode($jsonOBject);
?>

