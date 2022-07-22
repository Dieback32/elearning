<?php
if ($this->session->userdata('authorization') != 'admin'){
    redirect('dashboard');
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
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 class="text-uppercase">Contact Details </h2>
            </div>
            <div class="body">
                <?php if ($this->session->flashdata('contact')){ ?>
                    <div class="alert alert-success">
                        <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('contact');?>
                    </div>
                <?php }?>
                <form id="form_advanced_validation" action="<?php echo site_url();?>dashboard/contactSettings" method="POST">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="school" value="<?php echo $school;?>" required>
                            <label class="form-label">School Name</label>
                        </div>
                        <div class="help-info">Ex: Computer Arts & Technological College, Inc.</div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="location" value="<?php echo $location;?>" required>
                            <label class="form-label">Address</label>
                        </div>
                        <div class="help-info">Ex: Balintawak Street, Albay District, Legazpi City</div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" value="<?php echo $email;?>" required>
                            <label class="form-label">Email</label>
                        </div>
                        <div class="help-info">Ex: catc.elearning@gmail.com</div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="number" value="<?php echo $c_number;?>" required>
                            <label class="form-label">Contact Number</label>
                        </div>
                        <div class="help-info">Ex: 480-1645 / +639277062157</div>
                    </div>
                    <input class="btn btn-primary waves-effect" value="Submit" type="submit" onclick="test()">
                </form>
            </div>
        </div>
    </div>
</div>