<a style="display:none;" id="completeModal" class="mb-xs mt-xs mr-xs modal-basic btn btn-success" href="#modalHeaderColorPrimary2">Primary</a>
<div id="modalHeaderColorPrimary2" class="modal-block modal-header-color modal-block-success mfp-hide">
    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tabs">
                                    <!-- header -->
                                    <ul class="nav nav-tabs nav-justified">
                                    <li class="active">
                                            <a href="#Single" data-toggle="tab" class="text-center"> <img style="background-color:#dfdfdf; border-radius:10px;height:25px;" src="icons/single.png">   Single</a>
                                        </li>
                                        <li >
                                            <a href="#Tandem" data-toggle="tab" class="text-center"> <img style="background-color:#dfdfdf; border-radius:10px;height:25px;"  src="icons/tandem.png">   Tandem</a>
                                        </li>
                                    </ul>

                                    <!-- tab body -->
                                    <div class="tab-content">
                                        <div id="Single" class="tab-pane active">
                                            <!-- <p>Data Here</p> -->
                                            <section class="panel" id="showconfirmation">
                                                <header class="panel-heading">
                                                <h2 class="panel-title"> User|<strong>Confirmation - Single</strong></h2>
                                                </header>
                                                <div class="panel-body">
                                                    
                                                <form id="submitGrades" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
                                                        <div class="form-group mt-lg">
                                                            <div class="col-sm-12">
                                                            
                                                            <input type="hidden" name="phaseid" id="phaseid"/>
                                                            <input type="hidden" name="bldgcat" id="bldgcat"/>
                                                            <input type="hidden" name="bldgid" id="bldgid"/>
                                                            <input type="hidden" name="datechecked" id="datechecked"/>
                                                            <input type="hidden" name="datereset" id="datereset"/>
                                                            <label for="qastaff"><strong>OA Staff</strong></label>
                                                            <input type="hidden" class="form-control" name="totalsani" id="totalsani" disabled/>
                                                            <input type="hidden" class="form-control" name="totalstru" id="totalstru" disabled/>
                                                            <input type="hidden" class="form-control" name="totalequip" id="totalequip" disabled/>
                                                            <input type="hidden" class="form-control" name="targetgradestatus_sani" id="targetgradestatus_sani" disabled/>
                                                            <input type="hidden" class="form-control" name="targetgradestatus_str" id="targetgradestatus_str" disabled/>
                                                            <input type="hidden" class="form-control" name="targetgradestatus_equip" id="targetgradestatus_equip" disabled/>
                                                            <input type="text" class="form-control" name="qastaff" id="qastaff" disabled/>
                                                            
                                                            <label for=""><strong>Protech</strong></label>
                                                                <select name="user" id="user" class="form-control">

                                                                </select>
                                                                <input style="margin-top:10px" type="password"class="form-control" placeholder="Enter Password"name="password" id="password"/>
                                                            </div>
                                                        </div>
                                                    
                                                    
                                                </div>
                                                <footer class="panel-footer">
                                                    <div class="row">
                                                        <div class="col-md-12 text-right">
                                                            <button type="submit" onclick="submitform();" class="btn btn-success">Submit</button>
                                                            <button id="closemodal"class="btn btn-default modal-dismiss">Cancel</button>
                                                        </div>
                                                    </div>
                                                </footer>
                                                </form>
                                            </section>
                                        </div>

                                        <div id="Tandem" class="tab-pane">
                                            <!-- <p>Data Here</p> -->
                                            <section class="panel" id="tandem_showconfirmation">
                                                <header class="panel-heading">
                                               <h2 class="panel-title"> User|<strong>Confirmation - Tandem</strong></h2>
                                                </header>
                                                <div class="panel-body">
                                                    
                                                <form id="tandem_submitGrades" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
                                                        <div class="form-group mt-lg">
                                                            <div class="col-sm-12">
                                                            
                                                            <input type="hidden" name="tandem_phaseid" id="tandem_phaseid"/>
                                                            <input type="hidden" name="tandem_bldgcat" id="tandem_bldgcat"/>
                                                            <input type="hidden" name="tandem_bldgid" id="tandem_bldgid"/>
                                                            <input type="hidden" name="tandem_datechecked" id="tandem_datechecked"/>
                                                            <input type="hidden" name="tandem_datereset" id="tandem_datereset"/>
                                                            <label for="qastaff"><strong>OA Staff</strong></label>
                                                            <input type="hidden" class="form-control" name="tandem_totalsani" id="tandem_totalsani" disabled/>
                                                            <input type="hidden" class="form-control" name="tandem_totalstru" id="tandem_totalstru" disabled/>
                                                            <input type="hidden" class="form-control" name="tandem_totalequip" id="tandem_totalequip" disabled/>
                                                            <input type="hidden" class="form-control" name="tandem_targetgradestatus_sani" id="tandem_targetgradestatus_sani" disabled/>
                                                            <input type="hidden" class="form-control" name="tandem_targetgradestatus_str" id="tandem_targetgradestatus_str" disabled/>
                                                            <input type="hidden" class="form-control" name="tandem_targetgradestatus_equip" id="tandem_targetgradestatus_equip" disabled/>
                                                            <input type="text" class="form-control" name="tandem_qastaff" id="tandem_qastaff" disabled/>
                                                            
                                                            <label for=""><strong>Protech 1</strong></label>
                                                                <select name="tandem_user" id="tandem_user" class="form-control">

                                                                </select>
                                                                <input style="margin-top:10px" type="password"class="form-control" placeholder="Enter Password"name="tandem_password" id="tandem_password"/>
                                                                
                                                            <label for=""><strong>Protech 2</strong></label>
                                                                <select name="tandem_user2" id="tandem_user2" class="form-control">

                                                                </select>
                                                                <input style="margin-top:10px" type="password"class="form-control" placeholder="Enter Password"name="tandem_password2" id="tandem_password2"/>
                                                            </div>
                                                        </div>
                                                    
                                                    
                                                </div>
                                                <footer class="panel-footer">
                                                    <div class="row">
                                                        <div class="col-md-12 text-right">
                                                            <button type="button" onclick="tandem_submitform();" class="btn btn-success">Submit</button>
                                                            <button id="closemodal"class="btn btn-default modal-dismiss">Cancel</button>
                                                        </div>
                                                    </div>
                                                </footer>
                                                </form>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


        <section class="panel" id="showtime">
            <header class="panel-heading">
           <h2 class="panel-title"> QA Audit|<strong>Duration</strong></h2>
            </header>
            <div class="panel-body">
                
             <form id="submitGrades" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
                    <div class="form-group mt-lg">
                        <div class="col-sm-12">
                        
                        <label for="qastaff"><strong>OA Staff</strong></label>
                        <input type="hidden" name="phaseid_showtime" id="phaseid_showtime"/>
                        <!-- <input type="hidden" name="bldgcat" id="bldgcat"/>
                        <input type="hidden" name="bldgid" id="bldgid"/>
                        <input type="hidden" name="datechecked" id="datechecked"/>
                        <input type="hidden" name="datereset" id="datereset"/>
                        <input type="hidden" class="form-control" name="totalsani" id="totalsani" disabled/>
                        <input type="hidden" class="form-control" name="totalstru" id="totalstru" disabled/>
                        <input type="hidden" class="form-control" name="totalequip" id="totalequip" disabled/>
                        <input type="hidden" class="form-control" name="targetgradestatus_sani" id="targetgradestatus_sani" disabled/>
                        <input type="hidden" class="form-control" name="targetgradestatus_str" id="targetgradestatus_str" disabled/>
                        <input type="hidden" class="form-control" name="targetgradestatus_equip" id="targetgradestatus_equip" disabled/> -->
                        <input type="text" class="form-control" name="qastaff_showtime" id="qastaff_showtime" disabled/>
                        <label for="qastaff"><strong>Audit Duration</strong></label>
                        <strong><input style="text-align:center; font-size:50px;height:60px;" class="form-control" type="text" name="showtimediff" id="showtimediff" value="" readonly/></strong>
                        <small>Hour : Minutes : Seconds</small>
                        </div>
                    </div>
                   
                
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                    <button type="button" id="nextphaseclick" onclick="nextphase()" class="btn btn-success"></button>
                    <button type="button" id="addTime" onclick="addPhaseTime()" class="btn btn-success">Choose Phase</button>
                    </div>
                </div>
            </footer>
            </form>
        </section>

        
</div>