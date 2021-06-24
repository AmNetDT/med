<?php

require_once '../../core/init.php';

$library = new User();
if ($library->isLoggedIn()) {

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
          <h3>Manage Library</h3>
          <div class="row">
            <div class="container">
              <div id="btn_c" style="float:left">
                <button class="sys_regts border my-2 " type="submit"><span class="icon-plus"> Add Item</span></button>
              </div>
              <div class="table-responsive">
                <?php

                $library = Db::getInstance()->query("SELECT * FROM library");

                if (!$library->count()) {
                  echo "<h4 class='my-5 text-center'>No data to be displayed</h4>";
                } else {

                ?>
                  <table id="abdganiu" class="table table-hover table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>SN</th>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Added By</th>
                        <th>Entry Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      foreach ($library->results() as $library) {

                      ?>

                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $library->ISBN; ?></td>
                          <td><?php echo $library->title; ?></td>
                          <td><?php echo $library->author; ?></td>
                          <td><?php echo $library->category; ?></td>
                          <td><?php echo $library->quantity; ?></td>
                          <td><?php

                              $u = $library->added_by;
                              $username = Db::getInstance()->get('users', array('id', '=', $u));
                              if ($username->count()) {
                                echo escape($username->results()[0]->username);
                              }
                              ?></td>
                          <td><?php echo $library->created; ?></td>
                          <td>
                            <div id="btn_c">
                              <button class="btn btn_regis_01 border"><span class="fa fa-edit"></span></button>
                            </div>
                            <div id="btn_c">
                              <button class="btn btn_regis_01 border"><span class="fa fa-trash"></span></button>
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
  $library->logout();
  Redirect::to('../../login/');
}


?>