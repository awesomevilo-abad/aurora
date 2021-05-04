<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $year = $_POST['year'];
                $month = $_POST['month'];
				$building = [];
				$grades = $conn->prepare("SELECT week,protect_equip_grade,pid,id,Name,PName,newBuildingGrade, AVG(newBuildingGrade) as newWeekGrade 
                FROM( SELECT week,protect_equip_grade,pid,id,Name,PName, AVG(protect_equip_grade) as newBuildingGrade 
                FROM(SELECT timedatephase.week,timedatephase.protect_equip_grade, timedatephase.pid,building.id, building.Name,phase.PName 
                FROM timedatephase left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                Where timedatephase.month = '".$month."' and timedatephase.year = '".$year."' 
                GROUP BY timedatephase.pid,timedatephase.week 
                ORDER by building.Name ASC) as newBuilding 
                
                Group by id,week order by Name asc) as newWeek 
                WHERE newBuildingGrade != 0 
                group by week");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $weekdepot = 'Week '.$rowGrades['week'];
					
					array_push($building, [
                        'name'   => $weekdepot,
                        'type' => 'column',
                        'y' => floatval($rowGrades['newWeekGrade']),
                        'color'=> '#47a447'
					  ]);
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $building);
echo json_encode($jsonOBject);
?>

