<?php
$Datetoday = $crudcontroller->getDate();
?>

<a style="display:none;" id="viewAllImages" class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" href="#modal_viewAllImages">Primary</a>
<div id="modal_viewAllImages" class="modal-block modal-header-color modal-block-danger mfp-hide">
<!-- mfp-hide -->
    <div class="modal-dialog">


                <section class="panel" id="NonComplianceImage" style="height:500px;margin-left:-250px;float:left;width:1000px">
                    <header class="panel-heading" style="background-color:#f3463996"  >
                        <label style="color:#fff;font-size:20px;">Non Compliance Images</label>
                    </header>   
                    <div class="panel-body" style="color:#666">
                    <div class="form-group col-sm-06" onclick="compliancemode()" style="cursor:pointer">
                    <strong>Category: </strong><img src="icons/on.png" style="height:25px; width:25px"> <strong>Non Compliance:</strong>
                    </div>
                    
                        <div class="modal-wrapper">
                        
                    <button id="closemodal" class="btn btn-default modal-dismiss pull-right">Close</button>
                        <?php
                            $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                            $sql = "SELECT * FROM image_visor ";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                if ($stmt->rowCount() > 0) {
                                    foreach ($results as $row) {
                                ?>
                                <img style="height:100px; width:100px;margin:10px;" src="uploaded/<?php echo $row['imagename'] ?>" >
                                <?php
                                }
                            }
                         ?>
                        </div>
                    </div>
                </section>

        </div>
    </div>

</div>

