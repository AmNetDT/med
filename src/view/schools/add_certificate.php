<?php

require_once '../../core/init.php';


$user = new User();
if ($user->isLoggedIn()) {

?>

    <div class="container m-0 p-0">
        <div class="jumbotron jumbotron-fluid bg-white m-0 p-0">
            <div id="accounttile" class="">

                <div class="card-body text-center">
                    <p class="">
                        Add New Certificate</p>
                    <?php

                    $username = escape($user->data()->id);
                    $userSyscategory = escape($user->data()->syscategory);
                    $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");
                    if ($userSyscategory == 1) {
                    ?>
                        <form autocomplete="off">

                            <div class="row">
                                <div class="form-group">
                                    <label for="programme" class="sr-only">Programme</label>
                                    <select class="form-control" name="programme" id="programme">
                                        <option selected>--Type of programme--</option>
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
                                    <textarea name="title" id="title" class="form-control" cols="50" style="width: 100%" placeholder="Certificate Title"></textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="objectives" class="sr-only"> Course Objectives</label>
                                    <textarea name="objectives" id="objectives" class="form-control" cols="50" style="width: 100%" placeholder="Course Objectives"></textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="duration" class="sr-only"> Duration</label>
                                    <input type="text" name="duration" id="duration" class="form-control" placeholder="Duration" />
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
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

                    ?>
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


            let title = $('#title').val();
            let objectives = $('#objectives').val();
            let duration = $('#duration').val();
            let programme = $('#programme').val();
            let added_by = $('#added_by').val();


            $.ajax({
                url: "view/schools/add_certificate_server.php",
                method: 'POST',
                data: {

                    'title': title,
                    'objectives': objectives,
                    'duration': duration,
                    'programme': programme,
                    'added_by': added_by

                },
                success: function(data) {

                    dalert.alert(data);

                },
                error: function(xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }

            });

        });
        e.preventDefault();
    });
</script>