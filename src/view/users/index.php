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
      $('#abdganiu').DataTable();
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
          <h3>Manage User</h3>
          <div class="row">
            <div class="container">
              <div id="btn_c" style="text-align: right;">
                <button class="reg_user border mb-1" type="submit">
                  <span class="fa fa-plus"> Add User</span>
                </button>
              </div>


              <div class="table-responsive data-font">
                <?php

                $username = escape($user->data()->id);
                $userSyscategory = escape($user->data()->syscategory);
                $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

                if ($userSyscategory == 1) {

                  $user = Db::getInstance()->query("SELECT * FROM users");

                  if (!$user->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>
                    <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Username</th>
                          <th>Privilege</th>
                          <th>School</th>
                          <th>Programme</th>
                          <th>Location</th>
                          <th>Created</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>

                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->username; ?></td>
                            <td><?php

                                $sysId = $user->syscategory;
                                $syscategory = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id`=$sysId");
                                foreach ($syscategory->results() as $sysName) {
                                  print $sysName->name;
                                }
                                ?></td>
                            <td><?php

                                $schoolId = $user->school;
                                $schools = Db::getInstance()->query("SELECT * FROM `certificates` WHERE `id`=$schoolId");
                                foreach ($schools->results() as $school) {
                                  print $school->title;
                                }
                                ?></td>
                            <td><?php

                                $schools = Db::getInstance()->query("SELECT * FROM `certificates` WHERE `id`=$schoolId");
                                foreach ($schools->results() as $school) {
                                  $p = $school->programme;
                                  $programme = Db::getInstance()->get('programmes', array('id', '=', $p));
                                  if ($programme->count()) {
                                    echo escape($programme->results()[0]->category);
                                  }
                                }
                                ?></td>
                            <td><?php

                                $locationId = $user->location;
                                $locations = Db::getInstance()->query("SELECT * FROM `locations` WHERE `id`=$locationId");
                                foreach ($locations->results() as $location) {
                                  print $location->name;
                                }
                                ?></td>
                            <td><?php echo $user->joined; ?></td>
                            <td>
                              <div id="btn_c" style="float:left;">
                                <button id="<?php echo $user->id; ?>" class="edit_user btn btn-default border rst<?php echo $user->id; ?>" lang="<?php echo $user->username; ?>"><span class="fa fa-edit"></span></button>
                              </div>
                              <div id="btn_c" style="float:left">
                                <button class="delete_user_or_student btn btn-default border" title="<?php echo $user->username; ?>" lang="<?php echo $user->syscategory; ?>"><span class="fa fa-trash"></span></button>
                              </div>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>

                      </tbody>
                    </table>
                  <?php
                  }
                } else if ($userSyscategory == 2) {

                  $user = Db::getInstance()->query("SELECT * FROM users WHERE username LIKE 'S%' AND added_by = '$username'");

                  if (!$user->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                  ?>
                    <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Username</th>
                          <th>School</th>
                          <th>Programme</th>
                          <th>Created</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($user->results() as $user) {

                        ?>

                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user->username; ?></td>
                        <td><?php
                          $schoolId = $user->school;
                                $schools = Db::getInstance()->query("SELECT * FROM `certificates` WHERE `id`=$schoolId");
                                foreach ($schools->results() as $school) {
                                  $p = $school->programme;
                                  $programme = Db::getInstance()->get('programmes', array('id', '=', $p));
                                  if ($programme->count()) {
                                    echo escape($programme->results()[0]->category);
                                  }
                                }
                                ?></td>
                            <td><?php

                               
                                $schools = Db::getInstance()->query("SELECT * FROM `certificates` WHERE `id`=$schoolId");
                                foreach ($schools->results() as $school) {
                                  print $school->title;
                                }
                                ?></td>
                            
                            <td><?php echo $user->joined; ?></td>
                            <td>
                              <div id="btn_c" style="float:left;">
                                <button id="<?php echo $user->id; ?>" class="edit_user btn btn-default border rst<?php echo $user->id; ?>" lang="<?php echo $user->username; ?>"><span class="fa fa-edit"></span></button>
                              </div>
                              <div id="btn_c" style="float:left">
                                <button class="delete_user_or_student btn btn-default border" title="<?php echo $user->username; ?>" lang="<?php echo $user->syscategory; ?>"><span class="fa fa-trash"></span></button>
                              </div>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>

                      </tbody>
                    </table>
                <?php
                  }
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