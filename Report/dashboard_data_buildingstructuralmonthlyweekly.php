<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $year = $_POST['year'];
                $month = $_POST['month'];
				$building = [];
				$grades = $conn->prepare("SELECT week,protect_stru_grade,pid,id,Name,PName, AVG(newBuildingGrade) as newWeekGrade 
                FROM( SELECT week,protect_stru_grade,pid,id,Name,PName, AVG(protect_stru_grade) as newBuildingGrade 
                FROM(SELECT timedatephase.week,timedatephase.protect_stru_grade, timedatephase.pid,building.id, building.Name,phase.PName 
                FROM timedatephase left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                Where phase.PName NOT LIKE'%Warehouse%' and timedatephase.month = '".$month."' and timedatephase.year = '".$year."' 
                GROUP BY timedatephase.pid,timedatephase.week 
                ORDER by building.Name ASC) as newBuilding 
                Group by id,week order by Name asc) as newWeek group by week");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $weekdepot = 'Week '.$rowGrades['week'];
					
					array_push($building, [
                        'name'   => $weekdepot,
                        'type' => 'column',
                        'y' => floatval($rowGrades['newWeekGrade']),
                        'color'=> '#fec539'
					  ]);
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $building);
echo json_encode($jsonOBject);
?>

