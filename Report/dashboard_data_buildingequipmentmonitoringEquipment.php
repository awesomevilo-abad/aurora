<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $EquipmentCategory = $_POST['Category'] ;
                $Building = $_POST['Building'] ;
                $Phase = $_POST['Phase'] ;
                $area = $_POST['area'] ;

				$equipdata =[];
                $grades = $conn->prepare("SELECT equipment_grade.Date_Checked_equipment, building.Name,PName,AName,equipment_grade.Name,Asset_Number,edesc,COUNT(edesc) as functionalcount
                FROM `equipment_grade` 
                left join building on equipment_grade.bid = building.id 
                left join phase on equipment_grade.pid = phase.Pid 
                LEFT join area on equipment_grade.aid =area.Aid 
                LEFT JOIN equipment on equipment_grade.eid = equipment.Eid
                WHERE AName = '".$area."' and PName='".$Phase."' and building.Name = '".$Building."' and edesc = '".$EquipmentCategory."'and edesc !='No Equipment' and DATE_FORMAT(equipment_grade.Date_Checked_equipment, '%M') ='".$month."' 
                GROUP by equipment_grade.eid,equipment_grade.Date_Checked_equipment order by equipment_grade.Date_Checked_equipment,equipment.EName,equipment.Asset_Number ASC");
                
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $EquipFunctionalPercentage = $rowGrades['functionalcount'];
                    $Description = $rowGrades['edesc'];
                    $Date_Checked_equipment = $rowGrades['Date_Checked_equipment'];
                    $formatDate=date("F",strtotime($Date_Checked_equipment));
                    $Day=date("d",strtotime($Date_Checked_equipment));
                    $Year=date("Y",strtotime($Date_Checked_equipment));

                    $equipDetails = $rowGrades['Name']." ".$rowGrades['Asset_Number']."  "."<br><b>".$formatDate." ".$Day." ".$Year."</b>";
                    
                    array_push($equipdata,
                    [ 
                        "name"=>$equipDetails,
                        "description"=>$Description,
                         "y"=>floatval($EquipFunctionalPercentage)
                        
                    ]);
				  
                }

$jsonOBject =  array("categoriesdata" => $equipdata
);
echo json_encode($jsonOBject);
?>

