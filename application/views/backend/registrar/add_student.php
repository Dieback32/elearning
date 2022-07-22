<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>New Account for Student</h2>
            </div>
            <div class="body">
                <form id="form_advanced_validation" action="<?php echo site_url()?>dashboard/addStudentsAccount" method="POST">
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
                            <input type="text" class="form-control" name="ID" value=""  required>
                            <label class="form-label">ID</label>
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
                    <div class="form-group form-float">
                        <label class="form-label">Course</label>
                        <select name="course" id="" class="show-tick" required>
                            <option value="">--Select Course</option>
                            <option>BSIT</option>
                            <option>BSCS</option>
                            <option>BSBA</option>
                            <option>BSOA</option>
                            <option>BSEE</option>
                            <option>BSCpE</option>
                            <option>BSECE</option>
                            <option>BSCrim</option>
                            <option>ACT</option>
                        </select>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label">Year Level</label>
                        <select name="year" id="" class="show-tick" required>
                            <option value="">--Select Year Level</option>
                            <option>I</option>
                            <option>II</option>
                            <option>III</option>
                            <option>IV</option>
                            <option>V</option>
                        </select>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                </form>

            </div>
        </div>
    </div>
</div>