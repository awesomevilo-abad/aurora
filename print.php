<?php
include_once 'Report/class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>Aurora</title>

    <link rel='stylesheet' type='text/css' href='EditableInvoice/css/style.css' />
    <link rel='stylesheet' type='text/css' href='EditableInvoice/css/print.css' media="print" />
    <script type='text/javascript' src='EditableInvoice/js/jquery-1.3.2.min.js'></script>
    <script type='text/javascript' src='EditableInvoice/js/example.js'></script>
    <meta http-equiv="refresh" content="5; URL=view_Report.php?id=<?php echo $_GET['id']?>&title=<?php echo $_GET['title']?>">
    <style>
    thead { display: table-row-group;}
  tfoot { display: table-row-group; }
  tr { page-break-inside: avoid ;}

  </style>
  <!-- <script src="Report/history.js"></script> -->
  <script src="Report/createReport.js"></script>
</head>
<body onload="window.print(); window.close();" >
<?php
$fid = $_GET['id'];
$title = $_GET['title'];
$showHeader = $conn->prepare("SELECT * FROM remarkpoints where Fid = :fid");
$showHeader->execute(array(":fid"=>$fid));
$rowshowHeader = $showHeader->fetch(PDO::FETCH_ASSOC);
$Month = $rowshowHeader['Month'];

