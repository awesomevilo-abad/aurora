<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $EquipmentCategory = $_POST['EquipmentCategory'] ;

				$buildingdata =[];
                $grades = $conn->prepare("SELECT building.Name,edesc,COUNT(edesc) as functionalcount
                FROM `equipment_grade` 
                left join building on equipment_grade.bid = building.id
                WHERE edesc = '".$EquipmentCategory."' and edesc !='No Equipment' and DATE_FORMAT(equipment_grade.Date_Checked_equipment, '%M') ='".$month."' 
                GROUP by building.id order by building.Name ASC");
                
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $BuildingFunctionalPercentage = $rowGrades['functionalcount'];
                    
                    if($rowGrades['edesc'] == "Not Onsight"){
                        $Description = "Not On Site";
                    }else{
                        $Description = $rowGrades['edesc'];
                    }
                    $BuildingName = $rowGrades['Name'];
                    
                    array_push($buildingdata,
                    [ 
                        "name"=>$BuildingName,
                        "description"=>$Description,
                         "y"=>floatval($BuildingFunctionalPercentage)
                        
                    ]);
				  
                }

$jsonOBject =  array("categoriesdata" => $buildingdata
);
echo json_encode($jsonOBject);
?>

