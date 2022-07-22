<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
if ($check_webdata == $webdata){
    $webicon = '';
    $webtitle = '';
    $brand_name = '';
    $logo = '';
    $banner = '';

}else{
    foreach ($webdata as $row):
        $webicon = $row->web_icon;
        $webtitle = $row->web_title;
        $brand_name = $row->brand_name;
        $logo = $row->logo;
        $banner = $row->banner;
    endforeach;
}

foreach ($user_data as $users){
    $pass = $users->default_pass;
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php echo $webtitle;?></title>
    <?php if ($webicon==''){ ?>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/icon.png">
    <?php }else{ ?>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/icon/<?php echo $webicon; ?>">
    <?php } ?>
    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- JQuery DataTable Css -->
    <link href="<?php echo base_url()?>assets/frontend/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.css">
<!--    DateTime Picker CSS-->
    <!--Custome CSS-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/frontend/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/frontend/css/mainpage.css">
</head>
<body>
<!--Header-->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="border: none; background-color: #3b5998 " >
    <div class="container-fluid">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a style=" padding: 0px;height: 100%; width: auto; color: white" class="navbar-brand" href="<?php echo site_url();?>home">
                <?php if ($logo == ''){ ?>
                    <img style="display: inline-block; padding:3px;margin-left: 50px;!important;" src="<?php echo base_url();?>assets/images/images.jpg" width="50" height="50" alt="LOGO">
                <?php }else{ ?>
                    <img style="display: inline-block; padding:3px;margin-left: 50px;!important;" src="<?php echo base_url();?>uploads/logo/<?php echo $logo;?>" width="50" height="50" alt="LOGO">
                <?php } ?>
                <?php if ($brand_name ==''){ ?>
                    <span style="color: white">Brand Name</span>
                <?php }else{ ?>
                    <span style="color: white"><?php echo $brand_name;?></span>
                <?php } ?>
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li id="links" class="bell">
                    <a style="color: white" class="page-scroll" href="<?php echo site_url()?>home" ><i class="fa fa-home fa-lg" aria-hidden="true"></i></a>
                    <span class="notify">Home</span>
                </li>
                <li id="links" class="bell">
                    <a id="user-option" style="color: white" class="page-scroll btn-notify" class="dropdown-toggle" data-toggle="dropdown" href="" ><i class="fa fa-bell fa-lg" aria-hidden="true"></i><span class="notify-badge" style="z-index: 1000;position: absolute;margin-left: -5px"><?php if ($notify_count == null){ }else{ ?><span class="label label-danger"><?php echo $notify_count; ?></span><?php } ?></span></a>
                    <ul class="dropdown-menu" style="border-radius: 0;overflow-y: scroll;max-height: 350px">
<!--                        --><?php //if ($notify_count== null){ ?>
<!--                            <li class="notification-container" style="text-align: center">-->
<!--                                <span style="color: black;font-weight: bold;font-size: 16px">No Notification</span>-->
<!--                            </li>-->
<!--                 -->
<!--                        --><?php //}else{ ?>
                        <?php foreach ($notification as $notify){ ?>
                            <a href="<?php echo site_url();?><?php echo $notify->uri;?>" class="unread_read" id="<?php echo $notify->id;?>">
                                <li class="notification-container" <?php if ($notify->read_unread == 1){?>style="background: #e9edf5;" <?php }?> >
                                    <div class="col-md-3">
                                        <?php if ($notify->page == 'class_wall' || $notify->page == 'video_tutorial' || $notify->page == 'library'){ ?>
                                            <img style="border-radius: 50%;float: right" src="<?php echo base_url();?>uploads/classphoto/<?php echo $notify->image;?>" alt="image" width="60" height="60">
                                        <?php }else{?>
                                            <?php if ($notify->image == null){ ?>
                                                <img style="border-radius: 50%;float: right" src="<?php echo base_url();?>uploads/users/fbpic.jpg" alt="image" width="60" height="60">
                                            <?php }else{ ?>
                                                <img style="border-radius: 50%;float: right" src="<?php echo base_url();?>uploads/users/<?php echo $notify->image;?>" alt="image" width="60" height="60">
                                            <?php } ?>
                                        <?php }?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if ($notify->page == 'class_wall' || $notify->page == 'video_tutorial' || $notify->page == 'library'){ ?>
                                            <?php foreach ($group_details as $groups){ ?>
                                                <?php if ($groups->id == $notify->group_id){ ?>
                                                    <span style="color: black;font-weight: bold"><?php echo $groups->subject_name;?></span>
                                                <?php }?>
                                            <?php }?>
                                            <br>
                                            <span style="color: black;"><?php echo $notify->data;?></span>
                                        <?php }else{?>
                                            <?php foreach ($all_users as $user){ ?>
                                                <?php if ($user->id == $notify->sender_id){ ?>
                                                    <span style="color: black;font-weight: bold"><?php echo $user->firstname;?>&nbsp;<?php echo $user->lastname;?></span>
                                                    <br>
                                                    <?php foreach ($chat_msg as $msg){ ?>
                                                        <?php  $id = $msg->user_id; ?>
                                                    <?php } ?>
                                                    <?php if ($id == $notify->sender_id){ ?>
                                                        <span id="notify-msg" style="color: grey"><?php echo $msg->message?></span>
                                                    <?php }?>
                                                <?php }?>
                                            <?php }?>
                                        <?php }?>
                                    </div>
                                    <div class="col-md-3">
                                        <?php
                                        $logs_date = date_create($notify->logs);
                                        ?>
                                        <?php if (date_format($logs_date,'d') == date('d')){ ?>
                                            <span style="color: black;font-weight: bold"><?php echo  date_format($logs_date,'h:i A')?></span>
                                        <?php }else{?>
                                            <span style="color: black;font-weight: bold"><?php echo  date_format($logs_date,'M d h:i A')?></span>
                                        <?php }?>

                                    </div>
                                </li>
                            </a>
                        <?php }  ?>
<!--                        --><?php //}?>
                        <input type="hidden" id="userID" value="<?php echo $this->session->userdata('id');?>">
                    </ul>
                    <span class="notify">Notifications</span>
                </li>
                <li class="dropdown" id="links">
                    <a id="user-option" class="dropdown-toggle" data-toggle="dropdown" href="" ><i class="fa fa-user fa-lg" aria-hidden="true"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="border-radius: 0">
                        <li><a href="<?php echo site_url()?>home/changePassword"><i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp; Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url()?>home/userLogout"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp; Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</nav>

<!--Default Password User's Modal-->
    <div id="default-pass" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Welcome <?php echo $this->session->userdata('firstname')?></h4>
                </div>
                <div class="modal-body">
                    <p>
                        Were sorry for this interruption. We recommend you to change your password.
                        Because your default password is not well secured. But if you don't want to change it.
                        Just click the SKIP button.
                    </p>
                </div>
                <div class="modal-footer">
                    <div class="col-md-10">
                        <form action="<?php echo site_url()?>home/redirectToChangePass" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id');?>">
                            <button style="border-radius: 0" type="submit" class="btn btn-primary" >Change Password</button>
                        </form>
                    </div>
                    <div class="col-md-2" style="text-align: left">
                        <form action="<?php echo site_url()?>home/changeDefaultPassStatus" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id');?>">
                            <button style="border-radius: 0" type="submit" class="btn btn-default" >Skip</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

<!--Content -->
<?php $this->load->view($content); ?>

<!--    Right Sidebar-->
<?php if ($this->uri->segment(1) != 'messages'){ ?>
<?php $this->load->view('frontend/main/rightside_chatlist');?>
<?php } ?>



<!-- Jquery Core Js -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<?php if ($pass == 1){ ?>
    <script type="text/javascript">
        $(window).on('load',function(){
            $('#default-pass').modal('show');
        });
    </script>
<?php } ?>
<!-- Bootstrap Core Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.js"></script>
<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo base_url()?>assets/frontend/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/frontend/js/dataTables.bootstrap4.min.js"></script>
<!--Jquery DateTime Picker-->
<script src="<?php echo base_url()?>assets/frontend/js/jquery.datetimepicker.full.js"></script>
<!--Custom JS-->
<script src="<?php echo base_url();?>assets/frontend/js/main2.js"></script>
<!--Comment JS-->
<script src="<?php echo base_url();?>assets/frontend/js/comment_ajax.js?time=<?php echo time();?>"></script>
<!--Notification JS-->
<script src="<?php echo base_url();?>assets/frontend/js/notification.js"></script>
<!--Chatbox JS-->
<script src="<?php echo base_url();?>assets/frontend/js/chatbox.js"></script>
</body>
</html>