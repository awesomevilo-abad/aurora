<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
          

                
				$buildingdata =[];
				$grades = $conn->prepare("SELECT edesc, COUNT(edesc) as newCount FROM `equipment_grade` WHERE edesc !='No Equipment' and DATE_FORMAT(equipment_grade.Date_Checked_equipment, '%M') ='".$month."' GROUP by edesc");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $BuildingFunctionalPercentage = $rowGrades['newCount'];
                   
                    if($rowGrades['edesc'] == "Not Onsight"){
                        $Description = "Not On Site";
                    }else{
                        $Description = $rowGrades['edesc'];
                    }
                    
                    array_push($buildingdata,
                    [ 
                        "name"=>$Description,
                         "y"=>floatval($BuildingFunctionalPercentage)
                        
                    ]);
				  
                }

$jsonOBject =  array("categoriesdata" => $buildingdata
);
echo json_encode($jsonOBject);
?>

