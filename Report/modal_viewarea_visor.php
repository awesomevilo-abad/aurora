<a class="modal-with-form btn btn-default" href="#modalviewcheckgrade" id="viewcheckgrade" style="display:none;">Open Form</a>
    <div id="modalviewcheckgrade" class="modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading" style="background-color:#f26f26;">
                <h2 class="panel-title" style="color:#ffffff">Checklist</h2>
            </header>
            <div class="panel-body">
                <form id="formchange" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
                    <div class="form-group mt-lg">
                     
                        <section class="panel">
							
                            <div class="panel-body">
                                <input type="hidden" id ="aid" name="aid" class="form-control" disabled/>
                                <input type="hidden" id ="datechecked" name="datechecked" class="form-control" disabled/>
                               <label style="color:#666;"><strong>Phase Name</strong></label>
                                <input style=" background-color:transparent;border: 0px solid;width:100px;color:#666;" type="text" id ="phasename" name="phasename" disabled/><br>
                                <label style="color:#666;"><strong>Area Name</strong></label>
                                <input style=" background-color:transparent;border: 0px solid;width:100px;color:#666;" type="text" id ="areaname" name="areaname"  disabled/>

                                <div id="checklistgradetable"></div>
                                
                                
                            </div>
                            
                        </section>
                   
                
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="closemodalchange"class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
            </form>
        </section>
    </div>
    