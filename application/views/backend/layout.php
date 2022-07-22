<?php  defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php if ($this->uri->segment(2) == "reportsPrelim"){ ?>
        <title>Prelim Reports</title>
    <?php }elseif ($this->uri->segment(2) == "reportsMidterm"){ ?>
        <title>Midterm Reports</title>
    <?php }elseif ($this->uri->segment(2) == "reportsPrefinal"){ ?>
        <title>Prefinal Reports</title>
    <?php }elseif ($this->uri->segment(2) == "reportsFinals"){ ?>
        <title>Finals Reports</title>
    <?php }elseif ($this->uri->segment(2) == "reportsFinalGrade"){ ?>
        <title>Final Grade Reports</title>
    <?php }elseif ($this->uri->segment(2) == "reportsListOfStudentPerSub"){ ?>
        <title>Subject Student List Reports</title>
    <?php }else{?>
        <title>DASHBOARD</title>
    <?php }?>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo base_url();?>assets/images/Dashboard-icon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="<?php echo base_url();?>assets/css/googleapis.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/googleapisicon.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Font-awesome CSS-->
    <link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Select Css -->
    <link href="<?php echo base_url();?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <!-- Waves Effect Css -->
    <link href="<?php echo base_url();?>assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="<?php echo base_url();?>assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- JQuery DataTable Css -->
    <link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Custom Css -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/reports.css" rel="stylesheet">
    <!-- Theme Color -->
    <link href="<?php echo base_url();?>assets/css/blue-theme.css" rel="stylesheet" />
</head>

<body class="theme-red">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand text-uppercase" href="<?php echo site_url();?>dashboard/index"><?php echo $this->session->userdata('authorization');?> DASHBOARD</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php if ($this->session->userdata('authorization') == 'admin'){ ?>
                    <a class="navbar-brand" style="margin-top: 10px;font-size: 17px" href="<?php echo site_url();?>" target="_blank">View Site</a>
                <?php }?>

                <!-- Notifications -->
<!--                <li class="dropdown">-->
<!--                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">-->
<!--                        <i class="material-icons">notifications</i>-->
<!--                        <span class="label-count">1</span>-->
<!--                    </a>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li class="header">NOTIFICATIONS</li>-->
<!--                        <li class="body">-->
<!--                            <ul class="menu">-->
<!--                                <li>-->
<!--                                    <a href="javascript:void(0);">-->
<!--                                        <div class="icon-circle bg-light-green">-->
<!--                                            <i class="material-icons">person_add</i>-->
<!--                                        </div>-->
<!--                                        <div class="menu-info">-->
<!--                                            <h4>12 new members joined</h4>-->
<!--                                            <p>-->
<!--                                                <i class="material-icons">access_time</i> 14 mins ago-->
<!--                                            </p>-->
<!--                                        </div>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                        <li class="footer">-->
<!--                            <a href="javascript:void(0);">View All Notifications</a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
                <!-- #END# Notifications -->
            </ul>
        </div>
    </div>
</nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <?php foreach ($user_prof as $user){ ?>
        <div class="user-info" >
            <?php if ($user->avatar == ''){ ?>
            <div class="image">
                <img src="<?php echo base_url()?>uploads/users/fbpic.jpg" width="48" height="48" alt="User Avatar" />
            </div>
            <?php }else{?>
            <div class="image">
                <img src="<?php echo base_url()?>uploads/users/<?php echo $user->avatar;?>" width="48" height="48" alt="User Avatar" />
            </div>
            <?php }?>
            <div class="info-container">

                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user->complete_name;?></div>
                <div class="email"><?php echo $user->email;?></div>
                <?php } ?>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo site_url();?>dashboard/user_profile"><i class="material-icons">person</i>Profile</a></li>
                        <li role="seperator" class="divider"></li>
                        <li><a href="<?php echo site_url()?>authentication/logout"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <nav>
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <?php if ($this->session->userdata('authorization') == 'admin'){ ?>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">menu</i>
                        <span>Content Management</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="btn">
                            <a href="<?php echo site_url();?>dashboard/addMenuPage">Add Menu</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>dashboard/addPageContent">Add Page Content</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>dashboard/menuList">List</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">person_add</i>
                        <span>User Management</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="btn" class="active">
                            <a href="<?php echo site_url();?>dashboard/new_user">Add Registrar</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>dashboard/manageUser">Manage User</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">settings</i>
                        <span>Manage Website</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="btn" class="active">
                            <a href="<?php echo site_url();?>dashboard/manageSettings">Website Settings</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>dashboard/footerSettings">Manage Footer</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>dashboard/manageContact">Contact Details</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo site_url()?>dashboard/contactUs">
                        <i class="material-icons">contacts</i>
                        <span>Contact Us</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url()?>dashboard/actLogsPage">
                        <i class="material-icons">access_time</i>
                        <span>Activity Logs</span>
                    </a>
                </li>
                <?php }elseif ($this->session->userdata('authorization') == 'registrar' || $this->session->userdata('authorization') == 'staff'){ ?>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">settings</i>
                        <span>Manage Subjects</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="<?php echo site_url()?>dashboard/addSY">School Year</a>
                        </li>
<!--                        <li>-->
<!--                            <a href="--><?php //echo site_url()?><!--dashboard/insertSubjectInSY">Insert Subject</a>-->
<!--                        </li>-->
                        <li class="active">
                            <a href="<?php echo site_url()?>dashboard/addSubject">Create Subject</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url()?>dashboard/subjectSettings">Subject Setting</a>
                        </li>
                    </ul>
                </li>
                <?php if ($this->session->userdata('authorization') == 'registrar'){ ?>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">person_add</i>
                        <span>User Management</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="btn" class="active">
                            <a href="<?php echo site_url();?>dashboard/addStaff">Add Staff</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>dashboard/addInstructor">Add Instructor</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>dashboard/addStudentsPage">Add Student</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>dashboard/instructorManagement">Manage Instructors</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url();?>dashboard/studentManagement">Manage Students</a>
                        </li>
                    </ul>
                </li>
<!--                <li>-->
<!--                    <a href="--><?php //echo site_url();?><!--dashboard/reports">-->
<!--                        <i class="material-icons">event_note</i>-->
<!--                        <span>Reports</span>-->
<!--                    </a>-->
<!--                </li>-->
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">event_note</i>
                            <span>Reports</span>
                        </a>
                        <ul class="ml-menu">
                            <li id="btn" class="active">
                                <a href="<?php echo site_url();?>dashboard/reports">Student Grades</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url();?>dashboard/listOfStudentPerSubject">List of Students</a>
                            </li>
<!--                            <li>-->
<!--                                <a href="--><?php //echo site_url();?><!--dashboard/addStudentsPage">Instructor's Subjects</a>-->
<!--                            </li>-->
                        </ul>
                    </li>
                <?php }?>
                <?php } ?>

            </ul>
        </div>
        </nav>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2017 - 2018 <a href="javascript:void(0);">CATC E-learning</a>
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>
<!--Content Area-->
<section class="content">
    <div class="container-fluid" id="content">
        <?php $this->load->view($content); ?>
    </div>
</section>

<!-- Jquery Core Js -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.js"></script>
<!--General JS-->
<script src="<?php echo base_url();?>assets/js/general.js"></script>
<!-- Select Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/node-waves/waves.js"></script>
<!-- Ckeditor -->
<script src="<?php echo base_url();?>assets/plugins/ckeditor/ckeditor.js"></script>

<!-- Bootstrap Notify Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->
<script src="<?php echo base_url();?>assets/js/admin.js"></script>
<script src="<?php echo base_url();?>assets/js/notifications.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/tables/jquery-datatable.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/forms/editors.js"></script
<script src="<?php echo base_url();?>assets/js/pages/forms/basic-form-elements.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/forms/form-validation.js"></script>

<!-- Demo Js -->
<script src="<?php echo base_url();?>assets/js/demo.js"></script>
</body>

</html>