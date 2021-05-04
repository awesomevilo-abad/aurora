
 <?php
    $sid = $_POST['userid'];
 session_start(); 
 include_once 'Class.php';
 $crudcontroller = new CrudController();
 $dao = new Dao();
 $conn = $dao->openConnection();
 ?>
 <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
    <thead>
        <th>Code</th>
        <th>Full Name</th>
        <th>Phase</th>
        <th>Remove</th>
    </thead>
    <tbody>
        <?PHP
        $showuserphase = $conn->prepare("SELECT * FROM user_phase left join accounts on user_phase.sid = accounts.Acid inner join phase on user_phase.pid = phase.pid  WHERE user_phase.sid ='".$sid."' ORDER BY sid DESC ");
        $showuserphase->execute();
        WHILE($rowshowuserphase = $showuserphase->fetch(PDO::FETCH_ASSOC)){
        ?>
            <tr>
            <td><?php echo $rowshowuserphase['upid'];?></td>
            <td><?php echo $rowshowuserphase['AcName'];?></td>
            <td><?php echo $rowshowuserphase['PName'];?></td>
            <td><button id="<?php echo $rowshowuserphase["upid"]; ?>" class="bn-removed mb-xs mt-xs mr-xs btn btn-default"> <img src="icons/remove.png" style="height:25px; width:25px">Remove</button></td>
            </tr>
        <?php 
        }

        ?>
    </tbody>


</table>


		