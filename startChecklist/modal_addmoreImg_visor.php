
<a style="display:none;" id="addmoreImgButtonvisor" class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" href="#modaladdmoreimgvisor">Primary</a>
<div id="modaladdmoreimgvisor" class="modal-block modal-header-color modal-block-danger mfp-hide">
    <section class="panel">
        <header class="panel-heading" style="background-color:#ffa726"  >
            <label style="color:#fff;font-size:20px;">Add More Image (Compliance)</label>
        </header>
        <div class="panel-body" style="color:#666">
            <div class="modal-wrapper">
                <form method="POST" action="" id="formImage_visor_compliance" enctype="multipart/form-data">
                        <div class="modal-text">
                        <input type="hidden" name="compliance"id="compliance" value="compliance"/>
                        <strong><input type="hidden" id="bidimg" name="bidimg"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" ></strong>
                        <strong><input type="hidden" id="pidimg" name="pidimg"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" ></strong>
                        <strong><input type="text" id="AName" name="AName"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" ></strong>
                        <strong><input type="hidden" id="Aid" name="Aid"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" ></strong>
                        <strong><input type="hidden" id="Date"  name="Date" class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd"></strong>
                        <input type="file" class="form-control" id="addmoreImg" name="addmoreImg[]" multiple="" />
                        </div>
                        <div id="imageresult"></div>
            
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-warning" > Upload</button>
                                <button id="closemodal"class="btn btn-default modal-dismiss">Cancel</button>
                            </div>
                        </div>
                    </footer>
                 </form>
            </div>
        </div>
    </section>
</div>

