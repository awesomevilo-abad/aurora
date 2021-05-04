<a class="modal-with-form btn btn-default" href="#modalviewcheckgrade" id="viewcheckgrade" style="display:none;">Open Form</a>
    
    <div id="modalviewcheckgrade" class="modal-block modal-block-primary mfp-hide" style="">
       
        <section class="panel" style="background-color:red" id="modalviewhistorygrade">
            <header class="panel-heading" style="background-color:#f26f26;">
                <h2 class="panel-title" style="color:#ffffff">Checklist</h2>
            </header>

            <div class="panel-body" id="">
                <form id="formchange" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
                    <div class="form-group mt-lg">
                     
                        <section class="panel">
							
                            <div class="panel-body">
                                <input type="hidden" id ="aid" name="aid" class="form-control" disabled/>
                                <input type="hidden" id ="datechecked" name="datechecked" class="form-control" disabled/>
                               <label style="color:#666;"><strong>Phase Name</strong></label>
                                <input style=" background-color:transparent;border: 0px solid;width:500px;color:#666;" type="text" id ="phasename" name="phasename" disabled/><br>
                                <label style="color:#666;"><strong>Area Name</strong></label>
                                <input style=" background-color:transparent;border: 0px solid;width:500px;color:#666;" type="text" id ="areaname" name="areaname"  disabled/>
                                <div id="checklistgradetable"></div>
                            </div>
                        </section>
                        <footer class="panel-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button id="closemodalchange"class="btn btn-default modal-dismiss">Cancel</button>
                                </div>
                            </div>
                        </footer>
                 </form>
            </div>
        </section>

        
        <section class="panel" style="background-color:red;display:none" id="modalviewhistorygrade_image">
            <header class="panel-heading" style="background-color:#f26f26;">
                <h2 class="panel-title" style="color:#ffffff">View Image</h2>
            </header>

            <div class="panel-body" id="">
                <form id="formchange" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
                    <div class="form-group mt-lg">
                     
                        <section class="panel">
							
                            <div class="panel-body">
                                <input type="hidden" id ="aid" name="aid" class="form-control" disabled/>
                                <input type="hidden" id ="datechecked" name="datechecked" class="form-control" disabled/>
                                <label style="color:#666;"><strong>Area Name</strong></label>
                                <input style=" background-color:transparent;border: 0px solid;width:500px;color:#666;" type="text" id="areaname_image" name="areaname_image"  readonly/>
                                <input style=" background-color:transparent;border: 0px solid;width:500px;color:#666;" type="text" id="areaid_image" name="areaid_image"  readonly/>
                                
                                <div id="loadcheckgradetable_image"></div>
                            </div>
                        </section>
                        <footer class="panel-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" onclick="switchtomodalviewhistorygrade()" class="btn btn-default ">Back</button>
                                </div>
                            </div>
                        </footer>
                 </form>
            </div>
        </section>

        
        <section class="panel" style="background-color:red;display:none" id="modalviewhistorygrade_image_equipment">
            <header class="panel-heading" style="background-color:#f26f26;">
                <h2 class="panel-title" style="color:#ffffff">View Image Equipment</h2>
            </header>

            <div class="panel-body" id="">
                <form id="formchange" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
                    <div class="form-group mt-lg">
                     
                        <section class="panel">
							
                            <div class="panel-body">
                                <input type="hidden" id ="eid" name="eid" class="form-control" disabled/>
                                <input type="hidden" id ="datecheckedequipment" name="datecheckedequipment" class="form-control" disabled/>
                                <label style="color:#666;"><strong>Equipment Name</strong></label>
                                <input style=" background-color:transparent;border: 0px solid;width:500px;color:#666;" type="text" id="equipmentname_image" name="equipmentname_image"  readonly/>
                                <input style=" background-color:transparent;border: 0px solid;width:500px;color:#666;" type="hidden" id="equipment_id" name="equipment_id"  readonly/>
                                
                                <div id="loadcheckgradetable_image_equipment"></div>
                            </div>
                        </section>
                        <footer class="panel-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" onclick="switchtomodalviewhistorygrade()" class="btn btn-default ">Back</button>
                                </div>
                            </div>
                        </footer>
                 </form>
            </div>
        </section>


    </div>
    