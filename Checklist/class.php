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
            
            $sql = "SELECT * FROM checklist
            inner join area
            on checklist.Aid = Area.Aid
            inner join phase 
            on area.Pid = phase.Pid
            inner join building 
            on phase.Bid = building.id
            ORDER BY checklist.Cid DESC";
            
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
    public function filteredreadData()
    {
        if($_POST['building'] == "All"){
            try {
             
                $dao = new Dao();
                
                $conn = $dao->openConnection();
                
                $sql = "SELECT * FROM checklist
                inner join area
                on checklist.Aid = Area.Aid
                inner join phase 
                on area.Pid = phase.Pid
                inner join building 
                on phase.Bid = building.id
                ORDER BY checklist.Cid ASC";
                
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
    
                    $sql = "SELECT * FROM checklist
                    inner join area
                    on checklist.Aid = Area.Aid
                    inner join phase 
                    on area.Pid = phase.Pid
                    inner join building 
                    on phase.Bid = building.id
                    WHERE checklist.Aid LIKE '".$area."' AND checklist.Bid LIKE '".$building."'  AND checklist.Pid LIKE '".$phase."'
                    ORDER BY checklist.Cid ASC";
                }else if($building != "" and $phase !="" and $area ="Select Area"){
    
                    $sql = "SELECT * FROM checklist
                    inner join area
                    on checklist.Aid = Area.Aid
                    inner join phase 
                    on area.Pid = phase.Pid
                    inner join building 
                    on phase.Bid = building.id
                    WHERE checklist.Bid LIKE '".$building."'  AND checklist.Pid LIKE '".$phase."'
                    ORDER BY checklist.Cid ASC";
                }
                else{
    
                    $sql = "SELECT * FROM checklist
                    inner join area
                    on checklist.Aid = Area.Aid
                    inner join phase 
                    on area.Pid = phase.Pid
                    inner join building 
                    on phase.Bid = building.id
                    WHERE checklist.Bid LIKE '".$building."'
                    ORDER BY checklist.Cid ASC";
                
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

    

     /* Fetch All */
     public function loadFilterBuilding()
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM Building
             
             ORDER BY id DESC";
             
             $resource = $conn->query($sql);
             
             $result = $resource->fetchAll(PDO::FETCH_ASSOC);
             
             $dao->closeConnection();
         } catch (PDOException $e) {
             
             echo "There is some problem in connection: " . $e->getMessage();
         }
         if (! empty($result)) {
             return $result;
         }
     }     /* Fetch All */

     public function loadFilterPhase($Bid)
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM Phase WHERE Bid=".$Bid."";
             
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
     public function loadFilterArea($Pid)
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM Area WHERE Pid=".$Pid."";
             
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
       
        $Bid=$_POST['Bid'];
        $Pid=$_POST['Pid'];
        $Name=$_POST['Name'];
        $area=$_POST['area'];
        $SOne=$_POST['SOne'];
        $STwo=$_POST['STwo'];
        $SThree=$_POST['SThree'];
        $STOne=$_POST['STOne'];
        $STTwo=$_POST['STTwo'];
        $STThree=$_POST['STThree'];
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "INSERT INTO checklist (Bid,Pid,Aid, CName, Sani_One, Sani_Two, Sani_Three, Stru_One,  Stru_Two,  Stru_Three)
             VALUES ('" . $Bid . "','" . $Pid . "','" . $area . "','" . $Name . "','" . $SOne . "','" . $STwo . "','" . $SThree . "','" . $STOne . "','" . $STTwo . "','" . $STThree . "')";
        $conn->query($sql);
        $dao->closeConnection();

    }
    
    /* Edit a Record */
    public function edit($formArray)
    {
        $id = $_POST['id'];
        $Bid = $_POST['Bid'];
        $Pid = $_POST['Pid'];
        $CName = $_POST['Name'];
        $Aid = $_POST['area'];
        $SOne = $_POST['SOne'];
        $STwo = $_POST['STwo'];
        $building = $_POST['building'];
        $SThree = $_POST['SThree'];
        $STOne = $_POST['STOne'];
        $STTwo = $_POST['STTwo'];
        $STThree = $_POST['STThree'];
        
        
        
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "UPDATE checklist SET Bid = '" . $Bid . "'
        ,Pid = '" . $Pid . "'
        ,Aid = '" . $Aid . "'
        ,CName = '" . $CName . "'
        ,Sani_One = '" . $SOne . "'
        ,Sani_Two = '" . $STwo . "'
        ,Sani_Three = '" . $SThree . "'
        ,Stru_One = '" . $STOne . "'
        ,Stru_Two = '" . $STTwo . "'
        ,Stru_Three = '" . $STThree . "'
        WHERE Cid=" . $id;
        
        $conn->query($sql);
        $dao->closeConnection();
    }

       /* Fetch Single Record by Id */
       public function readSingle($id)
       {
           try {
               
               $dao = new Dao();
               
               $conn = $dao->openConnection();
               
               $sql = "SELECT * FROM `Checklist` WHERE Cid=" . $id . " ORDER BY Cid DESC";
               
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

       /* Fetch Single Record by Id */
       public function changeArea($id)
       {
           try {
               
               $dao = new Dao();
               
               $conn = $dao->openConnection();
               
               $sql = "SELECT * FROM `area` left join phase on area.Pid = phase.Pid left join building on phase.Bid = building.id WHERE area.Aid=" . $id . " ORDER BY area.Aid DESC";
               
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
        
        $sql = "DELETE FROM `checklist` where Cid='$id'";
        
        $conn->query($sql);
        $dao->closeConnection();
    }
   

    function getDate(){
		$tz_oject = new DateTimeZone('Asia/manila');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_oject);
		return $datetime->format('Y-m-d');
	}

}

?>