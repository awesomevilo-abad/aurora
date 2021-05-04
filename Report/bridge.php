<?php
    include_once 'class.php';
    $crudcontroller = new CrudController();
    switch($_POST["type"]) {
    
    

        case "history":
            $result = $crudcontroller->showHistory();
            require_once "history_process.php";
            break;
            
        default:
            break;
            
        case "dashboard":
            $result = $crudcontroller->filterreports_phase();
            require_once "dashboard_table_grade.php";
            break;
            

        case "history_visor":
            $result = $crudcontroller->showHistory_visor($_POST['date']);
            require_once "history_process_visor.php";
            break;
        
        case "weekDate":
            $result = $crudcontroller->weekOfMonth($_POST['date']);
            // require_once "../CreateRecord.php";
            echo $result;
            break;
            

        case "checklistgradetable":
            $result = $crudcontroller->showCheckGrade($_POST['date']);
            require_once "checklist_grade_table.php";
            // print_r($result);
        break;
        
        case "checklistgradetable_image":
            $result = $crudcontroller->showCheckGrade_image($_POST['date']);
            require_once "checklist_grade_table_image.php";
            // print_r($result);
        break;
        
        case "checklistgradetable_image_equipment":
            $result = $crudcontroller->showCheckGrade_image_equipment($_POST['date']);
            require_once "checklist_grade_table_image_equipment.php";
            // print_r($result);
        break;
         

        case "checklistgradetable_visor":
            $result = $crudcontroller->showCheckGrade($_POST['date']);
            require_once "checklist_grade_table_visor.php";
            // print_r($result);
            break;
        

         case "filtered":
             $result = $crudcontroller->filteredreadData();
             require_once "checklist_grade_table_Filtered.php";
             break;
            
             

         case "filterreports":
            if(isset($_POST['start_auditreport']) OR isset($_POST['end_auditreport']))
             $result = $crudcontroller->filterreports($_POST['start_auditreport'],$_POST['end_auditreport']);
             require_once "Report_filterreports.php";
             break;
            
            

         case "filterreportave":
            if(isset($_POST['start_auditreport']) OR isset($_POST['end_auditreport']))
             $result = $crudcontroller->filterreportave($_POST['start_auditreport'],$_POST['end_auditreport']);
             require_once "checklist_grade_table_averagecount.php";
             break;
            
           
         case "sanitation":
             $result = $crudcontroller->filterReports_checklist();
             require_once "Report_filterreports_checklist.php";
             break;
           
         case "sanitationremarks":
             $result = $crudcontroller->filterReports_checklist();
             require_once "Report_filterreports_checklist_sanitationremarks.php";
             break;
                 
         case "structural":
             $result = $crudcontroller->filterReports_checklist();
             require_once "Report_filterreports_checklist_structural.php";
             break;
       
                   
         case "firstoffensestr":
             $result = $crudcontroller->filterReports_checklist_firstoffense_str();
             require_once "Report_filterreports_checklist_structural_firstoffense.php";
             break;
        
         case "equipment":
                $result = $crudcontroller->filterReports_checklist_equipment();
                require_once "Report_filterreports_checklist_equipment.php";
          
           break;
           
                   
         case "firstoffense":
                $result = $crudcontroller->filterReports_checklist_equipment_firstoffense();
                require_once "Report_filterreports_checklist_equipment_firstoffense.php";
          
           break;
             
         case "filtered_visor":
             $result = $crudcontroller->filteredreadData_visor();
             require_once "checklist_grade_table_Filtered_visor.php";
             break;
                 

         case "loadCreateRecordData":
             $result = $crudcontroller->loadCreateRecordData();
             require_once "MasterRecordTable.php";
             break;
        
         case "single":
            
            if(isset($_POST["id"])) {
                $result = $crudcontroller->readSingle($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["Fid"] = $result[0]["Fid"];
                    $responseArray["Bid"] = $result[0]["Bid"];
                    $responseArray["Pid"] = $result[0]["Pid"];
                    $responseArray["Title"] = $result[0]["Title"];
                    $responseArray["Week"] = $result[0]["Week"];
                    $responseArray["Month"] = $result[0]["Month"];
                    echo json_encode($responseArray);
                }
            }
         break;

         
         case "singleremarks":
            
            if(isset($_POST["id"])) {
                $result = $crudcontroller->readSingleRemarks($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["Rid"] = $result[0]["Rid"];
                    $responseArray["Fid"] = $result[0]["Fid"];
                    $responseArray["Pid"] = $result[0]["Pid"];
                    $responseArray["GBPoints"] = $result[0]["MainRemarks"];
                    $responseArray["Specific"] = $result[0]["SpecificRemarks"];
                    $responseArray["Corrective"] = $result[0]["CorrectiveAction"];
                    $responseArray["recommendation"] = $result[0]["recommendation"];
                    echo json_encode($responseArray);
                }
            }
         break;
            
         case "singleCorrection":
            
            if(isset($_POST["id"])) {
                $result = $crudcontroller->readSingleCorrection($_POST["id"]);
                if(!empty($result)) {
                    $responseArray["Crid"] = $result[0]["Crid"];
                    $responseArray["CorrectionDetails"] = $result[0]["CorrectionDetails"];
                    echo json_encode($responseArray);
                }
            }
         break;

         
        case "report":
            $qa = $_POST['qa'];
            $result = $crudcontroller->loadCreateRecordData($qa);
            require_once "MasterRecordTable.php";
            break;
            
        case "reportManager":

            $result = $crudcontroller->loadCreateRecordData_Manager();
            require_once "MasterRecordTable_QAManager.php";
            break;
            
        case "TagImage":

            $result = $crudcontroller->loadTagImage($_POST['pid']);
            require_once "viewTagImage.php";
            break;
             
        case "TagImageCorrection":

            $result = $crudcontroller->loadTagImageCorrection($_POST['rid']);
            require_once "viewTagImageCorrection.php";
            break;
            
        case "remarksreport":
            if(isset($_POST["fid"])) {
                $result = $crudcontroller->loadCreateRecordRemarksData($_POST['fid']);
                require_once "MasterRecordRemarksTable.php";
                break;
            }
            
        case "remarksresultcompliance":
        if(isset($_POST["fid"])) {
                $result = $crudcontroller->loadremarksresultcompliance($_POST['fid']);
                require_once "MasterRecordComplianceTable.php";
                break;
            }
            
        case "remarksresultcomplianceremarks":
        if(isset($_POST["complianceid"])) {
                $result = $crudcontroller->loadremarksresultcomplianceremarks($_POST['complianceid']);
                require_once "MasterRecordComplianceRemarksTable.php";
                break;
            }
            
        case "remarksreportCorrection":
            if(isset($_POST["rid"])) {
                $result = $crudcontroller->loadCreateRecordCorrectiveData($_POST['rid']);
                require_once "MasterRecordCorrectiveTable.php";
                break;
            }
        
        case "delete":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->delete($_POST["id"]);
                require_once "MasterRecordTable.php";
                // header("Location:MasterRecordTable.php");
            }
            
        case "deleteremarks":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->deleteremarks($_POST["id"]);
                require_once "MasterRecordRemarksTable.php";
                // header("Location:MasterRecordTable.php");
            }

        break;

        
        case "deletecomplianceremarks":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->deletecomplianceremarks($_POST["id"]);
                require_once "MasterRecordComplianceRemarksTable.php";
                // header("Location:MasterRecordTable.php");
            }

        break;

        
            
        case "deletecorrection":
            if(isset($_POST["id"])) {
                $result = $crudcontroller->deletecorrection($_POST["id"]);
                require_once "MasterRecordRemarksTable.php";
                // header("Location:MasterRecordTable.php");
            }

        break;

        case "GetWeekReport":
            if(isset($_POST["title"])) {
                $result = $crudcontroller->GetWeekReport($_POST["title"]);
                echo json_encode($result);
            }

        break;
        
        case "changedata":
            if(isset($_POST["phase"])) {
                $result = $crudcontroller->changedata($_POST["phase"]);
                require_once "dashboard_table_grade.php";
            }

        break;
        
        case "changedate":
            if(isset($_POST["date"])) {
                $result = $crudcontroller->changedate($_POST["date"]);
                require_once "dashboard_table_grade_changedate.php";
            }

        break;
        
        
        case "dashboard_viewitemfindings":
            
                $result = $crudcontroller->dashboard_viewitemfindings();
                require_once "dashboard_table_grade_viewitemfindings.php";
            

        break;
            
            
        case "changedata_viewitemfindings":
            if(isset($_POST["area"])) {
                $result = $crudcontroller->changedata_viewitemfindings($_POST["area"]);
                require_once "dashboard_table_grade_viewitemfindings.php";
            }

        break;
         
        case "changedate_viewitemfindings":
            if(isset($_POST["date"])) {
                $result = $crudcontroller->changedate_viewitemfindings($_POST["date"]);
                require_once "dashboard_table_grade_viewitemfindings_changedate.php";
            }

        break;
         
            
        case "changedata_viewitemfindings_structural":
            if(isset($_POST["area"])) {
                $result = $crudcontroller->changedata_viewitemfindings($_POST["area"]);
                require_once "dashboard_table_grade_viewitemfindings_structural.php";
            }

        break;
         
        case "changedate_viewitemfindings_structural":
            if(isset($_POST["date"])) {
                $result = $crudcontroller->changedate_viewitemfindings($_POST["date"]);
                require_once "dashboard_table_grade_viewitemfindings_structural_changedate.php";
            }

        break;
        
        case "changedata_viewitemfindings_equipment":
            if(isset($_POST["area"])) {
                $result = $crudcontroller->changedata_viewitemfindings_equipment($_POST["area"]);
                require_once "dashboard_table_grade_viewitemfindings_equipment.php";
            }

        break;
         
        case "changedate_viewitemfindings_equipment":
            if(isset($_POST["date"])) {
                $result = $crudcontroller->changedate_viewitemfindings_equipment($_POST["date"]);
                require_once "dashboard_table_grade_viewitemfindings_equipment_changedate.php";
            }

        break;
        
        case "changedata_building_viewscores":
            if(isset($_POST["building"])) {
                $result = $crudcontroller->changedata_building_viewscores($_POST["building"]);
                require_once "dashboard_table_grade_building_viewscores.php";
            }

        break;

        case "changedate_building_viewscores":
            if(isset($_POST["date"])) {
                $result = $crudcontroller->changedate_building_viewscores($_POST["date"]);
                require_once "dashboard_table_grade_building_viewscores_changedate.php";
            }

        break;
         

    }

    

?>