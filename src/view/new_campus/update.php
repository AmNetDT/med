 <?php

    require_once '../../core/init.php';
    $campus_id = $_POST['campus_id'];
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

                 <?php

                    $locations = Db::getInstance()->query("SELECT * FROM locations WHERE id=$campus_id");
                    foreach ($locations->results() as $location) {

                    ?>
                     <form method="POST" autocomplete="off">
                         <div class="form-group">
                             <label for="name" class="sr-only">Campus Name</label>
                             <input type="text" name="name" value="<?php echo $location->name; ?>" id="name" class="form-control" />
                         </div>
                         <div class="form-group">
                             <label for="username" class="sr-only">Location Address</label>
                             <input type="text" name="address" id="address" value="<?php echo $location->address; ?>" class="form-control" />
                         </div>
                         <div class="form-group">
                             <label for="name" class="sr-only">Telephone</label>
                             <input type="text" name="phone" value="<?php echo $location->phone; ?>" id="phone" class="form-control" />
                         </div>
                         <div class="form-group">
                             <label for="username" class="sr-only">Email</label>
                             <input type="text" name="email" id="email" value="<?php echo $location->email; ?>" class="form-control" />
                         </div>
                         <?php
                            $username = escape($user->data()->username);

                            ?>
                         <input type="hidden" name="id" id="location_id" value="<?php echo $location->id; ?>" />
                         <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                         <div id="submitButton">
                             <button type="button" id="save" class="btn btn-primary px-5 mb-3">
                                 Update
                             </button>
                         </div>
                     <?php } ?>
                     </form>
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
     $(document).ready(function(event) {
         $("#save").click(function() {

             var id = $('#location_id').val();
             var name = $('#name').val();
             var address = $('#address').val();
             var phone = $('#phone').val();
             var email = $('#email').val();
             var added_by = $('#added_by').val();

             if (name != '' && added_by != '') {
                 $.ajax({
                     url: "view/new_campus/updateserver.php",
                     method: 'POST',
                     data: {
                         location_id:id,
                         name: name,
                         address: address,
                         phone: phone,
                         email: email,
                         added_by: added_by

                     },
                     success: function(data) {

                         dalert.alert(data);
                         //dataTable.ajax.reload();

                     }
                 });
             } else {
                 dalert.alert("Location field is required");
             }
         });
         event.preventDefault();
     });
 </script>