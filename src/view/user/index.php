<?php

require_once '../../core/init.php';

$user = new User();
if ($user->isLoggedIn()) {

?>

  <div id="body_general">

    <div id="accounttile">
      <div class="col-sm-12 col-sm-6">
        <span id="close" class="fa fa-close p-1 btn-danger text-lg"></span>
      </div>
    </div>

    <div class="container">
      <div class="jumbotron jumbotron-fluid pt-3">
        <div id="accounttile" class="container">
          <h3>Profile Settings</h3>
          <div class="row">
            <div class="container my-4">
              <div class="card mb-3" style="max-width: 100%;">
                <div class="row no-gutters">
                  <div class="col-md-3 col-sm-3">
                    <img src="assets/images/1.jpeg" class="card-img" alt="" style="width: 12rem;">
                  </div>
                  <div class="col-sm-9">
                    <div class="card-body">
                      <?php

                      $username = escape($user->data()->username);
                      $userSyscategory = escape($user->data()->syscategory);
                      $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

                        if ($userSyscategory != 5) {
                      
                        $staff = Db::getInstance()->query("SELECT * FROM `staff_record` WHERE `member_id`='$username'");

                        foreach ($staff->results() as $staff) {
                          if (!empty($staff->firstname)) {
                            echo '<span class="card-title py-0 my-0">' . $staff->firstname . ' ' . $staff->lastname . '</span>';
                          } else {
                            echo '<span class="card-title py-0 my-0">' . $staff->member_id . '</span>';
                          }
                        }
                      } else {

                        $studentdb = Db::getInstance()->query("SELECT * FROM `students_record` WHERE `member_id`='$username'");
                        foreach ($studentdb->results() as $stud) {
                          if (!empty($stud->firstname)) {
                            echo '<span class="card-title py-0 my-0">' . $stud->firstname . ' ' . $stud->lastname . '</span>';
                          } else {
                            echo '<span class="card-title py-0 my-0">' . $stud->member_id . '</span>';
                          }
                        }
                      }

                      ?>




                      <p class="card-text py-0 my-0"><em><a href="#">Edit</a>/</em></p>
                      <hr />

                      <p class="card-text"><a href="#">Change Password</a></p>

                    </div>
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