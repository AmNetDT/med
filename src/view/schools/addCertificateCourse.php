<?php

require_once '../../core/init.php';
$id = $_POST['id'];
$user = new User();
if ($user->isLoggedIn()) {

?>

    <div class="container">
        <div class="jumbotron jumbotron-fluid pt-1 bg-white">
            <div id="accounttile" class="container">

                <div class="card-body text-center">
                    <p class="login-card-description">
                        Add Course to Certificate</p>
                    <?php

                    $syscategory = escape($user->data()->syscategory);
                    $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $syscategory");

                    if ($syscategory == 1) {

                    ?>
                        <form class="row" autocomplete="off">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="certificate" id="labelcertificate" class="sr-only">Certificate</label>
                                    <select class="form-control" name="certificate" id="certificate">

                                        <?php
                                        $certificates = Db::getInstance()->get('certificates', array('id', '=', $id));
                                        if ($certificates->count()) {
                                        ?>
                                            <option selected value="<?php echo escape($certificates->results()[0]->id); ?>"><?php echo escape($certificates->results()[0]->title); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course" class="sr-only">Course</label>
                                    <select class="form-control" name="course" id="course">
                                        <option selected>--Select Course--</option>
                                        <?php

                                        $programmes = Db::getInstance()->query("SELECT * FROM `courses` ORDER BY `id` DESC");
                                        foreach ($programmes->results() as $programmes) {

                                        ?>
                                            <option value="<?php echo $programmes->id; ?>"><?php echo $programmes->title; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="submitButton">
                                <button type="button" id="save" class="btn btn-light">
                                    <span class="fa fa-save"> Save</span>
                                </button>
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
    $(document).ready(function(event) {
        $("#save").click(function() {

            let certificate = $('#certificate').val();
            let course = $('#course').val();

            $.ajax({
                url: "view/schools/addCertificateCourse_server",
                method: 'POST',
                data: {

                    'certificate': certificate,
                    'course': course

                },
                success: function(data) {

                    dalert.alert(data);
                    dataTable.ajax.reload();

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

        //event.preventDefault();
    });
</script>