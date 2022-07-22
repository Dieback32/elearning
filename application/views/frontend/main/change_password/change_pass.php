<div class="class-container container">
    <div class="group-sidebar">
        <ul class="menu-list">
             <li><a href="#change-pass" class=" active-link"><img src="<?php echo base_url()?>assets/frontend/images/security.png" alt="Security" width="20" height="20"> &nbsp;&nbsp;Security and Login</a></li>
        </ul>
    </div>
    <div class="group-content">
        <div class="grade-header">
            <h4>Change Password</h4>
        </div>
        <div class="change-pass" style="margin: 20px 20px 20px 20px;">
            <?php if ($this->session->flashdata('success')){ ?>
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('success');?>
                </div>
            <?php }elseif ($this->session->flashdata('error')){?>
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('error');?>
                </div>
            <?php } ?>
            <form action="<?php echo site_url()?>home/changingPassword" method="post" id="change-password">
                <div class="form-group">
                    <input type="password" name="old" class="form-control" placeholder="Old Password">
                </div>
                <div class="form-group">
                    <input type="password" name="new" id="new" class="form-control" placeholder="New Password">
                </div>
                <div class="form-group">
                    <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Re-type New">
                    <i style="color: red;" id="error-pass"></i>
                </div>
                <button style="border-radius: 0" type="submit" class="btn btn-primary">Change</button>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>