<a class="modal-with-form btn btn-default" href="#modalFormchange" id="change" style="display:none;">Open Form</a>
    <div id="modalFormchange" class="modal-block modal-block-primary mfp-hide">
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Change Staff</h2>
            </header>
            <div class="panel-body">
                <form id="formchange" method="post" class="form-horizontal mb-lg" novalidate="novalidate">
                    <div class="form-group mt-lg">
                        <div class="col-sm-12">
                            <input type="hidden" name="phid" id="phid"/>
                            <select name="user" id="user" class="form-control">
                                
                            </select>
                        </div>
                    </div>
                   
                
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-warning">Submit</button>
                        <button id="closemodalchange"class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
            </form>
        </section>
    </div>