 <?php

    require_once '../../core/init.php';

    $user = new User();
    if ($user->isLoggedIn()) {

    ?>
     <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
     <html xmlns="http://www.w3.org/1999/xhtml">

     <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
         <title>Untitled Document</title>
     </head>

     <body>
         <div class="container">

             <div class="px-3 text-center">

                 <p class="login-card-description mt-2">
                     Add Course</p>
                 <form method="POST" autocomplete="off">
                     <div class="form-group">
                         <label for="Title" class="sr-only">Course Title</label>
                         <input type="text" name="title" value="" id="title" class="form-control" placeholder="Course Title" />
                     </div>
                     <div class="form-group">
                         <label for="school" class="sr-only">School</label>
                          <select class="form-control" name="school" id="school">
                             <option selected>--Type of School--</option>
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
                     <div class="form-group">
                         <label for="lecturer" class="sr-only">Lecturer</label>
                         <input type="text" name="lecturer" value="" id="lecturer" class="form-control" placeholder="Lecturer Name" />
                     </div>
                     <div class="form-group">
                         <label for="test" class="sr-only">Test Total</label>
                         <input type="text" name="test" value="" id="test" class="form-control" placeholder="Test Total" />
                     </div>
                     <div class="form-group">
                         <label for="exam" class="sr-only">Exam</label>
                         <input type="text" name="exam" value="" id="exam" class="form-control" placeholder="Exam Total" />
                     </div>
                     <?php
                        $username = escape($user->data()->id);

                        ?>
                     <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                     <div id="submitButton">
                         <button type="button" id="save" class="border">
                             <span class="fa fa-save"> Save</span>
                         </button>
                     </div>
                 </form>
             </div>
             <div class="mt-3 mb-0 text-right">
                 <button class='myPop-close btn-danger'><span class='fa fa-times text-white'></span> Close</button>
             </div>
         </div>




     </body>
     </form>

     </html>
 <?php

    } else {
        $user->logout();
        Redirect::to('../../login/');
    }


    ?>
 <script>
     $(document).ready(function(e) {
         $("#save").click(function() {

             var title = $('#title').val();
             var school = $('#school').val();
             var lecturer = $('#lecturer').val();
             var test = $('#test').val();
             var exam = $('#exam').val();
             var added_by = $('#added_by').val();

             if (title != '' || school != '') {
                 $.ajax({
                     url: "view/course/add_course_server.php",
                     method: 'POST',
                     data: {

                         'title': title,
                         'school': school,
                         'lecturer': lecturer,
                         'test': test,
                         'exam': exam,
                         'added_by': added_by

                     },
                     success: function(data) {

                         dalert.alert(data);
                         //dataTable.ajax.reload("index");

                     }
                 });
             } else {
                 dalert.alert("Course title and school name are required.");
             }
         });
         e.preventDefault();
     });
 </script>