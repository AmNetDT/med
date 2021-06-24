<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

?>


    <!-- Datatable !-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
    <script>
        $(document).ready(function() {
            $('#abdusalaam').DataTable();
            $('#rahmatullah').DataTable();
        });
    </script>
    <!-- End datatable !-->



    <div id="body_general">
        <div id="accounttile">
            <div class="col-sm-12 col-sm-6">
                <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
            </div>
        </div>

        <div class="container">
            <div class="jumbotron jumbotron-fluid pt-3 bg-white">
                <div id="accounttile" class="container">
                    <h3>Courses</h3>
                    <?php


                    $userSyscategory = escape($user->data()->syscategory);
                    if ($userSyscategory == 1) {

                    ?>
                        <div class="row my-4">
                            <div class="col-md-12 text-right">
                                <button class="add_course border">
                                    <span class="fa fa-plus"> Add Course</span>
                                </button>
                                <button class="add_school border">
                                    <span class="fa fa-plus"> Add School</span>
                                </button>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12 px-0">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                            <h6 class="card-title p-2">All Courses</h6>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <?php


                                                $programmea = Db::getInstance()->query("SELECT * FROM `courses` ORDER BY id DESC");
                                                if (!$programmea->count()) {
                                                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                                } else {

                                                ?>
                                                    <div class="table-responsive data-font">
                                                        <table id="rahmatullah" class="table table-hover table-bordered" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">SN</th>
                                                                    <th scope="col">Title</th>
                                                                    <th scope="col">Schools</th>
                                                                    <th scope="col">Lecturer</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($programmea->results() as $programme) {

                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $i++; ?></td>
                                                                        <td><?php echo $programme->title; ?></td>
                                                                        <td><?php

                                                                            $fatima = $programme->school;
                                                                            $programmea = Db::getInstance()->query("SELECT * FROM `schools` WHERE id = $fatima");
                                                                            if (!$programmea->count()) {
                                                                                echo "<h4 class='my-5 text-center'>Nothing to display.</h4>";
                                                                            } else {
                                                                                echo escape($programmea->results()[0]->title);
                                                                            }

                                                                            ?></td>
                                                                        <td><?php echo $programme->lecturer; ?></td>
                                                                        <td>
                                                                            <div id="<?php echo $programme->id; ?>" lang="<?php echo $programme->title; ?>" class="edit_course" style="float:left;">
                                                                                <button class=" btn btn-default border">
                                                                                    <span class="fa fa-edit"></span></button>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-5">
                                                <?php

                                                $programmea = Db::getInstance()->query("SELECT * FROM `schools` ORDER BY id DESC");
                                                if (!$programmea->count()) {
                                                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                                } else {

                                                ?>
                                                    <div class="table-responsive data-font">
                                                        <table id="rahmatullah" class="table table-hover table-bordered" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">SN</th>
                                                                    <th scope="col">Title</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($programmea->results() as $programme) {

                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $i++; ?></td>
                                                                        <td><?php echo $programme->title; ?></td>
                                                                        <td>
                                                                            <div id="<?php echo $programme->id; ?>" lang="<?php echo $programme->title; ?>" class="edit_schools" style="float:left;">
                                                                                <button class=" btn btn-default border">
                                                                                    <span class="fa fa-edit"></span></button>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php

                    } else {
                    ?>

                        <div class="row">

                            <div class="col-md-12 px-0">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                            <h6 class="card-title p-2">All Courses</h6>
                                        </div>


                                        <?php


                                        $programmea = Db::getInstance()->query("SELECT * FROM `courses` ORDER BY id DESC");
                                        if (!$programmea->count()) {
                                            echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                                        } else {

                                        ?>
                                            <div class="table-responsive data-font">
                                                <table id="rahmatullah" class="table table-hover table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">SN</th>
                                                            <th scope="col">Title</th>
                                                            <th scope="col">Schools</th>
                                                            <th scope="col">Lecturer</th>
                                                            <th scope="col">Test</th>
                                                            <th scope="col">Exam</th>
                                                            <th scope="col">Created BY</th>
                                                            <th scope="col">modified</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        foreach ($programmea->results() as $programme) {

                                                        ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $programme->title; ?></td>
                                                                <td><?php

                                                                    $fatima = $programme->school;
                                                                    $programmea = Db::getInstance()->query("SELECT * FROM `schools` WHERE id = $fatima");
                                                                    if (!$programmea->count()) {
                                                                        echo "<h4 class='my-5 text-center'>Nothing to display.</h4>";
                                                                    } else {
                                                                        echo escape($programmea->results()[0]->title);
                                                                    }

                                                                    ?></td>
                                                                <td><?php echo $programme->lecturer; ?></td>
                                                                <td><?php echo $programme->test; ?></td>
                                                                <td><?php echo $programme->exam; ?></td>
                                                                <td><?php

                                                                    $u = $programme->added_by;
                                                                    $username = Db::getInstance()->get('users', array('id', '=', $u));
                                                                    if ($username->count()) {
                                                                        echo escape($username->results()[0]->username);
                                                                    }
                                                                    ?></td>
                                                                <td><?php echo $programme->modified; ?></td>

                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>

                                            </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
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