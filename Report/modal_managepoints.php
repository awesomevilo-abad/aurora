<?php
$Datetoday = $crudcontroller->getDate();
?>
<style>

.cont{
    width:720px;
  }
  .container{
      height:100px;
    display:flex;
    flex-wrap:wrap;
    width:1000px;
    justify-content:flex-start;
  }
  .single-item{
    width:100px;
    height:100px;
    display:flex;
    align-items:center;
    justify-content:center;
    background-color:#f3f3f3;
    margin: 5px;
    border-radius: 10px;
    color:#888;
  }
  .pagination{
    padding:20px;
    text-align: center;
  }
</style>

<a style="display:none;" id="modal_managepoints" class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" href="#managepoints">Primary</a>
<div id="managepoints" class="modal-block modal-header-color modal-block-danger mfp-hide">
    <div class="modal-dialog">


                <section class="panel" id="goodpointsmodal" style="height:500px;margin-left:-250px;float:left;width:1000px">
                    <header class="panel-heading" style="background-color:#f3463996"  >
                        <label style="color:#fff;font-size:20px;">Manage Non Compliance</label>
                    </header>
                    <div class="panel-body" style="color:#666">
                    <div class="form-group col-sm-06" onclick="compliancemode()" style="cursor:pointer">
                    <strong>Category: </strong><img src="icons/on.png" style="height:25px; width:25px"> <strong>Non Compliance:</strong>
                    </div>
                    <div class="modal-wrapper">
                        <form method="POST" action="" id="formManagePointsCorrective" enctype="multipart/form-data">
                                <div class="modal-text">
                                <?php $type = "Corrective";?>
                                    <input type="hidden" name="type" id="type" value="<?php echo $type;?>" placeholder="Type"/>
                                    <input type="hidden" name="typeCorrective" id="typeCorrective" value="<?php echo $type;?>" placeholder="Type"/>
                                    <input type="hidden" name="RidCorrective" id="RidCorrective" placeholder="Rid"/>
                                    <input type="hidden" name="PidCorrective" id="PidCorrective" placeholder="Pid"/>
                                    <input type="hidden" name="FidCorrective" id="FidCorrective" placeholder="Fid"/>
                                    <strong><label>Non Compliance:</label></strong><textarea id="GBPoints" name="GBPoints"class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf" ></textarea>
                                    <strong><label>Specific Remarks:</label></strong><textarea id="Specific" name="Specific"class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf" ></textarea>
                                    <strong><label>Corrective Action <small>(Preventive Action)</small>:</label></strong><textarea id="Corrective" name="Corrective"class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf" ></textarea>
                                    <strong><label>Recommendation:</label></strong><textarea id="recommendation" name="recommendation"class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf" ></textarea>
                                    <strong><input value="<?php echo $Datetoday ?>" type="hidden" id="Date"  name="Date" class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf"></strong>

                                 
                                <div class="cont" style="background-color:#dfdfdf63;height:250px;width:100%;margin:10px;box-shadow:0px 5px #d2322d;border-radius:10px;">
                                <label style="background-color:#d2322d;color:#fff;border-top-left-radius:10px;">&nbsp;Image of the Day&nbsp;</label>
                                    <!-- <div class="container"> -->
                                    <div class="container" style="overflow-x:auto; height:150px; width:900px;">
                                        <?php
                                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                            $sql = "SELECT * FROM image_visor where imagename != '' and Date_Checked = '".$Datetoday."' ";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute();
                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                if ($stmt->rowCount() > 0) {
                                                    foreach ($results as $row) {
                                                ?>
                                                <div class="single-item" style="margin-top:20px;" onclick="tagImage('<?php echo $row['imagename'] ?>')" style="cursor:Pointer"><img style="border-radius:10px;box-shadow: 2px 1px #666;height:100px; width:100px;margin:10px;"  src="uploaded/<?php echo $row['imagename'] ?>" >
                                                </div>
                                                
                                                <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <input type="hidden" value="sample.png" id="tagImageValue" class="form-control" style="width:20%"readonly/>
                                    <input type="hidden" value="<?php echo $Datetoday ?>" id="tagImageDate" class="form-control" style="width:20%"readonly/>
                                        
                                        <img class="pull-right"style="height:50px; width:50px;margin:10px;margin-right:100px;" id="imgClickAndChange" src="uploaded/<?php echo $row['imagename'] ?>">
                                            <label class="pull-right" style="margin-top:25px;">Image Preview </label>
                                </div>
                                

                                <div id="remarksresult"></div>

                            <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                    <button class="btn btn-danger" id="btnAddRemarks" name="btnAddRemarks"> Submit</button>
                                    <button type="button" id="btnUpdateRemarks"  name="btnUpdateRemarks" class="mb-xs mt-xs mr-xs btn btn-warning" ><img src="icons/update.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Update">Update</button>
                                    <button type="button" id="btnCancelRemarks" name="btnCancelRemarks" class="mb-xs mt-xs mr-xs btn btn-default" ><img src="icons/cancel.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Cancel">Cancel</button>   
                                    <button id="closemodal" onclick="closemodalCorrective()"class="btn btn-default modal-dismiss">Close</button>
                                    </div>
                                </div>
                            </footer>
                        </form>
                    </div>
                 </div>
                </section>

                <section class="panel" id="compliance" style="display:none;height:500px;margin-left:-250px;float:left;width:1000px">
                    <header class="panel-heading" style="background-color:#f3463996"  >
                        <label style="color:#fff;font-size:20px;">Manage Compliance</label>
                    </header>
                    <div class="panel-body" style="color:#666">
                    <div class="form-group" onclick="noncompliancemode()" style="cursor:pointer">
                    <strong>Category: </strong><img src="icons/off.png" style="height:25px; width:25px"> <strong>Compliance</strong>
                    </div>
                    
                    
                    <div class="form-group col-sm-06" onclick="showComplianceImages()" style="cursor:pointer">
                    <strong>Show Images: </strong><img src="icons/allimage.png" style="background-color:#f3463996;border:1px solid #fa655b;border-radius:50%;height:25px; width:25px">
                    </div>

                        <div class="modal-wrapper">
                            <form method="POST" action="" id="formManagePointsCompliance" enctype="multipart/form-data">
                                    <div class="modal-text">
                                    <?php $type = "Corrective";?>
                                        <input type="hidden" name="compliance" id="compliance" value="compliance" placeholder="Type"/>
                                        <input type="hidden" name="Ridcompliance" id="Ridcompliance" placeholder="Rid"/>
                                        <input type="hidden" name="Pidcompliance" id="Pidcompliance" placeholder="Pid"/>
                                        <input type="hidden" name="Fidcompliance" id="Fidcompliance" placeholder="Fid"/>
                                        <!-- <strong><label>Compliance:</label></strong><textarea id="Compliance" name="Compliance"class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf" ></textarea> -->
                                        <strong><label>Remarks:</label></strong><textarea id="Remarks" name="Remarks"class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf" ></textarea>
                                        <strong><input value="<?php echo $Datetoday ?>" type="hidden" id="Date"  name="Date" class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf"></strong>
                                    
                                    <div id="remarksresultcompliance"></div>

                                <footer class="panel-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                        <button class="btn btn-danger" id="btnAddCompliance" name="btnAddCompliance"> Submit</button>
                                        <button type="button" id="btnUpdateCompliance"  name="btnUpdateCompliance" class="mb-xs mt-xs mr-xs btn btn-warning" ><img src="icons/update.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Update">Update</button>
                                        <button type="button" id="btnCancelCompliance" name="btnCancelCompliance" class="mb-xs mt-xs mr-xs btn btn-default" ><img src="icons/cancel.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Cancel">Cancel</button>   
                                        <button id="closemodal" onclick="closemodalCorrective()"class="btn btn-default modal-dismiss">Close</button>
                                        </div>
                                    </div>
                                </footer>
                            </form>
                        </div>
                    </div>
                </section>

                <section class="panel" id="addRemarks" style="display:none;height:500px;margin-left:-250px;float:left;width:1000px">
                    <header class="panel-heading" style="background-color:#f3463996"  >
                        <label style="color:#fff;font-size:20px;">Add Remarks</label>
                    </header>
                    <div class="panel-body" style="color:#666">
                    <!-- <div class="form-group" onclick="noncompliancemode()" style="cursor:pointer">
                    <strong>Category: </strong><img src="icons/off.png" style="height:25px; width:25px"> <strong>Compliance</strong>
                    </div> -->
                    
                        <div class="modal-wrapper">
                            <form method="POST" action="" id="formManagePointsComplianceRemarks" enctype="multipart/form-data">
                                    <div class="modal-text">
                                    <?php $type = "Corrective";?>
                                        <input type="hidden" name="complianceconcern" id="complianceconcern" placeholder="complianceconcern"/>
                                        <input type="hidden" name="complianceid" id="complianceid" placeholder="complianceid"/>
                                        <input type="hidden" name="complianceremarks" id="complianceremarks" value="complianceremarks" placeholder="Type"/>
                                        <input type="hidden" name="Ridcomplianceremarks" id="Ridcomplianceremarks" placeholder="Rid"/>
                                        <input type="hidden" name="Pidcomplianceremarks" id="Pidcomplianceremarks" placeholder="Pid"/>
                                        <input type="hidden" name="Fidcomplianceremarks" id="Fidcomplianceremarks" placeholder="Fid"/>
                                        <!-- <strong><label>Compliance:</label></strong><textarea id="Compliance" name="Compliance"class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf" ></textarea> -->
                                        <strong><label>Remarks:</label></strong><textarea id="ComplianceRemarks" name="ComplianceRemarks"class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf" ></textarea>
                                        <strong><input value="<?php echo $Datetoday ?>" type="hidden" id="Date"  name="Date" class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf"></strong>
                                    
                                    <div id="remarksresultcomplianceremarks"></div>

                                <footer class="panel-footer">
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                        <!-- <button class="btn btn-danger" id="btnAddCompliance" name="btnAddCompliance"> Submit</button> -->
                                        <!-- <button type="button" id="btnUpdateCompliance"  name="btnUpdateCompliance" class="mb-xs mt-xs mr-xs btn btn-warning" ><img src="icons/update.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Update">Update</button>
                                        <button type="button" id="btnCancelCompliance" name="btnCancelCompliance" class="mb-xs mt-xs mr-xs btn btn-default" ><img src="icons/cancel.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Cancel">Cancel</button>    -->
                                        <!-- <button type="button" class="btn btn-default" onclick="closemodalCompliance()">Back</button> -->
                                        </div>
                                    </div>
                                </footer>
                            </form>
                        </div>
                    </div>
                </section>

                <section class="panel" id="correctionmodal" style="display:none;height:450px;margin-top:-100px;margin-left:-250px;float:left;width:1000px">
                    <header class="panel-heading" style="background-color:#ffab00"  >
                    <label style="color:#fff;font-size:20px;">Add Correction</label>
                    </header>
                    <div class="panel-body" style="color:#666">
                        <div class="form-group" onclick="correctiveMode()" style="cursor:pointer">
                        <!-- <strong>Corrective Action:</strong><img src="icons/off.png" style="height:25px; width:25px">  -->
                        </div>
                        
                        <div class="modal-wrapper" >
                        <div id="correctionmodalwrap">
                            <form method="POST" action="" id="formManagePointsCorrection" enctype="multipart/form-data">
                                    <div class="modal-text">
                                    
                                        
                                        <input type="hidden" name="CridCorrection" id="CridCorrection" placeholder="CridCorrection"/>
                                        <input type="hidden" name="RidCorrection" id="RidCorrection" placeholder="Rid"/>
                                        <strong><label>Good and Bad Points:</label></strong><textarea  id="GBPointsCorrection" name="GBPointsCorrection"class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf" readonly></textarea>
                                        <strong><label>Specific:</label></strong><textarea  id="SpecificCorrection" name="SpecificCorrection"class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf" readonly></textarea>
                                        <strong><label>Correction:</label></strong><textarea id="Correction" name="Correction"class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf" ></textarea>
                                        <strong><input value="<?php echo $Datetoday ?>" type="hidden" id="Date"  name="Date" class="form-control" style="border:1px solid #fdfdfd;background-color:#dfdfdf"></strong>
                                        <!-- <strong><label>Tag Correction Image:</label></strong><div style="background-color:#ef6c0026;border:1px solid #ef6c006e;cursor:pointer;border-radius:10px;" onclick="addImg_managepoints('<?php echo $type ?>')"><img  src="icons/tag2.png" style="height:30px;width:auto;cursor:pointer;" />Tag Images</div> -->
                                    </div>
                                    
                                    <div class="cont" style="background-color:#dfdfdf63;height:250px;width:100%;margin:10px;box-shadow:0px 5px #ffab00;border-radius:10px;">
                                    <label style="background-color:#ffab00;color:#fff;border-top-left-radius:10px;">&nbsp;Image of the Day&nbsp;</label>
                                        <div class="container">
                                                
                                            <?php
                                                $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                                $sql = "SELECT * FROM image_visor where imagename != '' and Date_Checked = '".$Datetoday."' ";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute();
                                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    if ($stmt->rowCount() > 0) {
                                                        foreach ($results as $row) {
                                                    ?>
                                                    <div class="single-item" style="margin-top:20px;" onclick="tagImageCorrection('<?php echo $row['imagename'] ?>')"><img style="cursor:Pointer;border-radius:10px;box-shadow: 2px 1px #666;height:100px; width:100px;margin:10px;"  src="uploaded/<?php echo $row['imagename'] ?>" >
                                                    </div>
                                                    
                                                    <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                        <input type="hidden" value="sample.png" id="tagImageValueCorrection" class="form-control" style="width:20%"readonly/>
                                        <input type="hidden" value="<?php echo $Datetoday ?>" id="tagImageDateCorrection" class="form-control" style="width:20%"readonly/>
                                            
                                            <img class="pull-right"style="height:50px; width:50px;margin:10px;margin-right:100px;" id="imgClickAndChangeCorrection" src="uploaded/<?php echo $row['imagename'] ?>">
                                                <label class="pull-right" style="margin-top:25px;">Image Preview </label>
                                    </div>
                                    <div id="remarksresultCorrection"></div>
                        
                                
                            </form>
                        </div>
                    

                        <div id="correctionimage" style="display:none">
                            <form method="POST" action="" id="formImageCorrection" enctype="multipart/form-data">
                                <div class="modal-text">
                                
                                    <input type="hidden" name="PidImage" id="PidImage" placeholder="Pid"/>
                                    <input type="hidden" name="typeimg" id="typeimg" placeholder="type"/>
                                    <input type="hidden" name="FidImageCorrection" id="FidImageCorrection" placeholder="FidImageCorrection"/>
                                    <input type="hidden" name="DateImage2" id="DateImage2" placeholder="Date"/>
                                    <strong><label>Record Code:</label></strong><strong><input type="text" id="CridImage" name="CridImage"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" readonly/></strong>
                                    <strong><label>Correction:</label></strong><strong><input type="text" id="CorrectionDetails" name="CorrectionDetails"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" readonly/></strong>
                                    <!-- <strong><label>Phase:</label></strong><strong><input type="text" id="PName" name="PName"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" disabled/></strong> -->
                                    <strong><input type="hidden" id="DateImage" name="DateImage"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" readonly/></strong>
                                    <input type="file" class="form-control" id="addmoreImg" name="addmoreImg[]" multiple="" />
                                

                                    <footer class="panel-footer">
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button type="submit"class="btn btn-warning" > Upload</button>
                                                <button type="button" class="btn btn-default" onclick="closemodalCorrection()">Back</button>
                                            </div>
                                        </div>
                                    </footer>
                                
                                </div>

                                <div id="imageresultcorrection"></div>

                            </div>
                        
                            </form>
                        </div>
                    </div>

                </section>

                <section class="panel" id="addImgmodal" style="display:none;height:500px;">
                    <header class="panel-heading" style="background-color:#649d29ad"  >
                    <img  src="icons/tag2.png" style="height:30px;width:auto;cursor:pointer;" /><label style="color:#fff;font-size:20px;">Add Image</label>
                    </header>
                    <div class="panel-body" style="color:#666">
                
                        <div class="panel-body" style="color:#666">
                            <div class="modal-wrapper">
                                <form method="POST" action="" id="formImagePoints" enctype="multipart/form-data">
                                        <div class="modal-text">
                                        
                                            <input type="hidden" name="PidImage" id="PidImage" placeholder="Pid"/>
                                            <input type="hidden" name="typeimg" id="typeimg" placeholder="type"/>
                                            <input type="hidden" name="FidImage2" id="FidImage2" placeholder="Fid"/>
                                            <input type="hidden" name="DateImage2" id="DateImage2" placeholder="Date"/>
                                            <strong><label>Record Code:</label></strong><strong><input type="text" id="FidImage" name="Fidage"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" disabled/></strong>
                                            <strong><label>Phase:</label></strong><strong><input type="text" id="PName" name="PName"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" disabled/></strong>
                                            <strong><input type="text" id="DateImage" name="DateImage"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" Disabled/></strong>
                                            <input type="file" class="form-control" id="addmoreImg" name="addmoreImg[]" multiple="" />
                                        </div>

                                        <div id="imageresult"></div>
                            
                                    </div>
                                    <footer class="panel-footer">
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button type="submit"class="btn btn-success" > Upload</button>
                                                <button type="button" class="btn btn-default" onclick="closemodalCorrective()">Back</button>
                                            </div>
                                        </div>
                                    </footer>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            
        </div>
    </div>

</div>

