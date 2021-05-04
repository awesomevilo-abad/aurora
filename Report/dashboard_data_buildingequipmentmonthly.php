<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $year = $_POST['year'];
				$building = [];
                $grades = $conn->prepare("SELECT protect_equip_grade,tid,month,week,pid,id,Name,PName, AVG(newBuildingGrade) as newMonthGrade 
                FROM(SELECT protect_equip_grade,tid,month,week,pid,id,Name,PName,newWeekGrade, AVG(newWeekGrade) as newBuildingGrade 
                FROM(SELECT protect_equip_grade,tid,month,week,pid,id,Name,PName, AVG(protect_equip_grade) as newWeekGrade 
                FROM (SELECT timedatephase.tid,timedatephase.month,timedatephase.week,timedatephase.protect_equip_grade, timedatephase.pid,building.id, building.Name,phase.PName 
                FROM timedatephase 
                left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                Where phase.PName NOT LIKE'%Warehouse%' and timedatephase.year = '".$year."' 
                GROUP BY timedatephase.month,timedatephase.pid,timedatephase.week,timedatephase.Bid 
                ORDER by timedatephase.protect_equip_grade DESC)as newWeekGrade 
                group by week,id,month order by week ASC) as newBuilding 
                
                group by id,month order by Name ASC) as newMonth 
                WHERE newBuildingGrade != 0
                group by month order by tid ASC");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $monthdepot = $rowGrades['month'];
					
					array_push($building, [
                        'name'   => $monthdepot,
                        'type' => 'column',
                        'y' => floatval($rowGrades['newMonthGrade']),
                        'color'=> '#fec539'
					  ]);
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $building);
echo json_encode($jsonOBject);
?>

