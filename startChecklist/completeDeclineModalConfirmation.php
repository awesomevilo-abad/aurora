<a style="display:none;" id="completeModalConfirmation" class="mb-xs mt-xs mr-xs modal-basic btn btn-danger" href="#completedeclinemodalconfirmation">Primary</a>
<div id="completedeclinemodalconfirmation" class="modal-block modal-header-color modal-block-danger mfp-hide">
<section class="panel">
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
                        
                        <label for=""><strong>Protech</strong></label>
                            <select name="user" id="user" class="form-control">

                            </select>
                            <input  style="margin-top:10px" type="password"class="form-control" placeholder="Enter Password"name="password" id="password"/>
                        </div>
                    </div>
                   
                
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" onclick="submitformdecline();" class="btn btn-danger">Complete Decline</button>
                        <button id="closemodal"class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
            </form>
        </section>
</div>