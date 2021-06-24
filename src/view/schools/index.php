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
          <h3>Programmes</h3>
          <?php

          $username = escape($user->data()->id);
          $userSyscategory = escape($user->data()->syscategory);
          if ($userSyscategory == 1) {

          ?>
            <div class="row my-4">

              <div class="col-md-12 text-right">
                <button class="add_certificate border">
                  <span class="fa fa-plus"> Add Certificate</span>
                </button>
                <button class="add_programme border">
                  <span class="fa fa-plus"> Add Programme</span>
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 px-0">
                <div class="card">
                  <div class="card-body">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                      <h6 class="card-title p-2">All Programmes</h6>
                    </div>


                    <?php


                    $programmea = Db::getInstance()->query("SELECT * FROM `programmes` ORDER BY id DESC");
                    if (!$programmea->count()) {
                      echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    } else {

                    ?>

                      <div class="table-responsive data-font">
                        <table id="abdusalaam" class="table table-hover table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th scope="col">Modified</th>
                              <th scope="col">Category</th>
                              <th scope="col">Created BY</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            foreach ($programmea->results() as $programme) {

                            ?>
                              <tr>
                                <td><?php echo $programme->modified; ?></td>
                                <td><?php echo $programme->category; ?></td>
                                <td><?php

                                    $u = $programme->added_by;
                                    $username = Db::getInstance()->get('users', array('id', '=', $u));
                                    if ($username->count()) {
                                      echo escape($username->results()[0]->username);
                                    }
                                    ?></td>
                                <td>
                                  <div id="<?php echo $programme->id; ?>" lang="<?php echo $programme->category; ?>" class="edit_programme" style="float:left;">
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
              <div class="col-md-6 px-0">
                <div class="card">
                  <div class="card-body">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                      <h6 class="card-title p-2">All Certificates</h6>
                    </div>


                    <?php


                    $programmea = Db::getInstance()->query("SELECT * FROM `certificates` ORDER BY id DESC");
                    if (!$programmea->count()) {
                      echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    } else {

                    ?>

                      <div class="table-responsive data-font">
                        <table id="rahmatullah" class="table table-hover table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th scope="col">Modified</th>
                              <th scope="col">Title</th>
                              <th scope="col">Course Duration</th>
                              <th scope="col">Created BY</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            foreach ($programmea->results() as $programme) {

                            ?>
                              <tr>
                                <td><?php echo $programme->modified; ?></td>
                                <td><?php echo $programme->title; ?></td>
                                <td><?php echo $programme->duration; ?></td>
                                <td><?php

                                    $u = $programme->added_by;
                                    $username = Db::getInstance()->get('users', array('id', '=', $u));
                                    if ($username->count()) {
                                      echo escape($username->results()[0]->username);
                                    }
                                    ?></td>
                                <td>
                                  <div id="<?php echo $programme->id;
                                            ?>" lang="<?php echo $programme->title;
                                                      ?>" title="<?php echo $programme->course_objective; ?>" class="view_certificate" style="float:left;">
                                    <button class=" btn btn-default border">
                                      <span class="fa fa-search"></span></button>
                                  </div>
                                  <div id="<?php echo $programme->id; ?>" lang="<?php echo $programme->title; ?>" class="edit_certificate" style="float:left;">
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
          <?php

          } else {
          ?>

            <div class="row">
              <div class="col-md-12 px-0">
                <div class="card">
                  <div class="card-body">
                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                      <h6 class="card-title p-2">All Certificates</h6>
                    </div>


                    <?php


                    $programmea = Db::getInstance()->query("SELECT * FROM `certificates` ORDER BY programme DESC");
                    if (!$programmea->count()) {
                      echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                    } else {

                    ?>

                      <div class="table-responsive data-font">
                        <table id="abdusalaam" class="table table-hover table-bordered" style="width:100%">
                          <thead>
                            <tr>
                              <th scope="col">SN</th>
                              <th scope="col">Title</th>
                              <th scope="col">Course Objectives</th>
                              <th scope="col">Duration</th>
                              <th scope="col">Programme</th>
                              <th scope="col">Modified</th>
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
                                <td><?php echo $programme->course_objective; ?></td>
                                <td><?php echo $programme->duration; ?></td>
                                <td><?php

                                    $program = $programme->programme;
                                    $prog = Db::getInstance()->query("SELECT * FROM `programmes` WHERE id=$program");
                                    if ($prog->count()) {
                                      foreach ($prog->results() as $pro) {
                                        echo $pro->category;
                                      }
                                    } else {
                                      echo 'Nothing to display';
                                    }
                                    ?></td>
                                <td><?php echo $programme->modified; ?></td>
                                <td>
                                  <div id="<?php echo $programme->id;
                                            ?>" lang="<?php echo $programme->title;
                                                      ?>" title="<?php echo $programme->course_objective; ?>" class="view_certificate" style="float:left;">
                                    <button class=" btn btn-default border">
                                      <span class="fa fa-search"></span></button>
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
          <?php              }

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