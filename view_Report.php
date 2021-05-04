<?php  
 session_start(); 
 include_once 'startChecklist/Class.php';
 
 if(isset($_SESSION['username'])){
    echo "Please Wait";
  }else{
    header("location:index.php");  
  }
     
 $crudcontroller = new CrudController();
 $dao = new Dao();
 $conn = $dao->openConnection();
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

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		


	</head>
	<body>
		<section class="body">

		<?php include 'header.php'?>

			<div class="inner-wrapper">
                <div id="sidebar" style="z-index:3px">
                    <?php include 'sidebar.php'?>
                </div>

				<section role="main" class="content-body">
					<header class="page-header">
						<!-- <h2>View Report</h2> -->
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>View Report</span></li>
								<!-- <li><span>Phase</span></li> -->
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- body form -->

                    <?php
                        $fid = $_GET['id'];
                        $title = $_GET['title'];
                        $showHeader = $conn->prepare("SELECT * FROM remarkpoints where Fid = :fid");
                        $showHeader->execute(array(":fid"=>$fid));
                        $rowshowHeader = $showHeader->fetch(PDO::FETCH_ASSOC);
                        $Month = $rowshowHeader['Month'];
                        $Week = $rowshowHeader['Week'];
                    ?>
						<div class="col-sm-12">
								<form id="formManagePoints"  class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
                                <section class="panel" style="background-color:#ffffff">
										<header class="panel-heading" style="background-color:#778f9b;" >
											<h2 class="panel-title" style="color:#ffffff">View Report</h2>
												<p class="panel-subtitle" style="color:#ffffff">
                                                  Manage Report to be export
                                                  <span class="pull-right" >
                                                <a  href="print.php?id=<?php echo $_GET['id'] ?>&title=<?php echo $_GET['title']?>"><img src="icons/print.png" style="height:40px;background-color:#666;border-radius:50%;margin-top:-30px;box-shadow:3px 2px #333333cf" data-toggle="tooltip" title="Print"></a></span>
                                                </p>
                                                
										</header>
										
										<div class="panel-body">
                                            <div class="">
                                                <img src="icons/rdflogo.jpg" style="opacity:.2;float:right;height:100px;">
                                                <div class="parent" style="margin-left:100px;position:relative;height:100px;">
                                                    <div class="absolute" style="position: absolute;width: 90%;bottom: 10px;"><strong><p style="font-size:20px;text-align:center;margin-bottom:50;">
                                                        Techinical Services and Quality Assurance</p></strong>
                                                        <p style="text-align:center">
                                                        <?php 
                                                        if($Week == '1'){
                                                            echo strtoupper("First Week of ".$Month);
                                                        }
                                                        else if($Week == '2'){
                                                            echo strtoupper("Second Week of ".$Month);
                                                        }
                                                        else if($Week == '3'){
                                                            echo strtoupper("Third Week of ".$Month);
                                                        }
                                                        else if($Week == '4'){
                                                            echo strtoupper("Fourth Week of ".$Month);
                                                        }
                                                        else if($Week == '5'){
                                                            echo strtoupper("Fifth Week of ".$Month);
                                                        }
                                                        ?></p>
                                                    </div>
                                                </div>
                                            </div> 
                                            <input type="hidden" id="getTitle" value="<?php echo $_GET['title']?>"/>
                                            <input type="hidden" id="getTitlePDF" value="<?php echo $_GET['title']?>"/>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped mb-none"> 
                                                    <thead>
                                                        <tr>
                                                            <!-- must fetch -->
                                                        </tr>
                                                        <tr>
                                                            <th>AREAS</th>
                                                            <th>TARGET</th>
                                                            <th>1ST WEEK</th>
                                                            <th>2ND WEEK</th>
                                                            <th>3RD WEEK</th>
                                                            <th>4TH WEEK</th>
                                                            <th>5TH WEEK</th>
                                                            
                                                        </tr>
                                                        
                                                    </thead>
                                                    <tbody>
                                                       

                                                             <?php
                                                            $showAreas = $conn->prepare("SELECT * FROM Phase left join remarkpoints on Phase.Pid = remarkpoints.Pid Where remarkpoints.Title = :title GROUP BY remarkpoints.Pid");
                                                            $showAreas->execute(array(":title"=>$title));
                                                            WHILE($rowshowAreas = $showAreas->fetch(PDO::FETCH_ASSOC)){
                                                            $Phase = $rowshowAreas['PName'];
                                                            $Week = $rowshowAreas['Week'];
                                                            ?>

                                                        <tr>
                                                            <th><?php echo $Phase ?></th>
                                                            <th><center>2</center></th>
                                                                <?php
                                                                $count = 5; //5 beses dahil 5 weeks 5 loops
                                                                for ($i=1; $i <= $count; $i++) { 
                                                                    ?><th style="text-align:center" id="<?php echo $rowshowAreas['Pid']."_".$i;?>"></th><?php
                                                                }

                                                               ?>
                                                        </tr>
                                                            <?php } ?>
                                                    </tbody>
                                                    </table>

                                                    <table class="table table-bordered table-striped mb-none"> 
                                                        <tbody>
                                                             <?php
                                                            $showAreas = $conn->prepare("SELECT * FROM remarkpoints left join phase on remarkpoints.Pid = phase.Pid left join remarkpoints_detailed on remarkpoints.Fid = remarkpoints_detailed.Fid Where remarkpoints.Title = :title  GROUP BY remarkpoints_detailed.Pid,remarkpoints.Week ORDER BY remarkpoints.Week DESC"); //dating Group by Rid
                                                            $showAreas->execute(array(":title"=>$title));
                                                            while($rowshowAreas = $showAreas->fetch(PDO::FETCH_ASSOC)){
                                                            $Phase = $rowshowAreas['PName'];
                                                            $Week = $rowshowAreas['Week'];
                                                            $Date = $rowshowAreas['Date_Created'];
                                                            $Remarks=$rowshowAreas['MainRemarks'];
                                                            $rid=$rowshowAreas['Rid'];
                                                            $Fid=$rowshowAreas['Fid'];
                                                   
                                                            ?>
                                                            <tr>
                                                            <td colspan="7" style="text-align:center;background:#fef80d63"><strong><?php echo $Phase ?></strong><?php echo " "?> <?php echo $Date?> <span style="background-color:#d2322d;margin:20px; padding:5px; border-radius:10px;color:#fff;font-size:10px;"><?php echo "Week " ?> <span style="font-size:20px;"><strong><?php echo $Week ?></strong></span></span> </td>
                                                            </tr>   
                                                            <?php
                                                           
                                                            ?>
                                                             <tr>
                                                                <td colspan="2" style="background-color:#;color:#   "><strong><strong>Remarks: </strong><?php echo $rid ?></strong></td>
                                                            </tr>

                                                            <?php
                                                            $showAreas2 = $conn->prepare("SELECT * FROM remarkpoints left join phase on remarkpoints.Pid = phase.Pid left join remarkpoints_detailed on remarkpoints.Fid = remarkpoints_detailed.Fid Where remarkpoints.Title = :title and remarkpoints_detailed.Fid= '".$Fid."' and remarkpoints.Week = '".$Week."'  GROUP BY remarkpoints_detailed.Rid ORDER BY remarkpoints.Week DESC"); //dating Group by Rid
                                                            $showAreas2->execute(array(":title"=>$title));
                                                            while($rowshowAreas2 = $showAreas2->fetch(PDO::FETCH_ASSOC)){
                                                            $Phase2 = $rowshowAreas2['PName'];
                                                            $Week2 = $rowshowAreas2['Week'];
                                                            $Date2 = $rowshowAreas2['Date_Created'];
                                                            $Remarks2=$rowshowAreas2['MainRemarks'];
                                                            $rid2=$rowshowAreas2['Rid'];
                                                            $Specific2=$rowshowAreas2['SpecificRemarks'];
                                                            $CorrectiveAction2=$rowshowAreas2['CorrectiveAction'];
                                                            $Correction2=$rowshowAreas2['Correction'];
                                                            $recommendation2=$rowshowAreas2['recommendation'];
                                                            $Compliance2=$rowshowAreas2['compliance_concern'];
                                                            ?>


                                                            <?php 
                                                                if($Remarks2 != ""){
                                                                    ?>
                                                            <tr>
                                                                <td style="width:330px;background-color:#34495ed1;color:#fdfdfd"><strong>Non Compliance</strong></td>
                                                                <td style="width:320px;background-color:#34495ed1;color:#fdfdfd"><strong>Image</strong></td>
                                                            </tr>  
                                                                    <tr>
                                                                        <td><?php echo $Remarks2?></td>
                                                                        <td><?php
                                                                        
                                                                        $showpoints = $conn->prepare("SELECT * FROM image_points Where Fid = :rid ");
                                                                        $showpoints->execute(array(":rid"=>$rid2));
                                                                        while($rowshowpoints = $showpoints->fetch(PDO::FETCH_ASSOC)){
                                                                            $imagenamepoints=$rowshowpoints['imagename'];
                                                                            if($imagenamepoints == ""){
                                                                                echo "no image";
                                                                            }else{
                                                                            
                                                                            ?><img style="height:200px;width:200px;padding:5px"src="uploaded/<?php echo $imagenamepoints?>"><?php
                                                                            }
                                                                        } ?></td>
                                                                    </tr>  
                                                                    <?php
                                                                }else{

                                                                }
                                                            ?>
                                                            
                                                           
                                                           <?php 
                                                           if($CorrectiveAction2 != ""){
                                                            ?>
                                                            <tr>
                                                                <td colspan="2" style="background-color:#"><strong>Corrective Action</strong></td>
                                                            </tr>  
                                                            <tr>
                                                                <td style="background-color:#"><?php if($CorrectiveAction2 != ""){
                                                                    echo $CorrectiveAction2;
                                                                    }else{
                                                                        echo "No Corrective Action";
                                                                    }
                                                                    ?></td>
                                                                    <td style="background-color:#"></td>
                                                                
                                                            </tr>  
                                                                <?php
                                                            }
                                                            else{
                                                                
                                                            }
                                                           ?>
                                                           
                                                           <?php 
                                                            $showcorrection = $conn->prepare("SELECT * FROM remarkpoints_detailed_correction WHERE Rid = :rid");
                                                            $showcorrection->execute(array(":rid"=> $rid2));
                                                            $rowshowcorrection = $showcorrection->fetch(PDO::FETCH_ASSOC);
                                                            $Correction2 = $rowshowcorrection['CorrectionDetails'];
                                                           if($Correction2 != ""){
                                                            ?>
                                                            <tr>
                                                                <td style="background-color:#"><strong>Correction</strong></td>
                                                                <td style="background-color:#"><strong>Image</strong></td>
                                                            </tr>  
                                                            <tr>
                                                                <?php
                                                                if($Correction2 ==""){
                                                                    ?><td style="background-color:#fdb24"> No Correction </td> <?php
                                                                    }
                                                                else{
                                                                ?><td style="background-color:#"> 
                                                                <?php echo $Correction2;
                                                                } ?>
                                                                </td>

                                                                <td style="background-color:#"><?php
                                                                
                                                                $showcorrection = $conn->prepare("SELECT * FROM image_points_correction Where Fid = :fid ");
                                                                $showcorrection->execute(array(":fid"=>$rid2));
                                                                while($rowshowcorrection = $showcorrection->fetch(PDO::FETCH_ASSOC)){
                                                                    $imagenamepoints=$rowshowcorrection['CorrectionImage'];
                                                                    if($imagenamepoints == ""){
                                                                       ?><?php echo "no image";
                                                                    }else{
                                                                    
                                                                    ?><img style="height:200px;width:200px;padding:5px;"src="uploaded/<?php echo $imagenamepoints?>"><?php
                                                                    }
                                                                } ?></td>
                                                            </tr>  
                                                           <?php
                                                            }
                                                            else{
                                                              
                                                            }
                                                           ?>

                                                           <?php  
                                                            if($recommendation2 != ""){
                                                               ?>
                                                            <tr>
                                                                <td colspan="2" style="background-color:#"><strong>Recommendation</strong></td>
                                                            </tr>  
                                                            <tr>
                                                                <td colspan="2" style="background-color:#"><?php if($recommendation2 != ""){
                                                                    echo $recommendation2;
                                                                    }else{
                                                                        echo "No Recommendation";
                                                                    }
                                                                    ?></td>
                                                              
                                                            </tr>  

                                                                <?php
                                                            }
                                                            else{
                                                               
                                                            }
                                                            ?>

                                                            <!-- Compliance -->
                                                          
                                                            
                                                            <?php  
                                                            if($Compliance2 != ""){
                                                               ?>
                                                                <tr>    
                                                                    <td colspan="2" style="width:330px;background-color:#2f5d2f;color:#fdfdfd"><strong>Compliance # <?php echo $rid2?></strong></td>
                                                                </tr>  
                                                                <tr>
                                                                    <td colspan="2"><?php echo $Compliance2?></td>
                                                                </tr>
                                                               <?php
                                                            }
                                                            else{
                                                               
                                                            }
                                                            ?>

                                                            <?php   
                                                                $showcompliance = $conn->prepare("SELECT * FROM remarkpoints_detailed_complianceremarks WHERE complianceid = :rid");
                                                                $showcompliance->execute(array(":rid"=> $rid2));
                                                                while($rowshowcompliance = $showcompliance->fetch(PDO::FETCH_ASSOC)){
                                                                 $compliance = $rowshowcompliance['Complianceremarks'];
                                                            if($compliance != ""){
                                                                ?>
                                                                    <tr colspan="2"> 
                                                                        <td colspan="2" style="width:330px;background-color:#"><strong>Remarks</strong></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="2" style="background-color:#"> 
                                                                        <?php 
                                                                        
                                                                        if($compliance ==""){
                                                                            echo "No Compliance";
                                                                        }
                                                                        else{
                                                                        ?>
                                                                        <?php  ?>*<?php echo $compliance; ?><br> <?php
                                                                        } 
                                                                        ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                            }
                                                            else{
                                                               
                                                            }
                                                            ?>

                                                                <?php 
                                                                }
                                                            }
                                                            } ?>
                                                            
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                         

                                        </div>
										
								</section>
								</form>
							</div>
					<!-- end body form -->
													
				

					<!-- MODAL INCLUDE -->
					<?php include("Report/modal_managepoints.php");?>
			
				
				</section>
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
		
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>

		<!-- Examples -->
		
        <script src="Report/createReport.js"></script>
	</body>
</html>