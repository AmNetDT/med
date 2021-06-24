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
                     <h6>Schools Title</h6>

                     <div class="col-sm-12">

                         <?php


                           // $username = escape($user->data()->id);
                            $Syscategory = escape($user->data()->syscategory);
                            $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $Syscategory");

                            if ($Syscategory == 1) {

                                $ptype = Db::getInstance()->query("SELECT * FROM `schools` WHERE id=$id");
                                foreach ($ptype->results() as $ptypes) {

                            ?>
                                 <form autocomplete="off">
                                   
                                     <div class="row">
                                         <div class="form-group">
                                             <label for="Title" class="sr-only"> Title</label>
                                             <input type="text" name="Title" id="Title" class="form-control" value="<?php echo $ptypes->title; ?>" />

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


             $.ajax({
                 url: "view/course/edit_schools_server",
                 method: 'POST',
                 data: {
                     'id': id,
                     'Title': Title,
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