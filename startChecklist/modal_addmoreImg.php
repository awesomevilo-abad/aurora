
<a style="display:none;" id="addmoreImgButton" class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" href="#modaladdmoreimg">Primary</a>
<div id="modaladdmoreimg" class="modal-block modal-header-color modal-block-danger mfp-hide">
    <section class="panel">
        <header class="panel-heading" style="background-color:#ffa726"  >
            <label style="color:#fff;font-size:20px;">Add More Image</label>
        </header>
        <div class="panel-body" style="color:#666">
            <div class="modal-wrapper">
                <form method="POST" action="" id="formImage" enctype="multipart/form-data">
                        <div class="modal-text">
                        <strong><input type="text" id="ChecklistName" name="ChecklistName" class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" ></strong>
                        <strong><input type="hidden" id="ChecklistId" name="ChecklistId"class="form-control" style="border:1px solid #fdfdfd;background-color:#fdfdfd" ></strong>
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

