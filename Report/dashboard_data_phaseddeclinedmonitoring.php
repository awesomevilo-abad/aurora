<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $phasedropdown = $_POST['phase'] ;
                
				$phase = [];
				$grades = $conn->prepare("SELECT timedatephase.qastaff,accounts.AcName,timedatephase.week,phase.PName,count(timedatephase.declineReason) as countReason,timedatephase.declineReason
                FROM timedatephase left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                left join accounts on timedatephase.protect = accounts.Acid
                Where timedatephase.month = '".$month."' and timedatephase.pid = '".$phasedropdown."' 
                GROUP BY    timedatephase.declineReason");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    if($rowGrades['declineReason'] == "No Reason"){
                        $declineReason="Continue";
                    }else{
                        $declineReason = $rowGrades['declineReason'];
                    }
                    
                    $ChecklistNameorStatusSummary = $rowGrades['countReason'];
                    $Phasename=$rowGrades['PName'];
                    $Phaseweek=$rowGrades['week'];
                    $protech=$rowGrades['AcName'];
                    $qastaff=$rowGrades['qastaff'];
					
					array_push($phase, [
                        'name'   => $declineReason,
                        'week'   => $Phaseweek,
                        'qastaff'   => $qastaff,
                        'protech'   => $protech,
                        'type' => 'column',
                        'y' => floatval($ChecklistNameorStatusSummary),
                        
					  ]);
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $phase,"phasename"=>$Phasename,"Phaseweek"=>$Phaseweek   );
echo json_encode($jsonOBject);
?>

