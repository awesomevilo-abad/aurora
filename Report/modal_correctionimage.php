<?php
$Datetoday = $crudcontroller->getDate();
?>

<a style="display:none;" id="modal_correctionimage" class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" href="#manageimage">Primary</a>
<div id="manageimage" class="modal-block modal-header-color modal-block-danger mfp-hide">
   
<section class="panel" id="correctionimage" style="display:none;height:500px;">
    <header class="panel-heading" style="background-color:#649d29ad"  >
    <img  src="icons/tag2.png" style="height:30px;width:auto;cursor:pointer;" /><label style="color:#fff;font-size:20px;">Add Image</label>
    </header>
    <div class="panel-body" style="color:#666">
   
        <div class="panel-body" style="color:#666">
            <div class="modal-wrapper">
                <form method="POST" action="" id="correctionimageform" enctype="multipart/form-data">
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

                        <div id="imageresultform"></div>
            
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

