<?php

require_once '../core/init.php';

$user = new User();

if (!$user->isLoggedIn()) {

    Redirect::to('../login/index');
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>RILA</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="assets/images/png" sizes="16x16" href="assets/images/favicon.png">
        <!-- Bootstrap Core CSS -->
        <link href="assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
        <!-- This page CSS -->
        <!-- chartist CSS -->
        <link href="assets/node_modules/morrisjs/morris.css" rel="stylesheet">
        <!--c3 CSS -->
        <link href="assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/rila.css" rel="stylesheet">
        <!-- Dashboard 1 Page CSS -->
        <link href="css/pages/dashboard1.css" rel="stylesheet">
        <!-- You can change the theme colors from here -->
        <link href="css/colors/default.css" id="theme" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

        <link rel="stylesheet" type="text/css" href="assets/ext/consolehome.css" />
        <link rel="stylesheet" type="text/css" href="assets/ext/forms.css" />
        <link rel="stylesheet" type="text/css" href="assets/ext/console.css" />
        <link rel="stylesheet" type="text/css" href="assets/ext/menu.css" />
        <link rel="stylesheet" type="text/css" href="assets/ext/tree.css" />
        <link rel="stylesheet" type="text/css" href="assets/ext/jquerycss.css" />

        <script src="assets/ext/jquery.js"></script>
        <script src="assets/ext/jquery-1.10.2.min.js"></script>
        <script src="assets/ext/jquery-u.js"></script>
        <script src="assets/ext/tree.js"></script>
        <script src="assets/ext/pageloader.js"></script>
        <script src="assets/ext/jquery-uis.1.10.2.min.js"></script>
        <script src="jlib/pop.js"></script>
        <script src="jlib/normarizr.js"></script>
        <link rel='stylesheet' type="text/css" href="jlib/pop.css" />
        <script src="assets/ext/alertdialog.js"></script>

        <style>
            .menutree {
                margin-left: -22px;
                width: 190px;
                padding-left: 5px;
                border: dotted 1px #fff;
                margin-top: 5px;
                text-decoration: none;
            }

            .menutree:hover {
                position: relative;
                border: dotted 1px #fff;
                text-decoration: none;
            }

            .sub-menutree {
                margin-left: 10px;
                width: 190px;
                padding: 2px 5px;
                margin-top: 5px;
                border: dotted 1px #fff;
                text-decoration: none;
            }

            .foot {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                text-align: center;
            }
        </style>
    </head>

    <body class="fix-header fix-sidebar card-no-border">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Redeemer's International Leadership Academy - RILA</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <header class="topbar shadow" style="top:0px;">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">

                    <div class="navbar-header">
                        <a class="navbar-brand" href="console">
                            <img src="assets/images/logo.png" alt="homepage" class="dark-logo" />
                            </b>
                            <span class="font-weight-light">R&nbsp;I&nbsp;L&nbsp;A</span>
                        </a>
                    </div>
                    <div class="navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)">
                                    <i class="fa fa-bars"></i></a>
                            </li>
                        </ul>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav mr-5">
                            <!-- ============================================================== -->
                            <!-- Profile -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown u-pro mr-5">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="assets/images/1.jpeg" alt="user" class="img-fluid" />
                                    <span class="hidden-md-down">
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

                                    </span>
                                </a>
                                <div class="dropdown-menu mr-5">

                                    <div class="_mc">
                                        <a class="dropdown-item" href="javascript:void(0)" id="view/user">Profile Settings</a>

                                    </div>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../login/logout.php">Logout</a>
                                </div>
                            </li>
                        </ul>

                    </div>

                </nav>
            </header>
        </div>
        <section>

            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <?php
                        $userSyscategory = escape($user->data()->syscategory);
                        $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");

                        if ($userSyscategory == 1) {


                        ?>
                            <p class="px-4 py-3 text-light shadow bg-danger">Administrator</p>
                            <div class="tree">
                                <ul id="sidebarnav">
                                    <li><a>User Management</a>
                                        <ul>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">All Campus</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/new_campus" aria-expanded="false">
                                                            <span class="hide-menu">Campus</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Manage Users</span>
                                                </a>
                                                <ul style="margin-left:-15px;">

                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/users/" aria-expanded="false">
                                                            <span class="hide-menu"> Users</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Staff</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/staff" aria-expanded="false">
                                                            <span class="hide-menu"> Staff info</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    Students
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/students" aria-expanded="false">
                                                            <span class="hide-menu"> Student Details</span>
                                                        </a>
                                                    </li>
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/payments" aria-expanded="false">
                                                            <span class="hide-menu"> Tuition Fees</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/payments" aria-expanded="false">
                                                            <span class="hide-menu"> Other Payments</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    Schools
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/schools" aria-expanded="false">
                                                            <span class="hide-menu"> Programmes</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/course" aria-expanded="false">
                                                            <span class="hide-menu"> Courses</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    Events
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="Settings" aria-expanded="false">
                                                            <span class="hide-menu"> Inbox</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="Settings" aria-expanded="false">
                                                            <span class="hide-menu"> Time Table</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="_mc">
                                                <a class="waves-effect waves-dark menutree" href="javascript:void(0)" id="view/library" aria-expanded="false">
                                                    <span class="hide-menu"> Library</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <?php
                        } else if ($userSyscategory == 2) {


                        ?>
                            <p class="px-4 py-3 text-light shadow bg-danger">Coordinator</p>
                            <div class="tree">
                                <ul id="sidebarnav">

                                    <li><a>User Management</a>
                                        <ul>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    <span class="hide-menu">Users Account</span>
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <!--li class="_mc">
                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/users/register" aria-expanded="false">
                                            <span class="hide-menu"> Add New User</span>
                                        </a>
                                    </li!-->
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/users/" aria-expanded="false">
                                                            <span class="hide-menu"> Users</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    Students
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/students" aria-expanded="false">
                                                            <span class="hide-menu"> Student Details</span>
                                                        </a>
                                                    </li>
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/payments" aria-expanded="false">
                                                            <span class="hide-menu"> Tuition Fees</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/payments" aria-expanded="false">
                                                            <span class="hide-menu"> Other Payments</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    Schools
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/schools" aria-expanded="false">
                                                            <span class="hide-menu"> Programmes</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/course" aria-expanded="false">
                                                            <span class="hide-menu"> Courses</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    Events
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="Settings" aria-expanded="false">
                                                            <span class="hide-menu"> Inbox</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="Settings" aria-expanded="false">
                                                            <span class="hide-menu"> Time Table</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="_mc">
                                                <a class="waves-effect waves-dark menutree" href="javascript:void(0)" id="view/library" aria-expanded="false">
                                                    <span class="hide-menu"> Library</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <?php
                        } else if ($userSyscategory == 3) {


                        ?>
                            <p class="px-4 py-3 text-light shadow bg-danger">Finance</p>
                            <div class="tree">
                                <ul id="sidebarnav">
                                    <li><a>User Management</a>
                                        <ul>
                                            <li>
                                                <a class="waves-effect waves-dark menutree pl-4">
                                                    Students
                                                </a>
                                                <ul style="margin-left:-15px;">
                                                    <li class="_payment">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/payments" aria-expanded="false">
                                                            <span class="hide-menu"> Tuition Fees</span>
                                                        </a>
                                                    </li>
                                                    <li class="_mc">
                                                        <a class="waves-effect waves-dark sub-menutree" href="javascript:void(0)" id="view/payments" aria-expanded="false">
                                                            <span class="hide-menu"> Other Payments</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <?php
                        } else if ($userSyscategory == 4) {


                        ?>
                            <p class="px-4 py-3 text-light shadow bg-danger">Library</p>
                            <div class="tree">
                                <ul id="sidebarnav">
                                    <li><a>User Management</a>
                                        <ul>
                                            <li class="_mc">
                                                <a class="waves-effect waves-dark menutree" href="javascript:void(0)" id="view/library" aria-expanded="false">
                                                    <span class="hide-menu"> Library</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <?php
                        } else if ($userSyscategory == 5) {



                        ?>
                            <p class="px-4 py-3 text-light shadow bg-dark">Students</p>
                            <div class="tree">
                                <ul id="sidebarnav">

                                    <li><a>User Management</a>
                                        <ul>
                                            <li class="_mc">
                                                <a class="waves-effect waves-dark menutree pl-4" href="javascript:void(0)" id="view/students" aria-expanded="false">
                                                    Payments
                                                </a>
                                            </li>
                                            <li class="_mc">
                                                <a class="waves-effect waves-dark menutree pl-4" href="javascript:void(0)" id="view/students" aria-expanded="false">
                                                    Academy
                                                </a>
                                            </li>
                                            <li class="_mc">
                                                <a class="waves-effect waves-dark menutree pl-4" href="javascript:void(0)" id="view/students" aria-expanded="false">
                                                    Inbox
                                                </a>
                                            </li>
                                            <li class="_mc">
                                                <a class="waves-effect waves-dark menutree pl-4" href="javascript:void(0)" id="view/students" aria-expanded="false">
                                                    Time Table
                                                </a>
                                            </li>
                                            <li class="_mc">
                                                <a class="waves-effect waves-dark menutree pl-4" href="javascript:void(0)" id="view/library" aria-expanded="false">
                                                    <span class="hide-menu"> Library</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        <?php
                        }
                        ?>
                    </nav>

                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>


            <div id="contentbar" class="page-wrapper my-0 pb-0">
                <div id="contentbar_inner" class="container-fluid">

                    <!-- inner window !-->


                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-primary">Dashboard</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <div class="col-md-7 align-self-center">
                            <a href="#" class="btn waves-effect waves-light btn btn-info pull-right hidden-sm-down">
                                <i class='fa fa-question-circle'></i> FAQ</a>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-4 col-lg-3 col-md-5">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="m-t-5">
                                        <p class="fa fa-users font-icon"></p>
                                        <p class="card-title m-t-10">Number of Admin Users</p>
                                        <p class="card-subtitle"></p>
                                        <div class="row text-center justify-content-md-center">
                                            <div class="col-4"><a href="javascript:void(0)" class="link">
                                                    <i class="fa fa-users"></i>
                                                    <span class="font-medium">23</span>
                                                </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-lg-3 col-md-5">
                            <div class="card">

                                <div class="card-body text-center">
                                    <div class="m-t-5">
                                        <p class="fa fa-institution font-icon"></p>
                                        <p class="card-title m-t-10">Schools</p>
                                        <p class="card-subtitle"></p>
                                        <div class="row text-center justify-content-md-center">
                                            <div class="col-4"><a href="javascript:void(0)" class="link">
                                                    <i class="fa fa-institution"></i>
                                                    <span class="font-medium">3</span>
                                                </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-lg-3 col-md-5">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="m-t-5">
                                        <p class="fa fa-mortar-board font-icon"></p>
                                        <p class="card-title m-t-10">Number of Student</p>
                                        <p class="card-subtitle"></p>
                                        <div class="row text-center justify-content-md-center">
                                            <div class="col-4"><a href="javascript:void(0)" class="link">
                                                    <i class="fa fa-tasks"></i>
                                                    <font class="font-medium">254</font>
                                                </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-4 col-lg-3 col-md-5">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="m-t-5">
                                        <p class="fa fa-calendar font-icon"></p>
                                        <p class="card-title m-t-10">Number of Post</p>
                                        <p class="card-subtitle"></p>
                                        <div class="row text-center justify-content-md-center">
                                            <div class="col-4"><a href="javascript:void(0)" class="link">
                                                    <i class="fa fa-send"></i>
                                                    <span class="font-medium">254</span>
                                                </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-lg-3 col-md-5">
                            <div class="card">

                                <div class="card-body text-center">
                                    <div class="m-t-5">
                                        <p class="fa fa-credit-card font-icon"></p>
                                        <p class="card-title m-t-10">Payment Records</p>
                                        <p class="card-subtitle"></p>
                                        <div class="row text-center justify-content-md-center">
                                            <div class="col-4"><a href="javascript:void(0)" class="link">
                                                    <i class="fa fa-credit-card"></i>
                                                    <span class="font-medium">254</span>
                                                </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-lg-3 col-md-5">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="m-t-5">
                                        <p class="fa fa-book font-icon"></p>
                                        <p class="card-title m-t-10">Library Inventory</p>
                                        <p class="card-subtitle"></p>
                                        <div class="row text-center justify-content-md-center">
                                            <div class="col-4"><a href="javascript:void(0)" class="link">
                                                    <i class="fa fa-book"></i>
                                                    <span class="font-medium">254</span>
                                                </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end of inner window !-->
                </div>

            </div>
            </div>
        </Section>
        <footer id="contentbar_footers" class="footer foot fixed-bottom ">
            <div id="loader_httpFeed"><img src="loading.gif" /></div>
            &copy; Redeemer's International Leadership Academy - RILA
            <script>
                document.write(new Date().getFullYear());
            </script>
        </footer>



        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="assets/node_modules/jquery/jquery.min.js"></script>
        <!-- Bootstrap popper Core JavaScript -->
        <script src="assets/node_modules/bootstrap/js/popper.min.js"></script>
        <script src="assets/node_modules/bootstrap/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="js/perfect-scrollbar.jquery.min.js"></script>
        <!--Wave Effects -->
        <script src="js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="js/custom.min.js"></script>
        <!-- ============================================================== -->
        <!-- This page plugins -->
        <!-- ============================================================== -->
        <!--morris JavaScript -->
        <script src="assets/node_modules/raphael/raphael-min.js"></script>
        <script src="assets/node_modules/morrisjs/morris.min.js"></script>
        <!--c3 JavaScript -->
        <script src="assets/node_modules/d3/d3.min.js"></script>
        <script src="assets/node_modules/c3-master/c3.min.js"></script>
        <!-- Chart JS -->
        <script src="js/dashboard1.js"></script>
    </body>

    </html>
<?php
}
?>