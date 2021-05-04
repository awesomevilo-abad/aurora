<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $year = $_POST['year'] ;
             
				$building = [];
				$grades = $conn->prepare("SELECT week,pid,id,Name,PName, AVG(newWeekGrade) as newBuildingGrade 
                FROM(SELECT week,pid,id,Name,PName, AVG(protect_sani_grade) as newWeekGrade 
                FROM (SELECT timedatephase.week,timedatephase.protect_sani_grade, timedatephase.pid,building.id, building.Name,phase.PName 
                FROM timedatephase 
                left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                Where timedatephase.month = '".$month."' and timedatephase.year = '".$year."'
                 GROUP BY timedatephase.pid,timedatephase.week,timedatephase.Bid ORDER by timedatephase.protect_sani_grade DESC)as newWeekGrade 
                 group by week,id order by week ASC) as newBuilding group by id order by Name ASC");

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

