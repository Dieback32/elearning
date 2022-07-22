<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Create Subject</h2>
            </div>
            <div class="body">
                <form id="form_advanced_validation" action="<?php echo site_url()?>dashboard/addNewSubject" method="POST">
                    <?php if ($this->session->flashdata('failed')):?>
                        <div class="alert alert-danger">
                            <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('failed');?>
                        </div>
                    <?php elseif ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('success');?>
                        </div>
                    <?php endif;?>
                    <div class="form-group form-float">
                        <select name="sy" id="" class="show-tick" required>
                            <option value="">--Select School Year</option>
                            <?php foreach ($sy as $year){ ?>
                                <option><?php echo $year->school_year;?></option>
                            <?php }?>
                        </select>
                        <label class="form-label">Semester :</label>
                        <input name="semester" type="radio" value="1st" id="first"  checked/>
                        <label for="first">1st</label>
                        <input name="semester" type="radio" value="2nd" id="second" />
                        <label for="second">2nd</label>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="subcode" value=""  required>
                            <label class="form-label">Subject Code</label>
                        </div>
                        <div class="help-info">Ex: CS1038B</div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="subdesc" value="" required>
                            <label class="form-label">Subject Description</label>
                        </div>
                        <div class="help-info">Ex: Software Engineering</div>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label">Day</label>
                        <select name="subday" id="" class="show-tick" required>
                            <option value="">--Select Day</option>
                            <option>M</option>
                            <option>M W</option>
                            <option>T</option>
                            <option>W</option>
                            <option>W F</option>
                            <option>TTH</option>
                            <option>TH</option>
                            <option>F</option>
                            <option>S</option>
                        </select>
                    </div>
                    <div class="form-group form-float">
                            <label class="form-label">Time</label>
                            <select name="subtime" id="" class="show-tick" required>
                                <option value="">--Select Time</option>
                                <option>7:30 - 9:00</option>
                                <option>9:00 - 10:30</option>
                                <option>9:00 - 12:00</option>
                                <option>1:00 - 2:30</option>
                                <option>1:00 - 4:00</option>
                                <option>2:30 - 4:00</option>
                                <option>4:00 - 5:30</option>
                                <option>4:00 - 7:00</option>
                                <option>4:30 - 7:30</option>
                                <option>5:30 - 7:00</option>
                                <option>7:00 - 8:30</option>
                            </select>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>