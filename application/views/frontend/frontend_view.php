<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
if ($webdata == $check_webdata){
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
?>
<?php

if ($contact == $check_contact){
    $school = '';
    $location = '';
    $email = '';
    $c_number = '';
}else{
    foreach ($contact as $details){
        $school = $details->school;
        $location = $details->location;
        $email = $details->email;
        $c_number = $details->contact_no;
    }
}

if ($footer == $check_footer){
    $company_name = '';
    $message = '';
    $year = '';
}else{
    foreach ($footer as $footer_data){
        $company_name = $footer_data->company_name;
        $message = $footer_data->message;
        $year = $footer_data->year;
    }
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
    <!--    Font-awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.css">
    <!-- Custom Css -->
    <link href="<?php echo base_url();?>assets/frontend/css/home2.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="border: 0; background-color: #3b5998" >
    <div class="container-fluid">
        <!--For Mobile Resolution-->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a style=" padding: 0px;height: 100%; width: auto;" class="navbar-brand" href="<?php echo site_url()?>">
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
                <!--                <li id="links">-->
                <!--                    <a style="color: white" class="page-scroll text-uppercase" href="--><?php //echo site_url()?><!--" >Home</a>-->
                <!--                </li>-->
                <li id="links">
                    <a style="color: white" class="page-scroll text-uppercase" href="<?php echo site_url()?>signin" >Sign In</a>
                </li>
                <?php
                foreach ($parent as $prow){
                    ?>
                    <li id="links" class="dropdown" ><a style="color: white;background-color: transparent" class="text-uppercase dropdown-toggle" <?php if ($prow->child_status > 0){echo "data-toggle=\"dropdown\"";} ?>  href="<?php echo site_url()?><?php echo $prow->content_id; ?>"><?php echo $prow->parent_title;?> <?php if ($prow->child_status > 0){echo "<span class=\"caret\"></span>";} ?> </a>
                        <ul class="dropdown-menu">
                            <?php
                            foreach ($child as $crow){
                                if ($prow->id == $crow->parent_id){
                                    ?>
                                    <li><a href="<?php echo site_url()?><?php echo $crow->content_id; ?>"><?php echo $crow->child_title; ?></a></li>
                                <?php } }?>
                        </ul>
                    </li>
                <?php }?>

                <li id="links">
                    <a style="color:white; background-color: #3b5998" class="page-scroll text-uppercase" href="#contact" >Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!--CONTENT-->
<div id="banner-cover">
    <!--    Banner Image-->
    <?php if ($banner == ''){?>
        <img src="<?php echo base_url()?>assets/images/default-banner.jpg" alt="Banner" class="banner">
    <?php }else{?>
        <img src="<?php echo base_url()?>uploads/banner/<?php echo $banner?>" alt="Banner" class="banner">
    <?php }?>
    <div class="overlay"></div>
    <?php
    if ($content == $check_content){
        $content_id = '';
        $content_title = '';
        $content_page = '';
    }else{
        foreach ($content as $content_row) {
            $content_id = $content_row->id;
            $content_title = $content_row->content_title;
            $content_page = $content_row->content;
        }
    }

    if ($content_id == $this->uri->segment(1)){
        ?>
        <div class="container">
            <div class="jumbotron" id="content-banner">
                <h1 style="text-align: center"><?php echo $content_title; ?></h1>
                <p style="text-align: center!important;"><?php echo $content_page ; ?></p>
            </div>
        </div>
    <?php }else{?>
        <div class="container">
            <div class="row" id="content-banner">
                <div class="col-md-3" id="sign-in">
                    <?php if ($this->uri->segment(1)=="" || $this->uri->segment(1)=="signin"){?>
                        <h1 style="text-align: center">Sign In</h1>
                        <?php if ($this->session->flashdata('success')){ ?>
                            <div class="alert alert-success">
                                <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('success');?>
                            </div>
                        <?php }elseif ($this->session->flashdata('logged_in')){ ?>
                            <div class="alert alert-danger">
                                <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('logged_in');?>
                            </div>
                        <?php }elseif ($this->session->flashdata('errors')){ ?>
                            <div class="alert alert-danger">
                                <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('errors');?>
                            </div>
                        <?php } ?>
                        <form action="<?php echo site_url();?>frontend/userLogin" method="post">
                            <div class="form-group">
                                <label for="">ID No.</label>
                                <input style="border-radius: 0" type="text" name="id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input style="border-radius: 0" type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button style="border-radius: 0" class="btn btn-success">Login</button><!--<span style="float: right;margin-top:6px "><a href="#" style="color: white!important;">Forgot Password?</a></span>-->
                            </div>
                        </form>
                    <?php }?>
                </div>
                <div class="col-md-8 information-details" style="float: right">
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading">E-learning</h4>
                            <p>E-learning theory describes the cognitive science
                                principles of effective multimedia learning using
                                electronic educational technology. Cognitive
                                research and theory suggest that the selection
                                of appropriate concurrent multimedia modalities
                                may enhance learning, as may application of several other principles.</p>
                        </div>
                        <div class="media-right">
                            <img src="<?php echo base_url();?>assets/images/icon-e-learning-1b72z9p.png" class="media-object" width="80" height="80">
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading" id="student-media">Teachers</h4>
                            <p id="student-media">The relatively recent boom in technology has opened up incredibly
                                valuable resources for teachers and students. One of the most
                                valuable resources currently available is the ability to give and
                                receive academic instruction. We typically think of this technological
                                advancement as a huge benefit for students, but it also creates major
                                opportunities for teachers to lead more fulfilling- and lucrative- careers.</p>
                        </div>
                        <div class="media-right">
                            <img src="<?php echo base_url();?>assets/images/24-512.png" class="media-object" width="80" height="80">
                        </div>
                    </div>
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading" id="student-media">Students</h4>
                            <p id="student-media">At a time when change is faster than ever, a key
                                advantage of elearning is that it has quicker delivery
                                cycle times than traditional classroom-based instruction.
                                In fact, research indicates that elearning reduces
                                learning time by at least 25 to 60 percent when compared
                                to traditional learning.</p>
                        </div>
                        <div class="media-right">
                            <img src="<?php echo base_url();?>assets/images/103-512.png" class="media-object" width="80" height="80">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<!--END OF CONTENT-->
<!--CONTACT US -->
<section id="contact">
    <div class="container">
        <h1 style="text-align: center">Contact Us</h1>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <h4><i class="fa fa-building-o fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<?php echo $school;?></h4>
                <br>
                <h4><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $location?></h4>
                <br>
                <h4><i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<?php echo $email;?></h4>
                <br>
                <h4><i class="fa fa-phone fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<?php echo $c_number;?></h4>

            </div>
            <div class="col-md-4">
                <h3 style="text-align: center">Contact Us</h3>
                <form action="<?php echo site_url();?>frontend/contactUs" method="post">
                    <div class="form-group">
                        <label for="">Email: </label>
                        <input style="border-radius: 0" name="email" type="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Message: </label>
                        <textarea style="border-radius: 0;resize: none"  name="info"  cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <button style="border-radius: 0;"  type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
</section>

<!--END OF CONTACT US-->
<!--FOOTER-->
<div class="clearfix"></div>

<footer style="color: white;">
    <div class="col-md-12" style="background: black;height: 30px;">
        <span style="bottom: 0;position: static;"><?php echo $company_name;?></span>
        <span style="bottom: 0;position: static;float: right"><i class="fa fa-copyright" aria-hidden="true"></i> <?php echo $message;?>&nbsp;<?php echo $year;?></span>
    </div>
</footer>
<!--END OF FOOTER-->

<!-- Jquery Core Js -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.js"></script>
<!--Custom JS-->
<script src="<?php echo base_url();?>assets/frontend/js/custom.js"></script>
</body>
</html>