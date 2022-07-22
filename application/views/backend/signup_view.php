<div class="signup-box">
    <div class="logo">
        <a href="javascript:void(0);">Admin<b>Sign up</b></a>
    </div>
    <div class="card">
        <div class="body">
            <?php if ($this->session->flashdata('errors')):?>
                <div class="alert alert-danger">
                    <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('errors');?>
                </div>
            <?php endif;?>
            <form id="sign_up" action="<?php echo site_url();?>authentication/signup" method="POST">
                <div class="msg">Register to be the Admin</div>
                <div class="msg"><?php echo validation_errors();?></div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="completename" placeholder="Complete name" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person_outline</i>
                        </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                    </div>
                </div>
                <button class="btn btn-block btn-lg bg-primary waves-effect" type="submit">SIGN UP</button>
            </form>
        </div>
    </div>
</div>