$Week = $rowshowHeader['Week'];
?>
<!-- must fetch -->
<div id="page-wrap">
<div class="panel-body">
        <div class="">
            <img src="icons/rdflogo.jpg" style="float:right;height:50px;">
            <br><br><br>
            <div class="parent" style="margin-left:100px;position:relative;height:50px;">
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
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" style="width:750px;"> 
                <thead>
                    <tr>
                      
                        <th style="text-align:center"colspan="7"><?php echo $Month ?></th>
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
                        <td><?php echo $Phase ?></td>
                        <td></td>
                            <?php
                            $count = 5; //5 beses dahil 5 weeks 5 loops
                            for ($i=1; $i <= $count; $i++) { 
                                ?><td style="text-align:center" id="<?php echo $rowshowAreas['Pid']."_".$i;?>"></td><?php
                            }

                            ?>
                    </tr>
                        <?php } ?>
                </tbody>
                </table>

                <table class="table table-bordered table-striped mb-none" style="width:750px;"> 
                <tbody>
                <?php
                $showAreas = $conn->prepare("SELECT * FROM remarkpoints left join phase on remarkpoints.Pid = phase.Pid left join remarkpoints_detailed on remarkpoints.Fid = remarkpoints_detailed.Fid Where remarkpoints.Title = :title  GROUP BY remarkpoints_detailed.Rid");
                $showAreas->execute(array(":title"=>$title));
                while($rowshowAreas = $showAreas->fetch(PDO::FETCH_ASSOC)){
                $Phase = $rowshowAreas['PName'];
                $Week = $rowshowAreas['Week'];
                $Date = $rowshowAreas['Date_Created'];
                $Remarks=$rowshowAreas['MainRemarks'];
                $rid=$rowshowAreas['Rid'];
                $Specific=$rowshowAreas['SpecificRemarks'];
                // $imagename=$rowshowAreas['imagename'];
                $CorrectiveAction=$rowshowAreas['CorrectiveAction'];
                $Correction=$rowshowAreas['Correction'];
                $recommendation=$rowshowAreas['recommendation'];
                $Compliance=$rowshowAreas['compliance_concern'];
                ?>
                    <tr>
                        <td colspan="7" style="text-align:center;background:#f3d4d059"><strong><?php echo $Phase ?></strong><?php echo " "?> <?php echo $Date?> </td>
                    </tr>   
                    <?php
                    
                    ?>
                        <tr>
                        <td colspan="2" style="background-color:#778f9b;color:#dfdfdf"><strong><strong>Remarks: </strong><?php echo $rid ?></strong></td>
                    </tr>
                    <tr>
                        <td style="width:330px"><strong>Good and Bad Points</strong></td>
                        <td style="width:320px;"><strong>Image</strong></td>
                    </tr>  
                    <tr>
                        <td><?php echo $Remarks?></td>
                        <td><?php
                        
                        $showpoints = $conn->prepare("SELECT * FROM image_points Where Fid = :rid ");
                        $showpoints->execute(array(":rid"=>$rid));
                        while($rowshowpoints = $showpoints->fetch(PDO::FETCH_ASSOC)){
                            $imagenamepoints=$rowshowpoints['imagename'];
                            if($imagenamepoints == ""){
                                echo "no image";
                            }else{
                            
                            ?><img style="height:150px;width:150px;padding:5px"src="uploaded/<?php echo $imagenamepoints?>"><?php
                            }
                        } ?></td>
                    </tr>  
                    
                    <tr>
                        <td colspan="2" style="background-color:#47a44740"><strong>Corrective Action</strong></td>
                    </tr>  
                    <tr>
                        <td style="background-color:#47a4471c"><?php if($CorrectiveAction != ""){
                            echo $CorrectiveAction;
                            }else{
                                echo "No Corrective Action";
                            }
                            ?></td>
                            <td style="background-color:#47a4471c"></td>
                        
                    </tr>  
                    
                    <tr>
                        <td style="background-color:#fdbe393d"><strong>Correction</strong></td>
                        <td style="background-color:#fdbe393d"><strong>Image</strong></td>
                    </tr>  
                    <tr>
                    <?php 
                        $showcorrection = $conn->prepare("SELECT * FROM remarkpoints_detailed_correction WHERE Rid = :rid");
                        $showcorrection->execute(array(":rid"=> $rid));
                        $rowshowcorrection = $showcorrection->fetch(PDO::FETCH_ASSOC);
                        $Correction = $rowshowcorrection['CorrectionDetails'];
                        if($Correction ==""){
                            ?><td style="background-color:#fdbe3924"> No Correction </td> <?php
                            }
                        else{
                        ?><td style="background-color:#fdbe3924"> 
                        <?php echo $Correction;
                        } ?>
                        </td>

                        <td style="background-color:#fdbe3924"><?php
                        
                        $showcorrection = $conn->prepare("SELECT * FROM image_points_correction Where Fid = :fid ");
                        $showcorrection->execute(array(":fid"=>$rid));
                        while($rowshowcorrection = $showcorrection->fetch(PDO::FETCH_ASSOC)){
                            $imagenamepoints=$rowshowcorrection['CorrectionImage'];
                            if($imagenamepoints == ""){
                                ?><?php echo "no image";
                            }else{
                            
                            ?><img style="height:150px;width:150px;padding:5px;"src="uploaded/<?php echo $imagenamepoints?>"><?php
                            }
                        } ?></td>
                    </tr>  
                    
                    <tr>
                        <td colspan="2" style="background-color:#0b86ea2e"><strong>Recommendation</strong></td>
                    </tr>  
                    <tr>
                        <td colspan="2" style="background-color:#0b86ea1c"><?php if($recommendation != ""){
                            echo $recommendation;
                            }else{
                                echo "No Recommendation";
                            }
                            ?></td>
                        
                    </tr>  
                    
                    <tr>
                            <td colspan="2" style="width:330px;background-color:#34495ed1;color:#fdfdfd"><strong>Compliance</strong></td>
                        </tr>  
                        <tr>
                            <td colspan="2"><?php echo $Compliance?></td>
                        </tr>

                        <tr colspan="2"> 
                        <td colspan="2" style="width:330px;background-color:#"><strong>Remarks</strong></td>
                        </tr>
                        
                        <tr>
                        <td colspan="2" style="background-color:#"> 
                        <?php 
                            $showcompliance = $conn->prepare("SELECT * FROM remarkpoints_detailed_complianceremarks WHERE complianceid = :rid");
                            $showcompliance->execute(array(":rid"=> $rid));
                            while($rowshowcompliance = $showcompliance->fetch(PDO::FETCH_ASSOC)){
                            $compliance = $rowshowcompliance['Complianceremarks'];
                            if($compliance ==""){
                                echo "No Compliance";
                            }
                            else{
                            ?>
                            <?php  ?>*<?php echo $compliance; ?><br> <?php
                            } 
                            }?>
                            </td>
                        </tr>

                    
                    <?php } ?>


                
                </tbody>
                </table>
            </div>
        

    </div>
</div>

</body>

</html>

