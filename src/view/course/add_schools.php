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
                     Add School Title</p>
                 <form method="POST" autocomplete="off">
                     <div class="form-group">
                         <label for="title" class="sr-only">School Title</label>
                         <input type="text" name="title" id="title" class="form-control" placeholder="School Name" />
                     </div>

                     <div id="submitButton">
                         <button type="button" id="save" class="btn btn-light">
                             <span class="fa fa-save"> Save</span>
                         </button>
                     </div>
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
     $(document).ready(function(e) {
         $("#save").click(function() {

             var Title = $('#title').val();
             
             if (Title != '') {
                 $.ajax({
                     url: "view/course/add_schools_server.php",
                     method: 'POST',
                     data: {
                         'Title': Title
                     },
                     success: function(data) {

                         dalert.alert(data);

                     }
                 });
             } else {
                 dalert.alert("School name is required");
             }
         });
         e.preventDefault();
     });
 </script>