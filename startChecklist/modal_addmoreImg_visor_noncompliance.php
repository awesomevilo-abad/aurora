
<a style="display:none;" id="addmoreImgButtonvisor_noncompliance" class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" href="#modaladdmoreimgvisor_noncompliance">Primary</a>
<div id="modaladdmoreimgvisor_noncompliance" class="modal-block modal-header-color modal-block-danger mfp-hide">
    <section class="panel">
        <header class="panel-heading" style="background-color:#ffa726"  >
            <label style="color:#fff;font-size:20px;">Add More Image (Non Compliance)</label>
        </header>
        <div class="panel-body" style="color:#666">
            <div class="modal-wrapper">
                <form method="POST" action="" id="formImage_visor_noncompliance" enctype="multipart/form-data">
                        <div class="modal-text">
                        <input type="hidden" name="noncompliance"id="noncompliance" value="noncompliance"/>
                        <strong><input type="hidden" id="bidimg2" name="bidimg2"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" ></strong>
                        <strong><input type="hidden" id="pidimg2" name="pidimg2"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" ></strong>
                        <strong><input type="text" id="AName2" name="AName2"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" ></strong>
                        <strong><input type="hidden" id="Aid2" name="Aid2"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" ></strong>
                        <strong><input type="hidden" id="Date2"  name="Date2" class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd"></strong>
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

