<?php  
 session_start(); 
if(isset($_SESSION['username'])){
echo "Please Wait";
}else{
	header("location:index.php");  
}
 include_once 'startchecklist/Class.php';
 $crudcontroller = new CrudController();
 $dao = new Dao();
 $conn = $dao->openConnection();
 $Datetoday = $crudcontroller->getDate();
 $_SESSION['position'];


        
    ?>
    
<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Aurora</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css" />



		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<!-- pic -->
		
		<link rel="stylesheet" href="assets/css/lightbox.min.css" />
		<script src="assets/js/lightbox-plus-jquery.min.js"></script>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
      

	</head>
	<body>
		<section class="body">

		<?php include 'header.php'?>

			<div class="inner-wrapper">
                <div id="sidebar" style="z-index:3px">
                    <?php include 'usersidebar.php'?>
                </div>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Generate Report</h2>
					
						<div class="right-wrapper pull-right">
							
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

                <center>
                    <div id="loader">
                    </div>
                </center>
                <div id="showdata" class="col-md-12">
                
                    <div class="col-md-12" style="display:" id="viewscores_phase">
                        <section class="panel" style="background-color:#ffffff">
                            <header class="panel-heading">
                                <h2 class="panel-title">Reports</h2>
                                    <p class="panel-subtitle">
                                        
                                    </p>
                            </header>
                            <div class="form-group" style="margin-top:30px;">
                                   
                                   
                                   <div class="col-sm-2">
                                   <div id="hidenav"><img src="icons/hide.png" style="height:20px;cursor:pointer" class="pull-left" data-toggle="tooltip" title="Hide Navigation" onclick='hidenavigation()'></div>
                                   <div id="shownav"><img src="icons/view.png" style="display:;height:20px;cursor:pointer" class="pull-left" data-toggle="tooltip" title="Show Navigation" onclick='shownavigation()'></div>
                                        <br>
                                        <div id="auditreport-nav">
                                                Report Type:
                                                        <select d-ata-plugin-selectTwo name="" id="changereport" class="form-control populate" onchange='changereporttype(this.value)' required>
                                                            <option value="auditreport">Audit Report</option>
                                                            <option value="checklist">Checklist</option>
                                                            <!-- <option value="average">Average</option> -->
                                                        </select>
                                                <form method="post" action="Report/exportAudit.php">  
                                                   <input type="hidden" value='<?php echo $Datetoday ?>' name="date"/>
                                                    <div id="auditreport">
                                                            <?php
                                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                                            $sql = "SELECT * FROM checklist_grade 
                                                            left join area on checklist_grade.Aid = area.Aid 
                                                            left join phase on checklist_grade.Pid = phase.Pid 
                                                            left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                                            left join accounts on timedatephase.protect = accounts.Acid
                                                            left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                                                            left join building on checklist_grade.Bid = building.id 
                                                            where Accounts.AcName != ' '
                                                            Group By Building.id
                                                            ORDER BY checklist_grade.Aid ASC";
                                                            $stmt = $pdo->prepare($sql);
                                                            $stmt->execute();
                                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                            if ($stmt->rowCount() > 0) { ?>
                                                    
                                                            Choose Building <select data-plugin-selectTwo name="building_viewscores" id="building_viewscores" class="form-control populate" onchange='changedata_building_viewscores(this.value)' required>
                                                                <?php foreach ($results as $row) { ?>
                                                                        <option value="<?php echo $row['id']?>"><?php echo $row['Name']?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <?php } ?> 

                                                            Choose Phase 1
                                                            <select data-plugin-selectTwo name="phase" id="phase" class="form-control populate" onchange="changedata(this.value)" required>
                                                            <option></option>
                                                            </select>

                                                        Choose Date:
                                                                    <div class="input-daterange input-group" data-plugin-datepicker>
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="start_auditreport" id="start_auditreport">
                                                                        <span class="input-group-addon">to</span>
                                                                        <input type="text" class="form-control" name="end_auditreport" id="end_auditreport">
                                                                    </div>
                                                            
                                                        
                                                        </div>
                                                        
                                                        <button type="submit" name="export" id="exportAudit" value="Export" class="btn btn-default" style="border-bottom-left-radius:20px;border-bottom-right-radius:20px;background-color:#448248d4" ><img src="icons/export.png" style="height:20px; width:15px" data-toggle="tooltip" title="Export to Excel"></button>
                                                        
                                                        <button type="button" id="filterreport" onclick="filterReports()" class="btn btn-default pull-right" style="border-radius:50px;"><img src="icons/filter.png" style="height:15px;">Generate</button>
                                                        <button type="button" id="filterreport_phase"  onclick="filterReports_phase()" class="btn btn-default pull-right" style="border-radius:50px;"><img src="icons/filter.png" style="height:15px;">Generate</button>
                                                    </div>
                                                </form>

                                                <form method="post" action="Report/exportCheck.php">  
                                                <input type="hidden" value='<?php echo $Datetoday ?>' name="date2"/>
                                                    <div id="checklist" style="display:none">
                                                        Type of Audit: 
                                                        <select d-ata-plugin-selectTwo name="Report_type" id="Report_type" class="form-control populate" onchange='changereport(this.value)' required>
                                                                <option value="sanitation">Sanitation</option>
                                                                <option value="structural">Structural</option>
                                                                <option value="equipment">Equipment</option>
                                                                <option value="sanitationremarks">SanitationRemarks</option>
                                                                <option value="firstoffensestr">Structural - 1st Offense</option>
                                                                <option value="firstoffense">Equipment - 1st Offense</option>
                                                        </select>

                                                        <?php
                                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                                            $sql = "SELECT * FROM checklist_grade 
                                                            left join phase on checklist_grade.Pid = phase.Pid
                                                            left join building on phase.Bid = building.id
                                                            group by phase.Pid order by phase.Pid
                                                            ";
                                                            $stmt = $pdo->prepare($sql);
                                                            $stmt->execute();
                                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                            if ($stmt->rowCount() > 0) { ?>
                                                    
                                                            Choose Phase check
                                                            <div id="dropdownchecklist">
                                                                <select data-plugin-selectTwo name="Report_phase_checklist" id="Report_phase_checklist" class="form-control populate" onchange='changedata_checklist(this.value)' required>
                                                                    <?php foreach ($results as $row) { ?>
                                                                            <optgroup label="<?php echo $row['Name']?>">
                                                                                <option value="<?php echo $row['Pid']?>"><?php echo $row['PName']?></option>
                                                                            </optgroup>	
                                                                    <?php } 
                                                                    $pid = $row['Pid'];?>
                                                                </select>
                                                            </div>
                                                            <?php } ?>

                                                            <?php
                                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                                            $sql = "SELECT * FROM checklist_grade 
                                                            left join phase on checklist_grade.Pid = phase.Pid
                                                            left join building on phase.Bid = building.id
                                                            group by phase.Pid order by phase.Pid
                                                            ";
                                                            $stmt = $pdo->prepare($sql);
                                                            $stmt->execute();
                                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                            if ($stmt->rowCount() > 0) { ?>
                                                    
                                                    <div name="dropdownequip" id="dropdownequip" >
                                                            <select style="background-color:red" data-plugin-selectTwo class="form-control populate" name="Report_phase_equip" id="Report_phase_equip" onchange='changedata_checklist(this.value)' required>
                                                                <?php foreach ($results as $row) { ?>
                                                                        <optgroup label="<?php echo $row['Name']?>">
                                                                            <option value="<?php echo $row['Pid']?>"><?php echo $row['PName']?></option>
                                                                        </optgroup>	
                                                                <?php } 
                                                                $pid = $row['Pid'];?>
                                                            </select>
                                                    </div>
                                                            
                                                            <?php } ?>
                                            
                                                            <input type="hidden" class="form-control" name="Report_area_checklist" id="Report_area_checklist"/>

                                                            Choose Date:
                                                                    <div class="input-daterange input-group" data-plugin-datepicker>
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" name="start_auditreport_checklist" id="start_auditreport_checklist">
                                                                        <span class="input-group-addon">to</span>
                                                                        <input type="text" class="form-control" name="end_auditreport_checklist" id="end_auditreport_checklist">
                                                                    </div>
                                                        
                                                        <button type="submit" name="export" id="exportCheck" value="Export" class="btn btn-default" style="border-bottom-left-radius:20px;border-bottom-right-radius:20px;background-color:#448248d4" ><img src="icons/export.png" style="height:20px; width:15px" data-toggle="tooltip" title="Export to Excel"></button>
                                                        <button type="button" id="filterreport_checklist" onclick="filterReports_checklist()" class="btn btn-default pull-right" style="border-radius:50px;"><img src="icons/filter.png" style="height:15px;">Generate</button>
                                                        <button type="button" id="filterreport_area_checklist"  onclick="filterReports_area_checklist()" class="btn btn-default pull-right" style="border-radius:50px;"><img src="icons/filter.png" style="height:15px;">Generate</button>

                                                    </div>
                                                 </form>
                                                <!-- 
                                                <div id="average" style="display:none">
                                                        <?php
                                                        $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                                        $sql = "SELECT * FROM checklist_grade 
                                                        left join area on checklist_grade.Aid = area.Aid 
                                                        left join phase on checklist_grade.Pid = phase.Pid 
                                                        left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                                        left join accounts on timedatephase.protect = accounts.Acid
                                                        left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                                                        left join building on checklist_grade.Bid = building.id 
                                                        where Accounts.AcName != ' '
                                                        Group By Building.id
                                                        ORDER BY checklist_grade.Aid ASC";
                                                        $stmt = $pdo->prepare($sql);
                                                        $stmt->execute();
                                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        if ($stmt->rowCount() > 0) { ?>
                                                
                                                        Choose Building <select data-plugin-selectTwo name="buildingave" id="buildingave" class="form-control populate" onChange='changedata_building_viewscores(this.value)' required>
                                                            <?php foreach ($results as $row) { ?>
                                                                    <option value="<?php echo $row['id']?>"><?php echo $row['Name']?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <?php } ?> 

                                                        Choose Phase 
                                                        <select data-plugin-selectTwo name="phaseave" id="phaseave" class="form-control populate" onChange='changedata(this.value)' required>
                                                          <option value="">Select Building then Phase</option>
                                                        </select>

                                                     Choose Date:
                                                                <div class="input-daterange input-group" data-plugin-datepicker>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                    <input type="text" class="form-control" name="start_auditreport_ave" id="start_auditreport_ave">
                                                                    <span class="input-group-addon">to</span>
                                                                    <input type="text" class="form-control" name="end_auditreport_ave" id="end_auditreport_ave">
                                                                </div>
                                                           
                                                       
                                                    </div>
                                                    <button id="filterreportave" onclick="filterreportave()" class="pull-right" style="border-radius:50px;margin:10px;"><img src="icons/filter.png" style="height:15px;">Filter</button>
                                                    <button id="filterreport_ave"  onclick="filterreport_ave()" class="pull-right" style="border-radius:50px;margin:10px;"><img src="icons/filter.png" style="height:15px;">Filter</button>
                                                </div> -->
                                        </div>
                                        
                                        <center>
                                            <div id="loaderfilter">
                                            </div>
                                        </center>
                                        <div style="display:none" id="dashboardtable_max" class="col-sm-12"> </div>
                                        <div style="display:none" id="dashboardtable_min" class="col-sm-10"> </div>
                                    </div>
                            </div>

               
                        </section>
                    </div>


                    <!-- FOR QA STAFF & PROTECH -->
					<div class="col-md-12" style="display:none" id="viewscores_phase">
                        <section class="panel" style="background-color:#ffffff">
                            <header class="panel-heading">
                                <h2 class="panel-title">Summary of Scores</h2>
                                    <p class="panel-subtitle">
                                        Per Phase
                                    </p>
                            </header>
                            <div class="form-group" style="margin-top:30px;">
                                   
                                   
                                   <div class="col-sm-3">

                                    Report Type: <select d-ata-plugin-selectTwo name="" id="changereport" class="form-control populate" onchange='changereporttype(this.value)' required>
                                            <option value="viewscores_phase">Area Score</option>
                                            <option value="viewscores_building">Phase Score</option>
                                            <option value="viewitemfindings_sanitation">Sanitation Scores</option>
                                            <option value="viewitemfindings_structural">Structural Scores</option>
                                            <option value="viewitemfindings_equipment">Equipment Scores</option>
                                            </select>
                                            <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                            $sql = "SELECT * FROM checklist_grade left join phase on checklist_grade.Pid=phase.Pid 
                                            left join building on phase.Bid = building .id  Group By building.id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if ($stmt->rowCount() > 0) { ?>
                                    
                                            Choose Phase <select data-plugin-selectTwo name="phase" id="phase" class="form-control populate" onchange='changedata(this.value)' required>
                                                <?php foreach ($results as $row) { ?>
                                                    <optgroup label="<?php echo $row['Name']?>">
                                                        <option value="<?php echo $row['Pid']?>"><?php echo $row['PName']?></option>
                                                    </optgroup>	
                                                <?php } ?>
                                            </select>
                                            <?php } ?> 

                                            <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                            $sql = "SELECT * FROM checklist_grade left join phase on checklist_grade.Pid=phase.Pid 
                                            left join building on phase.Bid = building .id  Group By checklist_grade.Date_Checked";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if ($stmt->rowCount() > 0) { ?>
                                            
                                            Choose Date: <div id="dateunset" style="color:#d2322d"> <strong>Choose Phase to select date</strong></div>
                                            <div id="dateset"style="display:none">
                                                <select data-plugin-selectTwo name="datedash" id="datedash" class="form-control populate" style="display:" onchange='changedate(this.value)' required>
                                                            <option>All </option>
                                                    <?php foreach ($results as $row) { ?>
                                                            <option value="<?php echo $row['Date_Checked']?>"><?php echo $row['Date_Checked']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?php } ?> 

                                    </div>
                                    <div style="display:none" id="dashboardtable" class="col-sm-9"> </div>
                            </div>

                                <section class="panel">	
                                    <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
                                        <div class="isotope-item document">
                                            <div style="margin:20px;">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </section>
                        </section>
                    </div>

                    <div class="col-md-12" style="display:none" id="viewitemfindings_sanitation">
                        <section class="panel" style="background-color:#ffffff">
                            <header class="panel-heading">
                                <h2 class="panel-title">Sanitation Findings</h2>
                                    <p class="panel-subtitle">
                                        Per Area
                                    </p>
                            </header>
                            <div class="form-group" style="margin-top:30px;">
                                 
                                    
                                     <div class="col-sm-3">

                                        Report Type: <select d-ata-plugin-selectTwo name="" id="changereport" class="form-control populate" onchange='changereporttype(this.value)' required>
                                                <option value="viewscores_phase">Area Score</option>
                                                <option value="viewscores_building">Phase Score</option>
                                                <option value="viewitemfindings_sanitation">Sanitation Scores</option>
                                                <option value="viewitemfindings_structural">Structural Scores</option>
                                                <option value="viewitemfindings_equipment">Equipment Scores</option>
                                                </select>
                                            <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                            $sql = "SELECT * FROM checklist_grade left join area on checklist_grade.Aid = area.Aid left join phase on checklist_grade.Pid=phase.Pid 
                                            left join building on phase.Bid = building .id  Group By building.id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if ($stmt->rowCount() > 0) { ?>
                                    
                                            Choose Area <select data-plugin-selectTwo name="area_viewitemfindings" id="area_viewitemfindings" class="form-control populate" onchange='changedata_viewitemfindings(this.value)' required>
                                                <?php foreach ($results as $row) { ?>
                                                        <optgroup label="<?php echo $row['PName']?>">
                                                            <option value="<?php echo $row['Aid']?>"><?php echo $row['AName']?></option>
                                                        </optgroup>	
                                                    
                                                
                                                <?php } ?>
                                            </select>
                                            <?php } ?> 

                                            <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                            $sql = "SELECT * FROM checklist_grade left join phase on checklist_grade.Pid=phase.Pid 
                                            left join building on phase.Bid = building .id  Group By checklist_grade.Date_Checked";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if ($stmt->rowCount() > 0) { ?>
                                            
                                            Choose Date: <div id="dateunset_viewitemfindings" style="color:#d2322d"> <strong>Choose area to select date</strong></div>
                                            <div id="dateset_viewitemfindings"style="display:none">
                                                <select data-plugin-selectTwo name="datedash_viewitemfindings" id="datedash_viewitemfindings" class="form-control populate" style="display:" onchange='changedate_viewitemfindings(this.value)' required>
                                                <option>All </option>
                                                    <?php foreach ($results as $row) { ?>
                                                            <option value="<?php echo $row['Date_Checked']?>"><?php echo $row['Date_Checked']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?php } ?> 

                                    </div>
                                    <div style="display:none" id="dashboardtable_viewitemfindings" class="col-sm-9"> </div>
                            </div>

                                <section class="panel">	
                                    <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
                                        <div class="isotope-item document">
                                            <div style="margin:20px;">
                                              
                                            </div>
                                        </div>
                                    </div>
                                </section>
                        </section>






                    </div>

                    <div class="col-md-12" style="display:none" id="viewitemfindings_structural">
                        <section class="panel" style="background-color:#ffffff">
                            <header class="panel-heading">
                                <h2 class="panel-title">Structural Findings</h2>
                                    <p class="panel-subtitle">
                                        Per Area
                                    </p>
                            </header>
                            <div class="form-group" style="margin-top:30px;">
                                   
                                    <div class="col-sm-3">

                                        Report Type: <select d-ata-plugin-selectTwo name="" id="changereport" class="form-control populate" onchange='changereporttype(this.value)' required>
                                                <option value="viewscores_phase">Area Score</option>
                                                <option value="viewscores_building">Phase Score</option>
                                                <option value="viewitemfindings_sanitation">Sanitation Scores</option>
                                                <option value="viewitemfindings_structural">Structural Scores</option>
                                                <option value="viewitemfindings_equipment">Equipment Scores</option>
                                                </select>
                                            <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                            $sql = "SELECT * FROM checklist_grade left join area on checklist_grade.Aid = area.Aid left join phase on checklist_grade.Pid=phase.Pid 
                                            left join building on phase.Bid = building .id  Group By building.id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if ($stmt->rowCount() > 0) { ?>
                                    
                                            Choose Area <select data-plugin-selectTwo name="area_viewitemfindings_structural" id="area_viewitemfindings_structural" class="form-control populate" onchange='changedata_viewitemfindings_structural(this.value)' required>
                                                <?php foreach ($results as $row) { ?>
                                                        <optgroup label="<?php echo $row['PName']?>">
                                                            <option value="<?php echo $row['Aid']?>"><?php echo $row['AName']?></option>
                                                        </optgroup>	
                                                    
                                                
                                                <?php } ?>
                                            </select>
                                            <?php } ?> 

                                            <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                            $sql = "SELECT * FROM checklist_grade left join phase on checklist_grade.Pid=phase.Pid 
                                            left join building on phase.Bid = building .id  Group By checklist_grade.Date_Checked";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if ($stmt->rowCount() > 0) { ?>
                                            
                                            Choose Date: <div id="dateunset_viewitemfindings_structural" style="color:#d2322d"> <strong>Choose area to select date</strong></div>
                                            <div id="dateset_viewitemfindings_structural"style="display:none">
                                                <select data-plugin-selectTwo name="datedash_viewitemfindings_structural" id="datedash_viewitemfindings_structural" class="form-control populate" style="display:" onchange='changedate_viewitemfindings_structural(this.value)' required>
                                                        <option>All </option>
                                                    <?php foreach ($results as $row) { ?>
                                                            <option value="<?php echo $row['Date_Checked']?>"><?php echo $row['Date_Checked']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?php } ?> 

                                    </div>
                                    <div style="display:none" id="dashboardtable_viewitemfindings_structural" class="col-sm-9"> </div>
                            </div>

                                <section class="panel">	
                                    <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
                                        <div class="isotope-item document">
                                            <div style="margin:20px;">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </section>
                        </section>






                    </div>

                    <div class="col-md-12" style="display:none" id="viewitemfindings_equipment">
                        <section class="panel" style="background-color:#ffffff">
                            <header class="panel-heading">
                                <h2 class="panel-title">Equipment Findings</h2>
                                    <p class="panel-subtitle">
                                        Per Area
                                    </p>
                            </header>
                            <div class="form-group" style="margin-top:30px;">
                            
                                    <div class="col-sm-3">

                                        Report Type: <select d-ata-plugin-selectTwo name="" id="changereport" class="form-control populate" onchange='changereporttype(this.value)' required>
                                                <option value="viewscores_phase">Area Score</option>
                                                <option value="viewscores_building">Phase Score</option>
                                                <option value="viewitemfindings_sanitation">Sanitation Scores</option>
                                                <option value="viewitemfindings_structural">Structural Scores</option>
                                                <option value="viewitemfindings_equipment">Equipment Scores</option>
                                                </select>
                                            <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                            $sql = "SELECT * FROM equipment_grade left join area on equipment_grade.Aid = area.Aid left join phase on area.Pid=phase.Pid 
                                            WHERE equipment_grade.Name != 'No Equipment'
                                              Group By area.Aid";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if ($stmt->rowCount() > 0) { ?>
                                    
                                            Choose Area <select data-plugin-selectTwo name="area_viewitemfindings_equipment" id="area_viewitemfindings_equipment" class="form-control populate" onchange='changedata_viewitemfindings_equipment(this.value)' required>
                                                <?php foreach ($results as $row) { ?>
                                                        <optgroup label="<?php echo $row['PName']?>">
                                                            <option value="<?php echo $row['Aid']?>"><?php echo $row['AName']?></option>
                                                        </optgroup>	
                                                    
                                                
                                                <?php } ?>
                                            </select>
                                            <?php } ?> 

                                            <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                            $sql = "SELECT * FROM equipment_grade left join area on equipment_grade.Aid = area.Aid left join phase on area.Pid=phase.Pid 
                                            left join building on phase.Bid = building .id  Group By equipment_grade.Date_Checked_equipment";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if ($stmt->rowCount() > 0) { ?>
                                            
                                            Choose Date: <div id="dateunset_viewitemfindings_equipment" style="color:#d2322d"> <strong>Choose area to select date</strong></div>
                                            <div id="dateset_viewitemfindings_equipment"style="display:none">
                                                <select data-plugin-selectTwo name="datedash_viewitemfindings_equipment" id="datedash_viewitemfindings_equipment" class="form-control populate" style="display:" onchange='changedate_viewitemfindings_equipment(this.value)' required>
                                                        <option>All </option>
                                                    <?php foreach ($results as $row) { ?>
                                                            <option value="<?php echo $row['Date_Checked_equipment']?>"><?php echo $row['Date_Checked_equipment']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?php } ?> 

                                    </div>
                                    <div style="display:none" id="dashboardtable_viewitemfindings_equipment" class="col-sm-9"> </div>
                            </div>

                                <section class="panel">	
                                    <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
                                        <div class="isotope-item document">
                                            <div style="margin:20px;">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </section>
                        </section>






                    </div>
                    <!-- FOR SUPERVISORS -->
                    <div class="col-md-12" id="viewscores_building" style="display:none;">
                        <section class="panel" style="background-color:#ffffff">
                            <header class="panel-heading">
                                <h2 class="panel-title">Summary of Scores</h2>
                                    <p class="panel-subtitle">
                                        Per Building
                                    </p>
                            </header>
                            <div class="form-group" style="margin-top:30px;">
                            
                                    
                                    <div class="col-sm-3">

                                    Report Type: <select d-ata-plugin-selectTwo name="" id="changereport" class="form-control populate" onchange='changereporttype(this.value)' required>
                                            <option value="viewscores_phase">Area Score</option>
                                            <option value="viewscores_building">Phase Score</option>
                                            <option value="viewitemfindings_sanitation">Sanitation Scores</option>
                                            <option value="viewitemfindings_structural">Structural Scores</option>
                                            <option value="viewitemfindings_equipment">Equipment Scores</option>
                                            </select>

                                            <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                            $sql = "SELECT * FROM checklist_grade left join phase on checklist_grade.Pid=phase.Pid 
                                            left join building on phase.Bid = building .id  Group By building.id";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if ($stmt->rowCount() > 0) { ?>
                                    
                                            Choose Building <select data-plugin-selectTwo name="building_viewscores" id="building_viewscores" class="form-control populate" onchange='changedata_building_viewscores(this.value)' required>
                                                <?php foreach ($results as $row) { ?>
                                                        <option value="<?php echo $row['id']?>"><?php echo $row['Name']?></option>
                                                <?php } ?>
                                            </select>
                                            <?php } ?> 

                                            <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                            $sql = "SELECT * FROM checklist_grade left join phase on checklist_grade.Pid=phase.Pid 
                                            left join building on phase.Bid = building .id  Group By checklist_grade.Date_Checked ORDER BY checklist_grade.Date_Checked DESC ";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if ($stmt->rowCount() > 0) { ?>
                                            
                                            Choose Date: <div id="dateunset_building_viewscores" style="color:#d2322d"> <strong>Choose Phase to select date</strong></div>
                                            <div id="dateset_building_viewscores"style="display:none">
                                                <select data-plugin-selectTwo name="datedash_building_viewscores" id="datedash_building_viewscores" class="form-control populate" style="display:" onchange='changedate_building_viewscores(this.value)' required>
                                                   <option>All </option>
                                                    <?php foreach ($results as $row) { ?>
                                                            <option value="<?php echo $row['Date_Checked']?>"><?php echo $row['Date_Checked']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?php } ?> 

                                    </div>

                                    <div class="col-sm-9" style="display:none" id="dashboardtable_viewscores_building"> </div>


                                    
                            </div>

                         
                        </section>
                    </div>

                </div>

            <div>
            <?php include 'rightsidebar.php'?>
            </div>
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="assets/vendor/summernote/summernote.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

		<!-- Examples -->
		<!-- <script src="assets/javascripts/tables/examples.datatables.ajax.js"></script> -->
		<script src="assets/javascripts/forms/examples.advanced.form.js" ></script>	    
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="Report/history.js"></script>
		<script src="header.js"></script>
		<!-- <script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script> -->
		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>
		
	</body>
</html>
