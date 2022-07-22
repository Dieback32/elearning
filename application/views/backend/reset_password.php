<?php
    $code_verify ='';
    $email = '';
   foreach ($verify_code as $row) {
        $code_verify = $row->code;
        $email = $row->user_email;
   }

       if ($code_verify != $this->uri->segment(4) || $this->uri->segment(4) == NULL ) {
           redirect('login');
       }
?>
<div class="signup-box">
    <div class="logo">
        <a href="javascript:void(0);">Reset Password</a>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" action="<?php echo site_url()?>authentication/resetPassword" method="POST">
                <div class="msg">Fill up the form to reset your password</div>
                <?php if ($this->session->flashdata('errors')):?>
                    <div class="alert alert-danger">
                        <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('errors');?>
                    </div>
                <?php elseif ($this->session->flashdata('success')):?>
                    <div class="alert alert-success">
                        <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('success');?>
                    </div>
                <?php endif;?>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="hidden" name="email" value="<?php echo $email;?>">
                        <input type="password" class="form-control" name="newpass" placeholder="New Password" required>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="confirm" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-5">
                        <button class="btn btn-block bg-primary waves-effect" type="submit">RESET</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>