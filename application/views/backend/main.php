<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <!-- Web Icon-->
    <link rel="icon" href="<?php echo base_url();?>assets/images/Control-Panel-icon.png" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="<?php echo base_url();?>assets/css/googleapis.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/googleapisicon.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!--    Font-awesome CSS-->
    <link href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- Waves Effect Css -->
    <link href="<?php echo base_url();?>assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="<?php echo base_url();?>assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
</head>
<body class="signup-page">

    <?php $this->load->view($check); ?>

<!-- Jquery Core Js -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.js"></script>
<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/node-waves/waves.js"></script>
<!-- Validation Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/jquery.validate.js"></script>
<!-- Custom Js -->
<script src="<?php echo base_url();?>assets/js/admin.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/examples/sign-up.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/examples/sign-in.js"></script>
</body>
</html>