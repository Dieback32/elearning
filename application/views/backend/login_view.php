<div class="signup-box">
    <div class="logo">
        <a href="javascript:void(0);">Admin<b>Sign in</b></a>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" action="<?php echo site_url()?>authentication/login" method="POST">
                <div class="msg">Sign in to start your session</div>
                <?php if ($this->session->flashdata('errors')):?>
                    <div class="input-group">
                       <span style="color: red"> <i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $this->session->flashdata('errors');?></span>
                    </div>
                <?php endif;?>
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
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-5">
                        <button class="btn btn-block bg-green waves-effect" type="submit">SIGN IN</button>
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="<?php echo site_url()?>authentication/forgotPassword">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
