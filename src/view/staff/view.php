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
                    <h3>Staff View</h3>
                    <?php

                    $staffa = Db::getInstance()->query("SELECT * FROM `staff_record` WHERE `member_id`='$member_id'");

                    if ($staffa->count()) {
                        foreach ($staffa->results() as $staff) {
                            
                    ?>
                            <div class="row border-bottom">
                                <div class="container my-4">
                                    <div class="card mb-3" style="max-width: 100%;">
                                        <div class="row no-gutters">
                                            <div class="col-md-3 col-sm-3">
                                                <?php if(isset($staff->image)){echo '<img src="view/students/upload/ '. $staff->image .'" class="card-img" alt="" style="width: 12rem;">'; }else{ echo "";} ?>
                                                <h6><?php echo '<span class="card-title py-0 my-0">' . $staff->member_id . '</span>'; ?></h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="card-body">
                                            <?php

                                            if ($staff->firstname != "" || $staff->lastname != "" || $staff->designation != "" || $staff->email != "" || $staff->location != "") {
                                                echo '<h5 class="card-title py-0 my-0">' . $staff->firstname . ' ' . $staff->lastname . '</h5><p class="card-text py-0 my-0">' . $staff->member_id . '</p><p class="card-text py-0 my-0">' . $staff->designation . '</p><p class="card-text pt-2 my-0">' . $staff->email . '</p><p class="card-text py-0 my-0">' . $staff->location . '</p>';
                                            } else {
                                                echo '<span class="card-title py-0 my-0">' . $staff->member_id . '</span>';
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