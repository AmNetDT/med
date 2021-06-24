<?php

require_once '../../core/init.php';
$id = $_POST['id'];
$title = $_POST['title'];
$course_objective = $_POST['objectives'];
$user = new User();
if ($user->isLoggedIn()) {

?>
    <div class="col-md-12">
        <div class="jumbotron jumbotron-fluid bg-white my-0 py-0">

            <div class="row">
                <div class="col-md-12">
                    <h3><?php echo $title ?></h3>
                    <p><strong>Course Objectives</strong> <br /><?php echo $course_objective ?></p>
                </div>
            </div>

            <?php


            // $username = escape($user->data()->id);
            $Syscategory = escape($user->data()->syscategory);
            $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $Syscategory");

            if ($Syscategory == 1) {

            ?>
                <div class="card">
                    <div class="row no-gutters">
                        <div id="btn_c" class="col-md-12 text-right">
                            <button id="<?php echo $id ?>" class="AddCertificateCourse border mb-1" type="submit">
                                <span class="fa fa-plus"> Add Course</span>
                            </button>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="card-body border-top">
                                <?php
                                $i = 1;
                                $courses = Db::getInstance()->query("SELECT * FROM `certificate_courses` WHERE `certificate_id`='$id'");
                                if (!$courses->count()) {

                                    echo "<div class='alert alert-danger'>Course not added</div>";
                                } else {
                                ?>
                                    <p><strong>Courses</strong></p>
                                    <table class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width:5%">#</th>
                                                <th scope="col" style="width:65%">Course Title</th>
                                                <th scope="col" style="width:5%">Test</th>
                                                <th scope="col" style="width:5%">Examination</th>
                                                <th scope="col" style="width:20%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php


                                            foreach ($courses->results() as $courset) {

                                                $p = $courset->course_id;
                                                $cert = Db::getInstance()->get('courses', array('id', '=', $p));
                                                if ($cert->count()) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td scope="row"><?php echo escape($cert->results()[0]->title); ?></td>
                                                        <td scope="row"><?php echo escape($cert->results()[0]->test); ?></td>
                                                        <td scope="row"><?php echo escape($cert->results()[0]->exam); ?></td>
                                                        <td>
                                                            <div id="<?php echo $courset->id; ?>" lang='<?php echo "certificate_courses"; ?>' class="delete_row">
                                                                <button class="btn-default border"><span class="fa fa-trash"></span></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>

                                    </table>

                                <?php
                                }
                                ?>


                            </div>
                        </div>
                    </div>

                </div>
            <?php
            } else {
            ?>

                <div class="card">
                    <div class="row no-gutters">

                        <div class="col-md-12 col-sm-12">
                            <div class="card-body border-top">
                                <?php
                                $i = 1;
                                $courses = Db::getInstance()->query("SELECT * FROM `certificate_courses` WHERE `certificate_id`='$id'");
                                if (!$courses->count()) {

                                    echo "<div class='alert alert-danger'>Course not added</div>";
                                } else {
                                ?>
                                    <p><strong>Courses</strong></p>
                                    <table class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width:5%">#</th>
                                                <th scope="col" style="width:65%">Course Title</th>
                                                <th scope="col" style="width:5%">Test</th>
                                                <th scope="col" style="width:5%">Examination</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php


                                            foreach ($courses->results() as $courset) {

                                                $p = $courset->course_id;
                                                $cert = Db::getInstance()->get('courses', array('id', '=', $p));
                                                if ($cert->count()) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td scope="row"><?php echo escape($cert->results()[0]->title); ?></td>
                                                        <td scope="row"><?php echo escape($cert->results()[0]->test); ?></td>
                                                        <td scope="row"><?php echo escape($cert->results()[0]->exam); ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>

                                    </table>

                                <?php
                                }
                                ?>


                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>

    </div>



<?php

} else {
    $user->logout();
    Redirect::to('../../login/');
}


?>