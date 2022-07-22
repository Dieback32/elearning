<?php
    if ($this->session->userdata('authorization') != 'admin'){
        redirect('dashboard');
    }

    if ($footer_data == $check_data){
        $id = '';
        $company = '';
        $message = '';
        $year = '';
    }else{
        foreach ($footer_data as $footer){
            $id = $footer->id;
            $company = $footer->company_name;
            $message = $footer->message;
            $year = $footer->year;
        }
    }

?>
<!--   Footer Management-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <h2 class="text-uppercase" style="text-align: center"> Footer Management</h2>
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

            <form id="form_validation" action="<?php echo site_url()?>dashboard/manageFooter" method="POST"  >
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="company" value="<?php echo $company;?>" required>
                        <label class="form-label">Company Name</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="message" value="<?php echo $message;?>" required>
                        <label class="form-label">Message</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="year" value="<?php echo $year;?>" required>
                        <label class="form-label">Copy Right Year</label>
                    </div>
                </div>
                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                &nbsp<a class="btn btn-danger" href="<?php echo site_url();?>dashboard/deleteFooter">Delete Footer</a>
            </form>
        </div>
    </div>
</div>