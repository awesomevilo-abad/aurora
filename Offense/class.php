<?php
include_once 'Conn.php';
class CrudController
{ 
    
    /* Fetch All */
    public function viewEquipmentOffense($year ,$month ,$week, $offense)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT equipment_grade.id,equipment.Asset_Tag,
            equipment.Asset_Number,equipment.EName,building.Name,phase.PName,area.AName
             ,equipment_grade.egrade,equipment_grade.remarksequip,equipment_grade.week,equipment_grade.Date_Checked_equipment
            FROM `equipment_grade` 
            LEFT JOIN equipment on equipment_grade.eid = equipment.Eid
            LEFT JOIN building on equipment_grade.bid = building.id
            LEFT JOIN phase on equipment_grade.pid = phase.Pid
            LEFT JOIN area on equipment_grade.Aid = area.Aid
            WHERE `year`='$year' and `week`=$week and `month` = '$month' and edesc = '$offense' and egrade!=0
            ORDER BY egrade DESC";
            
            $resource = $conn->query($sql);
            
            $result = $resource->fetchAll(PDO::FETCH_ASSOC);
            
            $dao->closeConnection();
        } catch (PDOException $e) {
            
            echo "There is some problem in connection: " . $e->getMessage();
        }
        if (! empty($result)) {
            return $result;
        }
    }

    /* Fetch All */
    public function viewOffenseStructural($year,$month ,$week, $offense)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT checklist_grade.remarks,area.AName,checklist_grade.id,checklist_grade.CName,building.Name,phase.PName
            ,checklist_grade.Str_Grade,checklist_grade.week,checklist_grade.Date_Checked 
            FROM `checklist_grade` 
            
            LEFT JOIN building on checklist_grade.Bid = building.id
            LEFT JOIN phase on checklist_grade.Pid = phase.Pid
            LEFT JOIN area on checklist_grade.Aid = area.Aid
            WHERE `year`='$year' and `week`=$week and `month` = '$month' and Str_Grade = $offense and Str_Grade!=0
            ORDER BY Str_Grade DESC";
            
            $resource = $conn->query($sql);
            
            $result = $resource->fetchAll(PDO::FETCH_ASSOC);
            
            $dao->closeConnection();
        } catch (PDOException $e) {
            
            echo "There is some problem in connection: " . $e->getMessage();
        }
        if (! empty($result)) {
            return $result;
        }
    }
    
    /* Fetch All */
    public function viewOffenseSanitation($year,$month ,$week, $offense)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT checklist_grade.id,checklist_grade.CName,building.Name,phase.PName,area.AName
            ,checklist_grade.San_Grade,checklist_grade.remarks,checklist_grade.week,checklist_grade.Date_Checked 
            FROM `checklist_grade` 
            
            LEFT JOIN building on checklist_grade.Bid = building.id
            LEFT JOIN phase on checklist_grade.Pid = phase.Pid
            LEFT JOIN area on checklist_grade.Aid = area.Aid
            
            WHERE `year`='$year' and `week`=$week and `month` = '$month' and San_Grade = $offense and San_Grade!=0
            ORDER BY San_Grade DESC";
            
            $resource = $conn->query($sql);
            
            $result = $resource->fetchAll(PDO::FETCH_ASSOC);
            
            $dao->closeConnection();
        } catch (PDOException $e) {
            
            echo "There is some problem in connection: " . $e->getMessage();
        }
        if (! empty($result)) {
            return $result;
        }
    }
    
    function getDate(){
		$tz_oject = new DateTimeZone('Asia/manila');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_oject);
		return $datetime->format('Y-m-d');
	}

}

?>