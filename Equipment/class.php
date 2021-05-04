<?php
include_once 'Conn.php';
class CrudController
{ 
    
    /* Fetch All */
    public function readData()
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT equipment.Eid,equipment.EName,area.AName,phase.PName,
            equipment.Asset_Tag,equipment.Asset_Number,equipment.status,equipment.Date_Created
             FROM equipment
            inner join area
            on equipment.Aid = Area.Aid
            left join phase 
            on area.Pid = phase.Pid
            ORDER BY equipment.Eid DESC";
            
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


    /* Add New Record */
    public function add($formArray)
    { 
       
        $Name=$_POST['Name'];
        $area=$_POST['area'];
        $AssetTag=$_POST['AssetTag'];
        $AssetNo=$_POST['AssetNo'];
        $Status=$_POST['Status'];
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "INSERT INTO equipment (Aid, EName,Asset_Tag,Asset_Number,status)
             VALUES ('" . $area . "','" . $Name . "','" . $AssetTag . "','" . $AssetNo . "','" . $Status . "')";
        $conn->query($sql);
        $dao->closeConnection();

    }
    
    
    /* Edit a Record */
    public function edit($formArray)
    {
        $id = $_POST['id'];
        $EName = $_POST['Name'];
        $Aid = $_POST['area'];
        $AssetTag=$_POST['AssetTag'];
        $AssetNo=$_POST['AssetNo'];
        $Status=$_POST['Status'];
        
        
        
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "UPDATE equipment SET Aid = '" . $Aid . "'
        ,EName = '" . $EName . "'
        ,Asset_Tag = '" . $AssetTag . "'
        ,Asset_Number = '" . $AssetNo . "'
        ,status = '" . $Status . "'
        WHERE Eid=" . $id;
        
        $conn->query($sql);
        $dao->closeConnection();
    }

       /* Fetch Single Record by Id */
       public function readSingle($id)
       {
           try {
               
               $dao = new Dao();
               
               $conn = $dao->openConnection();
               
               $sql = "SELECT * FROM `equipment` WHERE Eid=" . $id . " ORDER BY Eid DESC";
               
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

       
    /* Delete a Record */
    public function delete($id)
    {
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "DELETE FROM `equipment` where Eid='$id'";
        
        $conn->query($sql);
        $dao->closeConnection();
    }

    
    /* Fetch All */
    public function filteredreadData()
    {
        if($_POST['building'] == "All"){
            try {
             
                $dao = new Dao();
                
                $conn = $dao->openConnection();
                
                $sql = "SELECT * FROM equipment
                inner join area
                on equipment.Aid = Area.Aid
                inner join phase 
                on area.Pid = phase.Pid
                inner join building 
                on phase.Bid = building.id
                ORDER BY equipment.Eid ASC";
                
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
        else{
            $building= $_POST['building'];
            $phase= $_POST['phase'];
            $area= $_POST['area'];
    
            try {
                
                $dao = new Dao();
                
                $conn = $dao->openConnection();
                
                if($building != "" and $phase !="" and $area !=""){
    
                    $sql = "SELECT * FROM equipment
                    inner join area
                    on equipment.Aid = Area.Aid
                    inner join phase 
                    on area.Pid = phase.Pid
                    inner join building 
                    on phase.Bid = building.id
                    WHERE equipment.Aid LIKE '".$area."' AND phase.Bid LIKE '".$building."'  AND phase.Pid LIKE '".$phase."'
                    ORDER BY equipment.Eid ASC";
                }else if($building != "" and $phase !="" and $area ="Select Area"){
    
                    $sql = "SELECT * FROM equipment
                    inner join area
                    on equipment.Aid = Area.Aid
                    inner join phase 
                    on area.Pid = phase.Pid
                    inner join building 
                    on phase.Bid = building.id
                    WHERE phase.Bid LIKE '".$building."'  AND phase.Pid LIKE '".$phase."'
                    ORDER BY equipment.Eid ASC";
                }
                else{
    
                    $sql = "SELECT * FROM equipment
                    inner join area
                    on equipment.Aid = Area.Aid
                    inner join phase 
                    on area.Pid = phase.Pid
                    inner join building 
                    on phase.Bid = building.id
                    WHERE phase.Bid LIKE '".$building."'
                    ORDER BY equipment.Eid ASC";
                
                }
                
    
                $resource = $conn->query($sql);
                
                $result = $resource->fetchAll(PDO::FETCH_ASSOC);
                
                $dao->closeConnection();
            } catch (PDOException $e) {
                
                echo "There is some problem in connection: " . $e->getMessage();
            }
            if (! empty($result)) {
                
                return $result;
            }else{
             ?><label style="color:red"><?php echo "No Checklist Registered";?> </label><?php 
            }

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