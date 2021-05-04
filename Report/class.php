<?php
include_once 'Conn.php';
class CrudController
{ 
    
    function getDate(){
		$tz_oject = new DateTimeZone('Asia/manila');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_oject);
		return $datetime->format('Y-m-d');
    }
    
    function weekOfMonth($qDate) {
        $dt = strtotime($qDate);
        $day  = date('j',$dt);
        $month = date('m',$dt);
        $year = date('Y',$dt);
        $totalDays = date('t',$dt);
        $weekCnt = 1;
        $retWeek = 0;
        for($i=1;$i<=$totalDays;$i++) {
            $curDay = date("N", mktime(0,0,0,$month,$i,$year));
            if($curDay==7) {
                if($i==$day) {
                    $retWeek = $weekCnt+1;
                }
                $weekCnt++;
            } else {
                if($i==$day) {
                    $retWeek = $weekCnt;
                }
            }
        }
        return $retWeek;
    }

    /* Fetch All */
    public function showHistory()
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM checklist_grade 
            left join area on checklist_grade.Aid = area.Aid 
            left join phase on checklist_grade.Pid = phase.Pid 
            left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
            left join accounts on timedatephase.protect = accounts.Acid
            left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
            left join building on checklist_grade.Bid = building.id 
            where Accounts.AcName != ''
            Group By checklist_grade.Aid, checklist_grade.Date_checked
            ORDER BY checklist_grade.id DESC ";
            
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
    public function loadTagImage()
    {
        try {
            $pid = $_POST['pid'];
            $rid = $_POST['rid'];
            $date = $_POST['date'];
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM image_points 
            where Pid = '".$pid."' and Fid = '".$rid."'
            ORDER BY ipid DESC ";
            
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
    public function loadTagImageCorrection()
    {
        try {
            $crid = $_POST['crid'];
            $rid = $_POST['rid'];
            $date = $_POST['date'];
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM image_points_correction 
            where Fid = '".$rid."' and Crid = '".$crid."' and Date_Created = '".$date."'
            ORDER BY Ipcid DESC ";
            
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
    public function dashboard_viewitemfindings()
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM checklist_grade 
            left join area on checklist_grade.Aid = area.Aid 
            left join phase on checklist_grade.Pid = phase.Pid 
            left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
            left join accounts on timedatephase.protect = accounts.Acid
            left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
            left join building on checklist_grade.Bid = building.id 
            Group By checklist_grade.Aid, checklist_grade.Date_checked
            ORDER BY checklist_grade.Date_Checked DESC ";
            
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
      public function loaddropdownBuilding()
      {
          try {
              
              $dao = new Dao();
              
              $conn = $dao->openConnection();
              
              $sql = "SELECT * FROM timedatephase 
              left join building on timedatephase.Bid = building.id 
              Group By timedatephase.Bid
              ORDER BY timedatephase.Bid DESC ";
              
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

    
    public function showHistory_visor($date)
    {
        try {
            $AcName = $_POST['AcName'];
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM image_visor 
            left join area on image_visor.Aid = area.Aid 
            left join phase on area.Pid = phase.Pid 
            left join building on phase.Bid = building.id 
            left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
            where timedatephase_visor.qastaff  = '".$AcName."'
            Group By image_visor.Aid, image_visor.Date_checked
            ORDER BY image_visor.Date_Checked,image_visor.Aid DESC ";
            
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
     public function showCheckGrade($date)
     {
         try {
            $aid = $_POST['aid'];
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM checklist_grade 
             left join area on checklist_grade.Aid = area.Aid 
             left join phase on checklist_grade.Pid = phase.Pid 
             left join building on checklist_grade.Bid = building.id 
             left join equipment_grade on checklist_grade.Aid = equipment_grade.Aid
             where checklist_grade.Aid = '".$aid."' and checklist_grade.Date_Checked = '".$date."'
             Group By checklist_grade.Cid, checklist_grade.Date_checked
             ORDER BY checklist_grade.Date_Checked ASC ";
             
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
     public function showCheckGrade_image($date)
     {
         try {
            $cid = $_POST['cid'];
            $datechecked = $_POST['date'];
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM image 
             left join Area
             on image.Aid = area.Aid
             where Cid = '".$cid."' and Cid !='0000'and Date_Checked = '".$date."'
             ORDER BY Cid ASC ";
             
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
     public function showCheckGrade_image_equipment($date)
     {
         try {
            $eid = $_POST['eid'];
            $datechecked = $_POST['date'];
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM image 
             left join Area
             on image.Aid = area.Aid
             where Eid = '".$eid."' and Eid !='0000'and Date_Checked = '".$date."'
             ORDER BY Eid ASC ";
             
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
      public function showAllCheckGrade()
      {
          try {
              
              $dao = new Dao();
              
              $conn = $dao->openConnection();
              
              $sql = "SELECT * FROM checklist_grade 
              left join area on checklist_grade.Aid = area.Aid 
              left join phase on checklist_grade.Pid = phase.Pid 
              left join building on checklist_grade.Bid = building.id 
              left join equipment_grade on checklist_grade.Aid = equipment_grade.Aid
             Group By checklist_grade.Cid, checklist_grade.Date_checked
              ORDER BY checklist_grade.Date_Checked ASC ";
              
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
     public function showEquipGrade($date)
     {
         try {
            $aid = $_POST['aid'];
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM equipment_grade 
             left join area on equipment_grade.Aid = area.Aid 
             left join phase on area.Pid = phase.Pid
             left join building on building.id =phase.Bid
             left join equipment on equipment_grade.eid = equipment.eid 
             where equipment_grade.Aid = '".$aid."' and equipment_grade.Date_Checked_equipment = '".$date."'
            Group By equipment_grade.Eid, equipment_grade.Date_Checked_equipment
             ORDER BY equipment_grade.Date_Checked_equipment ASC ";
             
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
      public function loadFilterDate()
      {
          try {
              
              $dao = new Dao();
              
              $conn = $dao->openConnection();
              
              $sql = "SELECT * FROM checklist_grade 
              left join area on checklist_grade.Aid = area.Aid 
              left join phase on checklist_grade.Pid = phase.Pid 
              left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
              left join accounts on timedatephase.protect = accounts.Acid
              left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
              left join building on checklist_grade.Bid = building.id 
              where Accounts.AcName != ' '
              Group By checklist_grade.Date_Checked
              ORDER BY checklist_grade.Date_Checked ASC";
              
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

      
    //    HIstory Filter 
      /* Fetch All */
      public function loadFilterDashPhase()
      {
          try {
              
              $dao = new Dao();
              
              $conn = $dao->openConnection();
              
              $sql = "SELECT * FROM Phase
              ORDER BY Pid DESC";
              
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
      public function filterPhase_reports($building)
      {
          try {
              
              $dao = new Dao();
              
              $conn = $dao->openConnection();
              
              $sql = "SELECT * FROM Phase
              left join Building 
              ON phase.Bid = building.id
              WHERE Phase.Bid = '".$building."'
              ORDER BY Phase.Pid DESC";
              
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
      public function filterArea_reports($phase)
      {
          try {
              
              $dao = new Dao();
              
              $conn = $dao->openConnection();
              
              $sql = "SELECT * FROM checklist_grade
              left join Area on
              checklist_grade.Aid = area.Aid
              left join phase on
              checklist_grade.Pid = phase.Pid 
              WHERE Phase.Pid = '".$phase."'
              Group by Area.Aid
              ORDER BY Area.Aid ASC";
              
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

     public function changedata($pid)
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM checklist_grade 
             left join area on checklist_grade.Aid = area.Aid 
             left join phase on checklist_grade.Pid = phase.Pid 
             left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
             left join accounts on timedatephase.protect = accounts.Acid
             left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
             left join building on checklist_grade.Bid = building.id 
             WHERE checklist_grade.Pid = '".$pid."'
             Group By checklist_grade.Aid, checklist_grade.Date_checked,checklist_grade.Pid
             ORDER BY checklist_grade.Date_Checked DESC ";
             
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

     
     public function changedata_viewitemfindings($aid)
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM checklist_grade 
             left join area on checklist_grade.Aid = area.Aid 
             left join phase on checklist_grade.Pid = phase.Pid 
             left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
             left join accounts on timedatephase.protect = accounts.Acid
             left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
             left join building on checklist_grade.Bid = building.id 
             WHERE checklist_grade.Aid = '".$aid."'
             Group By checklist_grade.Aid, checklist_grade.Date_checked,checklist_grade.Pid
             ORDER BY checklist_grade.Date_Checked DESC ";
             
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
     
     public function changedata_viewitemfindings_equipment($area)
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM equipment_grade 
             left join area on equipment_grade.aid = area.Aid
             WHERE equipment_grade.aid = '".$area."' and equipment_grade.Name != 'No Equipment'
             Group By equipment_grade.aid, equipment_grade.Date_Checked_equipment
             ORDER BY equipment_grade.Date_Checked_equipment ASC";
             
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

      
     public function changedata_building_viewscores($bid)
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM checklist_grade 
             left join area on checklist_grade.Aid = area.Aid 
             left join phase on checklist_grade.Pid = phase.Pid 
             left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
             left join accounts on timedatephase.protect = accounts.Acid
             left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
             left join building on checklist_grade.Bid = building.id 
             WHERE checklist_grade.Bid = '".$bid."'
             Group By checklist_grade.Bid, checklist_grade.Date_checked
             ORDER BY checklist_grade.Date_Checked DESC ";
             
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
     
     public function changedate_viewitemfindings_equipment($date)
     {
         try {
             
            $area = $_POST['area'];
            $phase = $_POST['phase'];
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM equipment_grade 
             left join area on equipment_grade.aid = area.Aid
             left join phase on area.Pid = phase.Pid
             WHERE area.Pid = '".$phase."' and equipment_grade.Name != 'No Equipment' and equipment_grade.Date_Checked_equipment ='".$date."'
             Group By equipment_grade.aid, equipment_grade.Date_Checked_equipment
             ORDER BY equipment_grade.Date_Checked_equipment ASC";
             
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

     
     public function changedate($date)
     {
         try {
             $phase = $_POST['phase'];
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM checklist_grade 
             left join area on checklist_grade.Aid = area.Aid 
             left join phase on checklist_grade.Pid = phase.Pid 
             left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
             left join accounts on timedatephase.protect = accounts.Acid
             left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
             left join building on checklist_grade.Bid = building.id 
             WHERE checklist_grade.Pid = '".$phase."' and checklist_grade.Date_checked = '".$date."'
             Group By checklist_grade.Aid, checklist_grade.Date_checked,checklist_grade.Pid
             ORDER BY checklist_grade.Date_Checked DESC ";
             
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

     
     public function changedate_viewitemfindings($date)
     {
         try {
             $area = $_POST['area'];
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM checklist_grade 
             left join area on checklist_grade.Aid = area.Aid 
             left join phase on checklist_grade.Pid = phase.Pid 
             left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
             left join accounts on timedatephase.protect = accounts.Acid
             left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
             left join building on checklist_grade.Bid = building.id 
             WHERE checklist_grade.Aid = '".$area."' and checklist_grade.Date_checked = '".$date."'
             Group By checklist_grade.Aid, checklist_grade.Date_checked,checklist_grade.Pid
             ORDER BY checklist_grade.Date_Checked DESC ";
             
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
     
      
     public function changedate_building_viewscores($date)
     {
         try {
             
            $bid = $_POST['building'];
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM checklist_grade 
             left join area on checklist_grade.Aid = area.Aid 
             left join phase on checklist_grade.Pid = phase.Pid 
             left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
             left join accounts on timedatephase.protect = accounts.Acid
             left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
             left join building on checklist_grade.Bid = building.id 
             WHERE checklist_grade.Bid = '".$bid."' and checklist_grade.Date_checked = '".$date."'
             Group By checklist_grade.Bid, checklist_grade.Date_checked
             ORDER BY checklist_grade.Date_Checked DESC ";
             
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
     
      
      public function loadFilterDate_visor()
      {
          try {
              
              $dao = new Dao();
              
              $conn = $dao->openConnection();
              
              $sql = "SELECT * FROM image_visor
              GROUP BY Date_Checked
              ORDER BY Date_Checked DESC";
              
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
     public function loadFilterBuilding()
     {    $date=$_POST['date'];
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM checklist_grade 
             Left JOin Building on checklist_grade.Bid = building.id
             Where checklist_grade.Date_Checked = '".$date."'
             Group By building.Name
             ORDER BY building.Name ASC";
             
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
     public function loadFilterBuilding_visor()
     {    $date=$_POST['date'];
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM image_visor 
             left join area on image_visor.Aid = area.Aid 
             left join phase on image_visor.Pid = phase.Pid 
            left join building on image_visor.Bid = building.id 
             WHERE image_visor.Date_Checked LIKE '".$date."'
             Group By image_visor.Bid, image_visor.Date_checked
             ORDER BY image_visor.Aid DESC";
             
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
     public function loadCreateRecordData($qa)
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM remarkpoints
             WHERE qastaff='".$qa."'
             ORDER BY Fid DESC";
             
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
     
     public function loadCreateRecordData_Manager()
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM remarkpoints
             GROUP BY title
             
             ORDER BY Fid DESC";
             
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

     
     public function loadCreateRecordRemarksData($fidrem)
     
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM remarkpoints_detailed where Fid = '".$fidrem."'  and type ='Corrective'
             ORDER BY Fid DESC";
             
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
 
     public function loadremarksresultcompliance($fidrem)
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM remarkpoints_detailed left join remarkpoints_detailed_complianceremarks on remarkpoints_detailed.Rid = remarkpoints_detailed_complianceremarks.complianceid where remarkpoints_detailed.Fid = '".$fidrem."'and remarkpoints_detailed.category  ='compliance'
             GROUP BY remarkpoints_detailed.compliance_concern
             ORDER BY remarkpoints_detailed.Fid DESC";
             
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

     
     public function loadremarksresultcomplianceremarks($complianceid)
     {
         try {
             $date=$_POST['date'];
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM remarkpoints_detailed_complianceremarks where complianceid = '".$complianceid."'and Date_Created  = '".$date."'
             
             ORDER BY complianceid DESC";
             
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

     
     
     public function loadCreateRecordCorrectiveData($Rid)
     {
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             $sql = "SELECT * FROM remarkpoints_detailed_correction where Rid = '".$Rid."' and CorrectionDetails != ''
             
             ORDER BY Crid DESC";
             
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

     public function filterReports_checklist()
     {
          $area= $_POST['area'];
          $phase= $_POST['phase'];
          $start_auditreport = date('Y-m-d',strtotime($_POST['start_auditreport']));
          $end_auditreport= date('Y-m-d',strtotime($_POST['end_auditreport']));
         $type= $_POST['type'];
         
 
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
            
             
           if($phase != "" and $area =="" and $start_auditreport =="" and $end_auditreport==""){

                // $sql = "SELECT * FROM area  where Pid = '".$phase."' GROUP BY Aid";


                $sql = "SELECT * FROM checklist_grade 
                left join area on checklist_grade.Aid = area.Aid 
                left join phase on checklist_grade.Pid = phase.Pid 
                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                left join building on checklist_grade.Bid = building.id 
                WHERE checklist_grade.Pid ='".$phase."' and checklist_grade.Date_Checked LIKE '0'
                Group By checklist_grade.Aid
                ORDER BY area.Aid ASC";
                echo "Please Select Date";
            }
             else if($phase != "" and $area =="" and $start_auditreport !="" and $end_auditreport !=""){
 
                $sql = "SELECT * FROM checklist_grade 
                left join area on checklist_grade.Aid = area.Aid 
                left join phase on checklist_grade.Pid = phase.Pid 
                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                left join building on checklist_grade.Bid = building.id 
                WHERE checklist_grade.Pid ='".$phase."' and checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."'
                Group By checklist_grade.Aid,  checklist_grade.Date_Checked
                ORDER BY area.Aid ASC";
                
            }
            else{

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
         }
     }

     public function filterReports_checklist_firstoffense_str()
     {
          $area= $_POST['area'];
          $phase= $_POST['phase'];
          $start_auditreport = date('Y-m-d',strtotime($_POST['start_auditreport']));
          $end_auditreport= date('Y-m-d',strtotime($_POST['end_auditreport']));
         $type= $_POST['type'];
         
 
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
            
             
           if($phase != "" and $area =="" and $start_auditreport =="" and $end_auditreport==""){

                // $sql = "SELECT * FROM area  where Pid = '".$phase."' GROUP BY Aid";


                $sql = "SELECT * FROM checklist_grade 
                left join area on checklist_grade.Aid = area.Aid 
                left join phase on checklist_grade.Pid = phase.Pid 
                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                left join building on checklist_grade.Bid = building.id 
                WHERE checklist_grade.Pid ='".$phase."' and checklist_grade.Date_Checked LIKE '0' and checklist_grade.Str_Grade = 75
                Group By checklist_grade.Aid
                ORDER BY area.Aid ASC";
                echo "Please Select Date";
            }
             else if($phase != "" and $area =="" and $start_auditreport !="" and $end_auditreport !=""){
 
                $sql = "SELECT * FROM checklist_grade 
                left join area on checklist_grade.Aid = area.Aid 
                left join phase on checklist_grade.Pid = phase.Pid 
                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                left join building on checklist_grade.Bid = building.id 
                WHERE checklist_grade.Pid ='".$phase."' and checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."' and checklist_grade.Str_Grade = 75
                Group By checklist_grade.Aid,  checklist_grade.Date_Checked
                ORDER BY area.Aid ASC";
                
            }
            else{

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
         }
     }
     public function filterReports_checklist_equipment()
     {
          $area= $_POST['area'];
          $phase= $_POST['phase'];
         $type= $_POST['type'];
         $start_auditreport = date('Y-m-d',strtotime($_POST['start_auditreport']));
         $end_auditreport= date('Y-m-d',strtotime($_POST['end_auditreport']));
       
         
 
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
            
          if($phase != "" and $area =="" and  $start_auditreport !="" and $end_auditreport!=""){
 
                $sql = "SELECT * FROM equipment_grade 
                left join area on equipment_grade.aid = area.Aid
                left join phase on equipment_grade.pid = phase.Pid
                left join timedatephase on equipment_grade.pid = timedatephase.pid and equipment_grade.Date_Checked_equipment = timedatephase.date_checked 
                left join accounts on timedatephase.protect = accounts.Acid
                WHERE equipment_grade.pid = '".$phase."' and equipment_grade.Name != 'No Equipment' and equipment_grade.Date_Checked_equipment >='".$start_auditreport."' and equipment_grade.Date_Checked_equipment <='".$end_auditreport."' 
                Group By equipment_grade.aid, equipment_grade.Date_Checked_equipment
                ORDER BY equipment_grade.aid,equipment_grade.Date_Checked_equipment DESC";
                
            }
            else{

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
         }
     }
     public function filterReports_checklist_equipment_firstoffense()
     {
          $area= $_POST['area'];
          $phase= $_POST['phase'];
         $type= $_POST['type'];
         $start_auditreport = date('Y-m-d',strtotime($_POST['start_auditreport']));
         $end_auditreport= date('Y-m-d',strtotime($_POST['end_auditreport']));
       
         
 
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
            
          if($phase != "" and $area =="" and  $start_auditreport !="" and $end_auditreport!=""){
 
                $sql = "SELECT * FROM equipment_grade 
                left join area on equipment_grade.aid = area.Aid
                left join phase on equipment_grade.pid = phase.Pid
                left join timedatephase on equipment_grade.pid = timedatephase.pid and equipment_grade.Date_Checked_equipment = timedatephase.date_checked 
                left join accounts on timedatephase.protect = accounts.Acid
                WHERE equipment_grade.egrade = 75 and equipment_grade.pid = '".$phase."' and equipment_grade.Name != 'No Equipment' and equipment_grade.Date_Checked_equipment >='".$start_auditreport."' and equipment_grade.Date_Checked_equipment <='".$end_auditreport."' 
                Group By equipment_grade.aid, equipment_grade.Date_Checked_equipment
                ORDER BY equipment_grade.aid,equipment_grade.Date_Checked_equipment DESC";
                
            }
            else{

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
         }
     }

     public function filterreports()
     {
         $building= $_POST['building'];
         $phase= $_POST['phase'];
        //  $date= $_POST['date'];
         $start_auditreport = date('Y-m-d',strtotime($_POST['start_auditreport']));
         $end_auditreport= date('Y-m-d',strtotime($_POST['end_auditreport']));
         
 
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
            
              if($building != "" and $phase !="" and $start_auditreport !="" and $end_auditreport !=""){
                $sql = "SELECT * FROM checklist_grade 
                left join area on checklist_grade.Aid = area.Aid 
                left join phase on checklist_grade.Pid = phase.Pid 
                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                left join building on checklist_grade.Bid = building.id 
                where Accounts.AcName != ' ' AND checklist_grade.Bid LIKE  '".$building."' and checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."'
                Group By checklist_grade.Pid, checklist_grade.Date_checked
                ORDER BY checklist_grade.Pid ASC";

             }else if($building != "" and $phase =="" and $start_auditreport !="" and $end_auditreport !=""){
                $sql = "SELECT * FROM checklist_grade 
                left join area on checklist_grade.Aid = area.Aid 
                left join phase on checklist_grade.Pid = phase.Pid 
                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                left join building on checklist_grade.Bid = building.id 
                where Accounts.AcName != ' ' AND checklist_grade.Bid LIKE  '".$building."' and checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."'
                Group By checklist_grade.Pid, checklist_grade.Date_checked
                ORDER BY checklist_grade.Pid ASC";

             }
             else{

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
         }
     }

     
     
     public function filterreportave()
     {
         $building= $_POST['building'];
          $phase= $_POST['phase'];
        //  $date= $_POST['date'];
         $start_auditreport = date('Y-m-d',strtotime($_POST['start_auditreport']));
         $end_auditreport= date('Y-m-d',strtotime($_POST['end_auditreport']));
         
 
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
            
           if($building != "" and $phase =="" and $start_auditreport =="" and $end_auditreport==""){
 
                $sql = "SELECT * FROM checklist_grade 
                left join area on checklist_grade.Aid = area.Aid 
                left join phase on checklist_grade.Pid = phase.Pid 
                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                left join building on checklist_grade.Bid = building.id 
                where Accounts.AcName != ' ' AND checklist_grade.Bid LIKE  '".$building."'
                Group By checklist_grade.Pid, checklist_grade.Date_checked
                ORDER BY checklist_grade.Pid ASC";
                
            }else if($building != "" and $phase =="" and $start_auditreport !="" and $end_auditreport !=""){
                $sql = "SELECT * FROM checklist_grade 
                left join area on checklist_grade.Aid = area.Aid 
                left join phase on checklist_grade.Pid = phase.Pid 
                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                left join building on checklist_grade.Bid = building.id 
                where Accounts.AcName != ' ' AND checklist_grade.Bid LIKE  '".$building."' and checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."'
                Group By checklist_grade.Pid, checklist_grade.Date_checked
                ORDER BY checklist_grade.Pid ASC";

             }
             else{

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
         }
     }

     public function filterreports_phase()
     {
         try {
             
            $building= $_POST['building'];
            $phase= $_POST['phase'];
            $start_auditreport = date('Y-m-d',strtotime($_POST['start_auditreport']));
            $end_auditreport= date('Y-m-d',strtotime($_POST['end_auditreport']));
            
             $dao = new Dao();
             
             $conn = $dao->openConnection();
             
             if($building != "" and $phase !="" and $start_auditreport =="" and $end_auditreport ==""){
                $sql = "SELECT * FROM checklist_grade 
                left join area on checklist_grade.Aid = area.Aid 
                left join phase on checklist_grade.Pid = phase.Pid 
                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                left join building on checklist_grade.Bid = building.id 
                where Accounts.AcName != '' and  checklist_grade.Pid LIKE '".$phase."'
                Group By checklist_grade.Aid, checklist_grade.Date_checked
                ORDER BY checklist_grade.Aid ASC ";

             }else if($building != "" and $phase !="" and $start_auditreport !="" and $end_auditreport !="" ){
                $sql = "SELECT * FROM checklist_grade 
                left join area on checklist_grade.Aid = area.Aid 
                left join phase on checklist_grade.Pid = phase.Pid 
                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                left join building on checklist_grade.Bid = building.id 
                where Accounts.AcName != '' and  checklist_grade.Pid LIKE '".$phase."' AND checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."'
                Group By checklist_grade.Aid, checklist_grade.Date_checked
                ORDER BY checklist_grade.Aid ASC ";
             }
             
             
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

     public function filteredreadData()
     {
          $building= $_POST['building'];
          $phase= $_POST['phase'];
          $area= $_POST['area'];
          $date= $_POST['date'];
    
         
 
         try {
             
             $dao = new Dao();
             
             $conn = $dao->openConnection();
            
           if($date != "" and $building != "" and $phase !="" and $area !=""){
 
                $sql = "SELECT * FROM checklist_grade 
                left join area on checklist_grade.Aid = area.Aid 
                left join phase on checklist_grade.Pid = phase.Pid 
                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                left join accounts on timedatephase.protect = accounts.Acid
                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                left join building on checklist_grade.Bid = building.id 
                where Accounts.AcName != ' 'and checklist_grade.Date_Checked LIKE '".$date."' AND checklist_grade.Bid LIKE  '".$building."' AND checklist_grade.Pid LIKE '".$phase."' AND checklist_grade.Aid LIKE '".$area."'
                Group By checklist_grade.Aid, checklist_grade.Date_checked
                ORDER BY checklist_grade.Aid ASC";
                
            }
            else if($date != "" and $building != "" and $phase !="" and $area ="Select Area"){
 
                 $sql = "SELECT * FROM checklist_grade 
                 left join area on checklist_grade.Aid = area.Aid 
                 left join phase on checklist_grade.Pid = phase.Pid 
                 left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                 left join accounts on timedatephase.protect = accounts.Acid
                 left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                 left join building on checklist_grade.Bid = building.id 
                 where Accounts.AcName != ''and checklist_grade.Date_Checked LIKE '".$date."' AND checklist_grade.Bid LIKE  '".$building."' AND checklist_grade.Pid LIKE '".$phase."'
                 Group By checklist_grade.Aid, checklist_grade.Date_checked
                 ORDER BY checklist_grade.Aid ASC";
 
             }
             else if($date != "" and $building != "" and $phase ="Select Phase"){
  
                 $sql = "SELECT * FROM checklist_grade 
                 left join area on checklist_grade.Aid = area.Aid 
                 left join phase on checklist_grade.Pid = phase.Pid 
                 left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                 left join accounts on timedatephase.protect = accounts.Acid
                 left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                 left join building on checklist_grade.Bid = building.id 
                 where Accounts.AcName != ''and checklist_grade.Date_Checked LIKE '".$date."' AND checklist_grade.Bid LIKE  '".$building."'
                 Group By checklist_grade.Aid, checklist_grade.Date_checked
                 ORDER BY checklist_grade.Aid ASC";
                 
             }
             
             else if($date != "" and $building = "" and $phase ="" and $area =""){
 
             $sql = "SELECT * FROM checklist_grade 
             left join area on checklist_grade.Aid = area.Aid 
             left join phase on checklist_grade.Pid = phase.Pid 
             left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
             left join accounts on timedatephase.protect = accounts.Acid
             left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
             left join building on checklist_grade.Bid = building.id 
             where Accounts.AcName != ''and checklist_grade.Date_Checked LIKE '".$date."'
             Group By checklist_grade.Aid, checklist_grade.Date_checked
             ORDER BY checklist_grade.Aid ASC";
             }  
              
 
             else{
 
                 $sql = "SELECT * FROM checklist_grade 
                 left join area on checklist_grade.Aid = area.Aid 
                 left join phase on checklist_grade.Pid = phase.Pid 
                 left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                 left join accounts on timedatephase.protect = accounts.Acid
                 left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                 left join building on checklist_grade.Bid = building.id 
                 where Accounts.AcName != ''and checklist_grade.Date_Checked LIKE '".$date."'
                 Group By checklist_grade.Aid, checklist_grade.Date_checked
                 ORDER BY checklist_grade.Aid ASC";
             
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
         }
     }

     

    public function filteredreadData_visor()
    {
         $building= $_POST['building'];
         $phase= $_POST['phase'];
         $area= $_POST['area'];
        if(isset($_POST['date'])){
            $date= $_POST['date'];
        }else{
            $date= $_POST['date'];
        }
        

        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            if($date != ""and $building  == ""and $phase  == ""and $area  == ""){
 
                $sql = "SELECT * FROM image_visor 
                left join area on image_visor.Aid = area.Aid 
                left join phase on image_visor.Pid = phase.Pid 
               left join building on image_visor.Bid = building.id 
               left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
                WHERE image_visor.Date_Checked LIKE '".$date."'
                Group By image_visor.Aid, image_visor.Date_checked
                ORDER BY image_visor.Aid DESC";
                
            }
            else if($date != ""and $building  == "Select Building"){
 
                $sql = "SELECT * FROM image_visor 
                left join area on image_visor.Aid = area.Aid 
                left join phase on image_visor.Pid = phase.Pid 
               left join building on image_visor.Bid = building.id 
               left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
                WHERE image_visor.Date_Checked LIKE '".$date."'
                Group By image_visor.Aid, image_visor.Date_checked
                ORDER BY image_visor.Aid DESC";
                
            }
            else if($date != "" and $building != "" and $phase !="" and $area !=""){
 
                $sql = "SELECT * FROM image_visor 
                left join area on image_visor.Aid = area.Aid 
                left join phase on image_visor.Pid = phase.Pid 
               left join building on image_visor.Bid = building.id 
               left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
                WHERE image_visor.Date_Checked LIKE '".$date."' AND image_visor.Bid LIKE  '".$building."' AND image_visor.Pid LIKE '".$phase."' AND image_visor.Aid LIKE '".$area."'
                Group By image_visor.Aid, image_visor.Date_checked
                ORDER BY image_visor.Aid DESC";
                
            }    
            else if($date != "" and $building != "" and $phase !="" and $area ="Select Area"){
 
                $sql = "SELECT * FROM image_visor 
                left join area on image_visor.Aid = area.Aid 
                left join phase on image_visor.Pid = phase.Pid 
               left join building on image_visor.Bid = building.id 
               left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
                WHERE image_visor.Date_Checked LIKE '".$date."' AND image_visor.Bid LIKE  '".$building."' AND image_visor.Pid LIKE '".$phase."'
                Group By image_visor.Aid, image_visor.Date_checked
                ORDER BY image_visor.Aid DESC";
                
            }
             
            else if($date != "" and $building != "" and $phase ="Select Phase" and $area =""){
 
                $sql = "SELECT * FROM image_visor 
                left join area on image_visor.Aid = area.Aid 
                left join phase on image_visor.Pid = phase.Pid 
               left join building on image_visor.Bid = building.id 
               left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
                WHERE image_visor.Date_Checked LIKE '".$date."' AND image_visor.Bid LIKE  '".$building."'
                Group By image_visor.Aid, image_visor.Date_checked
                ORDER BY image_visor.Aid DESC";
                
            }
            
            else if($date != "" and $building != "" and $phase =="Select Phase" and $area ==""){
 
                $sql = "SELECT * FROM image_visor 
                left join area on image_visor.Aid = area.Aid 
                left join phase on image_visor.Pid = phase.Pid 
               left join building on image_visor.Bid = building.id 
               left join timedatephase_visor on phase.Pid = timedatephase_visor.Pid
                WHERE image_visor.Date_Checked LIKE '".$date."' AND image_visor.Bid LIKE  '".$building."'
                Group By image_visor.Aid, image_visor.Date_checked
                ORDER BY image_visor.Aid DESC";
                
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
        }
    }

    

    

    public function loadFilterPhase($Bid)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM Phase left join Building on phase.Bid = building.id WHERE Bid=".$Bid."";
            
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

    public function loadGetBuildingFromPhase($Pid)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM Phase WHERE Pid=".$Pid."";
            
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

    // Create Report

    public function readSingle($id)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM `remarkpoints` WHERE Fid=" . $id . " ORDER BY Fid DESC";
            
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
    
    public function readSingleRemarks($id)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM `remarkpoints_detailed` WHERE Rid=" . $id . " ORDER BY Rid DESC";
            
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
    public function readSingleCorrection($id)
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM `remarkpoints_detailed_correction` WHERE Crid=" . $id . " ORDER BY Crid DESC";
            
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

    
    /* Edit a Record */
    public function edit($formArray)
    {
        $Fid = $_POST['Fid'];
        $Title = $_POST['Title'];
        $BuildingRecord = $_POST['BuildingRecord'];
        $phase = $_POST['phase'];
        $Week = $_POST['Week'];
        $monthYr = $_POST['monthYr'];
        
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "UPDATE remarkpoints SET Bid = '" . $BuildingRecord . "'
        ,Pid = '" . $phase . "'
        ,Title = '" . $Title . "'
        ,Week = '" . $Week . "'
        ,Month = '" . $monthYr . "'
        WHERE Fid=" . $Fid;
        
        $conn->query($sql);
        $dao->closeConnection();
    }

    
    /* Edit a Record */
    public function editRemarks($formArray)
    {
        $Rid = $_POST['RidCorrective'];
        $GBPoints = $_POST['GBPoints'];
        $Specific = $_POST['Specific'];
        $Corrective = $_POST['Corrective'];
        $recommendation = $_POST['recommendation'];
        
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "UPDATE remarkpoints_detailed SET MainRemarks = '" . $GBPoints . "'
        ,SpecificRemarks = '" . $Specific . "'
        ,CorrectiveAction = '" . $Corrective . "'
        ,recommendation = '" . $recommendation . "'
        WHERE Rid=" . $Rid;
        
        $conn->query($sql);
        $dao->closeConnection();
    }

    
    /* Edit a Record */
    public function editCorrection($formArray)
    {
        $CridCorrection = $_POST['CridCorrection'];
        $Rid = $_POST['RidCorrection'];
        $GBPoints = $_POST['GBPointsCorrection'];
        $Specific = $_POST['SpecificCorrection'];
        $Correction = $_POST['Correction'];
        
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "UPDATE remarkpoints_detailed_correction SET CorrectionDetails = '" . $Correction . "'
        
        WHERE Crid=" . $CridCorrection;
        
        $conn->query($sql);
        $dao->closeConnection();
    }

/* Delete a Record */
public function delete($id)
{
    $dao = new Dao();
    
    $conn = $dao->openConnection();
    
    $sql = "DELETE FROM `remarkpoints` where Fid='$id'";
    
    $conn->query($sql);
    $dao->closeConnection();
}
/* Delete a Record */
public function deleteremarks($id)
{
    $dao = new Dao();
    
    $conn = $dao->openConnection();
    
    $sql = "DELETE FROM `remarkpoints_detailed` where Rid='$id'";
    
    $conn->query($sql);
    $dao->closeConnection();
}

public function deletecomplianceremarks($id)
{
    $dao = new Dao();
    
    $conn = $dao->openConnection();
    
    $sql = "DELETE FROM `remarkpoints_detailed_complianceremarks` where Crid='$id'";
    
    $conn->query($sql);
    $dao->closeConnection();
}
/* Delete a Record */
public function deletecorrection($id)
{
    $dao = new Dao();
    
    $conn = $dao->openConnection();
    
    $sql = "DELETE FROM `remarkpoints_detailed_correction` where Crid='$id'";
    
    $conn->query($sql);
    $dao->closeConnection();
}


public function GetWeekReport($title)
{
    try {
        
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "SELECT * FROM remarkpoints Where remarkpoints.Title = '$title'";
        
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




}

?>