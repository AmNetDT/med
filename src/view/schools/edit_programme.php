 <?php

    require_once '../../core/init.php';
    $programmer_id = $_POST['id'];
    $programmer = new User();
    if ($programmer->isLoggedIn()) {

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

                 <?php
                    $username = escape($programmer->data()->id);
                    $Syscategory = escape($programmer->data()->syscategory);
                    $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $Syscategory");

                    if ($Syscategory == 1) {

                        $programmea = Db::getInstance()->query("SELECT * FROM `programmes` WHERE id=$programmer_id");
                        foreach ($programmea->results() as $programme) {

                    ?>
                         <form autocomplete="off">

                             <div class="row">
                                 <div class="form-group">
                                     <label for="Category" class="sr-only"> Programme Category</label>
                                     <textarea name="Category" id="Category" class="form-control" cols="50" style="width: 100%"><?php echo $programme->category; ?></textarea>
                                     <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                                     <input type="hidden" name="id" id="id" value="<?php echo $programme->id; ?>" />
                                 </div>
                             </div>
                             <div class="row">
                                 <div id="submitButton">
                                     <button type="button" id="save" class="btn btn-light">
                                         <span class="fa fa-edit"> Update</span>
                                     </button>
                                 </div>
                             </div>
                         </form>
                 <?php }
                    }
                    ?>
             </div>
         </div>




     </body>
     </form>

     </html>
 <?php

    } else {
        $programmer->logout();
        Redirect::to('../../login/');
    }


    ?>
 <script>
     $(document).ready(function(e) {
         $("#save").click(function() {

             let id = $('#id').val();
             let Category = $('#Category').val();
             let added_by = $('#added_by').val();


             $.ajax({
                 url: "view/schools/edit_programme_server",
                 method: 'POST',
                 data: {
                     'id': id,
                     'Category': Category,
                     'added_by': added_by,

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