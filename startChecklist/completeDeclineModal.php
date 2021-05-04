<a style="display:none;" id="completeDeclineModal" class="mb-xs mt-xs mr-xs modal-basic btn btn-danger" href="#modalcompleteDeclineModal">Primary</a>
<div id="modalcompleteDeclineModal" class="modal-block modal-header-color modal-block-danger mfp-hide">

<!-- modal question -->
        <section class="panel" id="modalSectionOne">
            <header class="panel-heading">
                <h2 class="panel-title">Decline Modal</strong></h2>
            </header>
            <div class="panel-body">
                
                    <div class="form-group mt-lg">
                        <div class="col-sm-12" >
                        
                        
                        <label style="margin-top:30px;margin-left:40px;" for="qastaff"><strong>Do you want to Decline this Phase?</strong></label>
                        <small><label style="margin-left:40px;" for="qastaff">If Yes, User will proceed to User Confirmation and this Phase will be <strong> declined</strong></label></small>
                
                        </div>
                    </div>

            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                    <button type="submit" onclick="submitformdeclineConfirmation();" class="btn btn-danger">Yes</button>
                        <button id="closemodal"class="btn btn-default modal-dismiss">No</button>
                    </div>
                </div>
            </footer>
        </section> 



    <!-- Modal confirmation -->
        <section class="panel" style="display:none;" id="modalSectionTwo">
            <header class="panel-heading">
                <h2 class="panel-title">User|<strong>Confirmation</strong></h2>
            </header>
            <div class="panel-body">
                
             <form id="submitDeclineGrades" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
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
                            <input type="text" class="form-control" name="qastaff" id="qastaff" disabled/>
                            <label for="week"><strong>Week</strong></label>
                            <input type="text" class="form-control" name="week" id="week" value="<?php echo $week?>"disabled/>
                            <label for="week"><strong>Month</strong></label>
                            <input type="text" class="form-control" name="month" id="month" value="<?php echo $_GET['month']?>"disabled/>
                            <label for="week"><strong>Year</strong></label>
                            <input type="text" class="form-control" name="year" id="year" value="<?php echo $_GET['year']?>"disabled/>
                        
                            <label for=""><strong>Protech</strong></label>
                            <select name="user" id="user" class="form-control"></select>
                            <input  style="margin-top:10px" type="password"class="form-control" placeholder="Enter Password"name="password" id="password"/>

                            
                            <label for=""><strong>Reason</strong></label>
                            <select name="reason" id="reason" class="form-control">
                            <option value="Continuous production">Continuous production</option>
                            <option value="Continuous receiving of products from production">Continuous receiving of products from production</option>
                            <option value="Manual brushing of crates">Manual brushing of crates</option>
                            <option value="Continuous checking of pull out">Continuous checking of pull out</option>
                            <option value="Continuous delivery">Continuous delivery</option>
                            <option value="Pest control schedule">Pest control schedule</option>
                            <option value="Ending inventory schedule">Ending inventory schedule</option>
                            <option value="Insufficient water supply">Insufficient water supply</option>
                            </select>

                        </div>
                    </div>
                   
                
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="button" onclick="submitformdecline();" class="btn btn-danger">Complete Decline</button>
                        <button id="closemodal" onclick="submitformdeclineCancel()" class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
            </form>
        </section> 
</div>