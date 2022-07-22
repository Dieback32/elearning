<div class="signup-box">
    <div class="logo">
        <a href="javascript:void(0);">Forgot Password</a>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" action="<?php echo site_url()?>authentication/sendEmail" method="POST">
                <div class="msg">Enter your email to receive a verification</div>

                <?php if ($this->session->flashdata('msg')):?>
                    <span style="color: green;"><i class="fa fa-check" aria-hidden="true"></i> &nbsp;<?php echo $this->session->flashdata('msg');?></span>
                <?php elseif ($this->session->flashdata('failed')):?>
                    <span style="color: red;"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> &nbsp;<?php echo $this->session->flashdata('failed');?></span>
                <?php endif;?>

                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-5">
                        <button class="btn btn-block bg-primary waves-effect" type="submit">SEND</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>