<?php

require_once '../../core/init.php';

$member_id = $_POST['member_id'];
//echo $member_id;
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
            <div class="jumbotron jumbotron-fluid pt-3 bg-white">
                <div id="accounttile" class="container">
                    <h3>Student View</h3>
                    <?php

                    $staffa = Db::getInstance()->query("SELECT * FROM `students_record` WHERE `member_id`='$member_id'");

                    if ($staffa->count()) {
                        foreach ($staffa->results() as $staff) {
                        
                    ?>
                            <div class="row border-bottom">
                                <div class="container my-4">
                                    <div class="card mb-3" style="max-width: 100%;">
                                        <div class="row no-gutters">
                                            <div class="col-md-3 col-sm-3">
                                                <?php if (isset($staff->image)) {
                                                    echo '<img src="view/students/upload/ ' . $staff->image . '" class="card-img" alt="" style="width: 12rem;">';
                                                } else {
                                                    echo "";
                                                } ?>
                                                <h6><span class="card-title py-0 my-0"><?php
                        $u = $staff->member_id;
                        $username = Db::getInstance()->get('users', array('id', '=', $u));
                        if ($username->count()) {
                            echo escape($username->results()[0]->username);
                        }
                                                ?></span></h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="card-body">
                                                    <?php

                                                    if ($staff->firstname != "" || $staff->lastname != "" || $staff->programme != "" || $staff->email != "" || $staff->location != "") {
                                                        echo '<h5 class="card-title py-0 my-0">' . $staff->firstname . ' ' . $staff->lastname . '</h5><p class="card-text py-0 my-0">' . $staff->member_id . '</p><p class="card-text py-0 my-0">' . $staff->programme . '</p><p class="card-text pt-2 my-0">' . $staff->email . '</p><p class="card-text py-0 my-0">' . $staff->location . '</p>';
                                                    } 


                                                    ?>




                                                </div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col-md-3 col-sm-3">

                                                <!-- Empty !-->

                                            </div>
                                            <div class="col-sm-9">
                                                <div class="card-body">
                                                    <?php
                                                    $userSyscategory = escape($user->data()->syscategory);
                                                    $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

                                                    if ($userSyscategory == 2) {
                                                    ?>

                                                        <div id="<?php echo $staff->member_id; ?>" class="add_payment">
                                                            <button class="border">
                                                                <span class="fa fa-plus"> Add Payment</span>
                                                            </button>
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
                        }
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