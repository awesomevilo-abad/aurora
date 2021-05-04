

<div class="gallery">
               <table >
                     
                     <tr class="center">
                        
                     <center>
                         <h2>
                         <strong>Gallery</strong>
                        </h2>
                    </center>
                      </tr>

                     <tr>
                    <?php
    
                     $table = $crudcontroller->showAllCheckGrade();
                     if (! empty($table)) {
                         foreach ($table as $k => $v) {
                            ?>                     
                        <td>
                        <a href="uploaded/<?php echo $table[$k]['image'] ?>" data-lightbox="mygallery" data-title="<?php echo $table[$k]['image'] ?>"> <img src="uploaded/<?php echo $table[$k]['image'] ?>"> </a>
                        </td>
                     <?php
                        }
                      }
                     ?>
                     </tr>
             </table>
 </div>