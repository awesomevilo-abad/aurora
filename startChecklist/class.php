<?php
include_once 'Conn.php';
class CrudController
{ 
    
    /* Fetch All */
    public function viewBuilding($id)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM Building
            where Category='" . $id . "' 
            ORDER BY Category DESC";
            
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
        public function viewRecord()
        {
            try {
                
                $dao = new Dao();
                
                $conn = $dao->openConnection();
                
                $sql = "SELECT * FROM checklist_grade 
                inner join area 
                on checklist_grade.Aid = area.Aid
                inner join phase 
                on area.Pid = phase.Pid
                GROUP BY phase.Pid
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
        }
    
    /* Fetch All */
    public function viewCat($id)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM Building
            where Category='" . $id . "' 
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
    }

    public function showUser($id)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM `area_staff` inner join accounts on area_staff.sid = accounts.Acid where accounts.Position = 'protect' AND area_staff.aid=" . $id . " ORDER BY accounts.Acid DESC";
            
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

    public function showAllUser()
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM `area_staff` inner join accounts on area_staff.sid = accounts.Acid where accounts.Position = 'protect' ORDER BY accounts.Acid DESC";
            
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

    public function processpass()
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM `accounts` where Position = 'protect' ORDER BY Acid DESC";
            
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
    public function viewChecklist()
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM Area
            ORDER BY Aid DESC";
            
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
    public function viewPhase($id)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM Phase WHERE Bid='" . $id . "' ORDER BY Pid ASC";
            
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
   
  
    /* Fetch All */
    public function viewPhase2($id)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM Phase WHERE Pid=" . $id . " ORDER BY Pid DESC";
            
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
    public function viewConfirmPhase($id)
    {
        try {
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM Phase
            WHERE Pid=" . $id."";
            
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
       public function showphaseUser($id)
       {
           try {
               
               $dao = new Dao();
               
               $conn = $dao->openConnection();
               
               $sql = "SELECT * FROM accounts
               left join user_phase on
               accounts.Acid = user_phase.sid
               left join phase
               on user_phase.pid = phase.Pid
               where user_phase.pid = '".$id."'
               Group by  accounts.Acid
               ORDER BY accounts.Acid DESC";

               
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

    //    HIstory Filter 
    
   
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
    /* Fetch All */


}

?>