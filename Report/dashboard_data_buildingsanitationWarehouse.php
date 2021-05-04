<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $week = $_POST['week'] ;
                $year = $_POST['year'] ;
             
				$building = [];
				$grades = $conn->prepare("SELECT week,protect_sani_grade,pid,id,Name,PName, AVG(protect_sani_grade) as newBuildingGrade 
                FROM(SELECT timedatephase.week,timedatephase.protect_sani_grade, timedatephase.pid,building.id, building.Name,phase.PName 
                FROM timedatephase left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                Where phase.PName LIKE'%Warehouse%' and timedatephase.month = '".$month."' and timedatephase.week = '".$week."' and timedatephase.year = '".$year."' 
                GROUP BY timedatephase.pid ORDER by building.Name ASC) as newBuilding 
                Group by id order by Name asc");

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

