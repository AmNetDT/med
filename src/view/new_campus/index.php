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
          <h3>Manage Campus</h3>

          <div class="row">
            <div class="container">
              <div id="btn_c" style="text-align: right;">
                <button class="reg_campus border my-2 " type="submit"><span class="fa fa-plus"> Create New Campus</span></button>

              </div>
              <div class="table-responsive data-font">
                <?php

                $locations = Db::getInstance()->query("SELECT * FROM locations");

                if (!$locations->count()) {
                  echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                } else {

                ?>
                  <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th width="50">SN</th>
                        <th width="200">Campus Name</th>
                        <th width="250">Location Address</th>
                        <th width="100">Telephone</th>
                        <th width="150">Email</th>
                        <th width="100">Created By</th>
                        <th width="100">Created</th>
                        <th width="50">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      foreach ($locations->results() as $location) {

                      ?>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $location->name; ?></td>
                          <td><?php echo $location->address; ?></td>
                          <td><?php echo $location->phone; ?></td>
                          <td><?php echo $location->email; ?></td>
                          <td><?php

                              $u = $location->added_by;
                              $username = Db::getInstance()->get('users', array('id', '=', $u));
                              if ($username->count()) {
                                echo escape($username->results()[0]->username);
                              }
                              ?></td>
                          <td><?php echo $location->created; ?></td>
                          <td>
                            <div id="" style="float:left;">
                              <button type="submit" id="<?php echo $location->id; ?>" class="edit_campus btn border rst<?php echo $location->id; ?>" lang="<?php echo $location->name; ?>"><span class="fa fa-edit"></span></button>
                            </div>
                          </td>
                        </tr>

                    <?php
                      }
                    }
                    ?>
                    </tbody>
                  </table>
              </div>


            </div>

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