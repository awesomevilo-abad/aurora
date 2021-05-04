<a style="display:none;" id="skipModal" class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" href="#modalHeaderColorDanger">Primary</a>
<div id="modalHeaderColorDanger" class="modal-block modal-header-color modal-block-danger mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Skip Area</h2>
                    <div >
                        <h2><a style="height:10px;width:10px;border-radius:50%;color:#dfdfdf;text-decoration:none;right:30px;position: absolute;
	                    top: 15px;" href="#" class="modal-dismiss fa fa-times"></a></h2>
                    </div>

        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-icon">
                    <i class="fa fa-question-circle"></i>
                </div>
                <div class="modal-text">
                   <center> <h4>
                    <p>Do you want to Skip this Area?</p></center></h4>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <input type="text" id="AreaId"/> <!--id na isasama sa ajax-->
                    <button onclick="skipAreaModalButton()" class="btn btn-danger" > Continue</button>
                </div>
            </div>
        </footer>
    </section>
</div>