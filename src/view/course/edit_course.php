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
                     <h6>Course Title</h6>

                     <div class="col-sm-12">

                         <?php


                            $username = escape($user->data()->id);
                            $Syscategory = escape($user->data()->syscategory);
                            $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $Syscategory");

                            if ($Syscategory == 1) {

                                $ptype = Db::getInstance()->query("SELECT * FROM `courses` WHERE id=$id");
                                foreach ($ptype->results() as $ptypes) {

                            ?>
                                 <form autocomplete="off">
                                     <div class="row">
                                         <div class="form-group">
                                             <label for="Title" class="sr-only"> Course Title</label>
                                             <textarea name="Title" id="Title" placeholder="Course Title" class="form-control" cols="50" style="width: 100%"><?php echo $ptypes->title; ?></textarea>

                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="form-group">
                                             <label for="School" class="sr-only">School</label>
                                             <select class="form-control" name="School" id="School">
                                                 <?php

                                                    $p = $ptypes->school;
                                                    $programme = Db::getInstance()->get('schools', array('id', '=', $p));
                                                    if ($programme->count()) { ?>
                                                     <option value="<?php echo $ptypes->school; ?>"><?php echo escape($programme->results()[0]->title); ?></option>
                                                 <?php }
                                                    ?>

                                                 <?php

                                                    $programmes = Db::getInstance()->query("SELECT * FROM `schools` ORDER BY id DESC");
                                                    foreach ($programmes->results() as $programmes) {

                                                    ?>
                                                     <option value="<?php echo $programmes->id; ?>"><?php echo $programmes->title; ?></option>
                                                 <?php
                                                    }
                                                    ?>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="form-group">
                                             <label for="Lecturer" class="sr-only"> Lecturer</label>
                                             <input type="text" name="Lecturer" id="Lecturer" class="form-control" value="<?php echo $ptypes->lecturer; ?>" />
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="form-group">
                                             <label for="Test" class="sr-only"> Text</label>
                                             <input type="text" name="Test" id="Test" class="form-control" value="<?php echo $ptypes->test; ?>" />

                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="form-group">
                                             <label for="Exam" class="sr-only"> Exam</label>
                                             <input type="text" name="Exam" id="Exam" class="form-control" value="<?php echo $ptypes->exam; ?>" />


                                             <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                                             <input type="hidden" name="id" id="id" value="<?php echo $ptypes->id; ?>" />
                                         </div>
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
     $(document).ready(function(e) {
         $("#save").click(function() {

             let id = $('#id').val();
             let Title = $('#Title').val();
             let School = $('#School').val();
             let Lecturer = $('#Lecturer').val();
             let Test = $('#Test').val();
             let Exam = $('#Exam').val();
             let added_by = $('#added_by').val();


             $.ajax({
                 url: "view/course/edit_course_server",
                 method: 'POST',
                 data: {
                     'id': id,
                     'Title': Title,
                     'School': School,
                     'Lecturer': Lecturer,
                     'Test': Test, 
                     'Exam': Exam,
                     'added_by': added_by
                 },
                 success: function(data) {

                     dalert.alert(data);
                     //dataTable.ajax.reload();

                 }
             });

         });
         e.preventDefault();
     });
 </script>