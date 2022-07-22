<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>New Account for Instructor</h2>
            </div>
            <div class="body">
                <form id="form_advanced_validation" action="<?php echo site_url()?>dashboard/addNewAccount" method="POST">
                    <?php if ($this->session->flashdata('errors')):?>
                        <div class="alert alert-danger">
                            <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong><?php echo $this->session->flashdata('errors');?>
                        </div>
                    <?php elseif ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('success');?>
                        </div>
                    <?php endif;?>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="id_no" value=""  required>
                            <label class="form-label">ID No.</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="fname" value=""  required>
                            <label class="form-label">Firstname</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="lname" value=""  required>
                            <label class="form-label">Lastname</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" value="" required>
                            <label class="form-label">Email</label>
                        </div>
                        <div class="help-info">Ex: example@gmail.com</div>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                </form>

            </div>
        </div>
    </div>
</div>