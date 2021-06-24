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
          <h3>Student</h3>
          <div class="row">
            <div class="container">
              <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                <h6 class="card-title p-2">All Students Records</h6>

              </div>
              <div class="table-responsive data-font">
                <?php

                $username = escape($user->data()->id);
                $userSyscategory = escape($user->data()->syscategory);
                $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

                if ($userSyscategory != 2) {

                  $studenta = Db::getInstance()->query("SELECT * FROM students_record");

                  if (!$studenta->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                ?>
                    <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th width="20">SN</th>
                          <th width="150">Student ID</th>
                          <th width="150">Matric No.</th>
                          <th width="180">Full name</th>
                          <th width="180">Mobile</th>
                          <th width="100">Programme</th>
                          <th width="160">Location</th>
                          <th width="140">Created</th>
                          <th width="30">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($studenta->results() as $student) {

                        ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $student->member_id; ?></td>
                            <td><?php echo $student->matric_no; ?></td>
                            <td><?php echo $student->firstname . " " . $student->lastname ?></td>
                            <td><?php echo $student->phone ?></td>
                            <td><?php echo $student->programme ?></td>
                            <td><?php echo $student->location ?></td>
                            <td><?php echo $student->created ?></td>
                            <td>
                              <div class="staff_student_view" id="<?php echo $student->member_id; ?>" lang="view/students">

                                <button type="button" class=" fa fa-search btn btn-default border"></button>

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

                  $studenta = Db::getInstance()->query("SELECT * FROM students_record WHERE member_id LIKE 'S%' AND added_by = '$username'");

                  if (!$studenta->count()) {
                    echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                  } else {

                  ?>
                    <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th width="20">SN</th>
                          <th width="150">Student ID</th>
                          <th width="150">Matric No.</th>
                          <th width="180">Full name</th>
                          <th width="180">Mobile</th>
                          <th width="100">Programme</th>
                          <th width="160">Location</th>
                          <th width="140">Created</th>
                          <th width="30">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i = 1;
                        foreach ($studenta->results() as $student) {

                        ?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $student->member_id; ?></td>
                            <td><?php echo $student->matric_no; ?></td>
                            <td><?php echo $student->firstname . " " . $student->lastname ?></td>
                            <td><?php echo $student->phone ?></td>
                            <td><?php echo $student->programme ?></td>
                            <td><?php echo $student->location ?></td>
                            <td><?php echo $student->created ?></td>
                            <td>
                              <div class="staff_student_view" id="<?php echo $student->member_id; ?>" lang="view/students">

                                <button type="button" class=" fa fa-search btn btn-default border"></button>

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
  </div>
<?php

} else {
  $user->logout();
  Redirect::to('../../login/');
}

?>