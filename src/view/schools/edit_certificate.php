 <?php

    require_once '../../core/init.php';
    $id = $_POST['id'];
    $user = new User();
    if ($user->isLoggedIn()) {

    ?>
     <div class="row m-0 p-0">
         <div class="container">
             <div class="card" style="max-width: 100%;">
                 <div class="row no-gutters">
                     <h6>Certificate Title</h6>

                     <div class="col-sm-12">

                         <?php


                            $username = escape($user->data()->id);
                            $Syscategory = escape($user->data()->syscategory);
                            $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $Syscategory");

                            if ($Syscategory == 1) {

                                $ptype = Db::getInstance()->query("SELECT * FROM `certificates` WHERE id=$id");
                                foreach ($ptype->results() as $ptypes) {

                            ?>
                                 <form autocomplete="off">

                                     <div class="row">
                                         <div class="form-group">
                                             <label for="programme" class="sr-only">Programme</label>
                                             <select class="form-control" name="Programme" id="Programme">
                                                 <?php

                                                    $p = $ptypes->programme;
                                                    $programme = Db::getInstance()->get('programmes', array('id', '=', $p));
                                                    if ($programme->count()) { ?>
                                                     <option value="<?php echo $ptypes->programme; ?>"><?php echo escape($programme->results()[0]->category); ?></option>
                                                 <?php }
                                                    ?>

                                                 <?php

                                                    $programmes = Db::getInstance()->query("SELECT * FROM `programmes` ORDER BY id DESC");
                                                    foreach ($programmes->results() as $programmes) {

                                                    ?>
                                                     <option value="<?php echo $programmes->id; ?>"><?php echo $programmes->category; ?></option>
                                                 <?php
                                                    }
                                                    ?>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="form-group">
                                             <label for="title" class="sr-only"> Certificate Title</label>
                                             <textarea name="Title" id="Title" placeholder="Certificate Title" class="form-control" cols="50" style="width: 100%"><?php echo $ptypes->title; ?></textarea>

                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="form-group">
                                             <label for="objectives" class="sr-only"> Course Objectives</label>
                                             <textarea name="objectives" id="objectives" class="form-control" cols="50" style="width: 100%" placeholder="Course Objectives"><?php echo $ptypes->course_objective; ?></textarea>

                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="form-group">
                                             <label for="duration" class="sr-only"> Duration</label>
                                             <input type="text" name="Duration" id="Duration" class="form-control" value="<?php echo $ptypes->duration; ?>" />
                                         </div>

                                         <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                                         <input type="hidden" name="id" id="id" value="<?php echo $ptypes->id; ?>" />
                                     </div>
                                     <div class="row">

                                         <div id="submitButton">
                                             <button type="button" id="save" class="btn btn-light">
                                                 <span class="fa fa-save"> Save</span>
                                             </button>
                                         </div>
                                     </div>
                                 </form>
                         <?php
                                }
                            }
                            ?>
                     </div>
                 </div>
                 <div class="mt-3 mb-0 text-right">
                     <button class='myPop-close btn-danger'><span class='fa fa-times text-white'></span> Close</button>
                 </div>
             </div>
         </div>
     </div>



 <?php

    } else {
        $user->logout();
        Redirect::to('../../login/');
    }


    ?>
 <script>
     $(document).ready(function(event) {
         $("#save").click(function() {

             let id = $('#id').val();
             let Programme = $('#Programme').val();
             let Title = $('#Title').val();
             let Objectives = $('#objectives').val();
             let Duration = $('#Duration').val();
             let added_by = $('#added_by').val();


             $.ajax({
                 url: "view/schools/edit_certificate_server",
                 method: 'POST',
                 data: {
                     'id': id,
                     'Programme': Programme,
                     'Objectives': Objectives,
                     'Title': Title,
                     'Duration': Duration,
                     'added_by': added_by
                 },
                 success: function(data) {

                     dalert.alert(data);
                     //dataTable.ajax.reload();

                 }
             });

         });
         event.preventDefault();
     });
 </script>