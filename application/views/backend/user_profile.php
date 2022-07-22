<!-- File Upload -->
<div class="row clearfix">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
        <div class="card">
            <div class="header">
                <?php foreach ($user_prof as $user){?>
                    <h2 class="text-uppercase"><?php echo $user->authorization;?> Profile Avatar</h2>
                <?php } ?>
            </div>
            <div class="body">
                <?php if ($this->session->flashdata('error')):?>
                    <div class="alert alert-danger">
                        <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry,</strong> <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php elseif ($this->session->flashdata('uploaded')):?>
                    <div class="alert alert-success">
                        <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('uploaded');?>
                    </div>
                <?php endif;?>
                <?php foreach ($user_prof as $pic){ ?>
                <?php if ($pic->avatar == ''){ ?>
                    <div style="text-align: center"><img src="<?php echo base_url();?>uploads/users/fbpic.jpg" alt="User Avatar" width="150" height="180"></div>
                <?php }else{?>
                    <div style="text-align: center"><img src="<?php echo base_url();?>uploads/users/<?php echo $pic->avatar; ?>" alt="User Avatar" width="150" height="180"></div>
                <?php } } ?>
                <br><br>
                <?php echo form_open_multipart('dashboard/user_avatar');?>

                    <input type="file" name="userfile" size="20" />

                <br /><br />

                <input type="submit" class="btn btn-primary" value="Upload" />
                </form>
            </div>
        </div>
    </div>
<!-- #END# File Upload  -->
<!--Change Password-->
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
        <div class="card">
            <div class="header">
                <?php foreach ($user_prof as $user){?>
                    <h2 class="text-uppercase">Change Password</h2>
                <?php } ?>
            </div>
            <div class="body">
                <?php if ($this->session->flashdata('errors')):?>
                    <div class="alert alert-danger">
                        <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry,</strong> <?php echo $this->session->flashdata('errors');?>
                    </div>
                <?php elseif($this->session->flashdata('success')):?>
                    <div class="alert alert-success">
                        <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('success');?>
                    </div>
                <?php elseif($this->session->flashdata('failed')):?>
                    <div class="alert alert-danger">
                        <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry,</strong> <?php echo $this->session->flashdata('failed');?>
                    </div>
                <?php endif;?>
                <form id="form_advanced_validation" action="<?php echo site_url();?>dashboard/userChangepass" method="POST">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" class="form-control" name="oldpassword" value=""  required>
                            <label class="form-label">Old Password</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" class="form-control" name="newpassword" minlength="6" value="" required>
                            <label class="form-label">New Password</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" class="form-control" name="confirm" minlength="6" value="" required>
                            <label class="form-label">Confirm Password</label>
                        </div>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">Change</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Profile information-->
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <?php foreach ($user_prof as $user){ ?>
            <h2 class="text-uppercase"><?php echo $user->authorization;?>&nbsp;Profile Information </h2>
        </div>
        <div class="body">
            <?php if ($this->session->flashdata('updateuser')){ ?>
                <div class="alert alert-success">
                    <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('updateuser');?>
                </div>
            <?php }?>
            <form id="form_advanced_validation" action="<?php echo site_url();?>dashboard/profile_edit" method="POST">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="fullname" value="<?php echo $user->complete_name ?>" required>
                        <label class="form-label">Firstname Surname</label>
                    </div>
                    <div class="help-info">Ex: Kirk Hammett</div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" value="<?php echo $user->email; ?>" required>
                        <label class="form-label">Email</label>
                    </div>
                    <div class="help-info">example@gmail.com</div>
                </div>
                <input class="btn btn-primary waves-effect" value="Update" type="submit" onclick="test()">
            </form>
            <?php } ?>
        </div>
    </div>
</div>
</div>