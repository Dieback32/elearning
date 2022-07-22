<?php
if ($this->session->userdata('authorization') != 'registrar' && $this->session->userdata('authorization') != 'staff'){
    redirect('dashboard');
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Edit Subject</h2>
            </div>
            <div class="body">
                <form id="form_validation" action="<?php echo site_url()?>dashboard/editingSubject" method="POST">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success">
                            <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('success');?>
                        </div>
                    <?php }elseif ($this->session->flashdata('failed')) {?>
                        <div class="alert alert-danger">
                            <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('failed');?>
                        </div>
                    <?php }?>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="hidden" name="id" value="<?php echo $subject[0]->id; ?>">
                            <input type="text" class="form-control" name="subject_id" value="<?php echo $subject[0]->subject_code?>" required>
                            <label class="form-label">Subject ID</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="description" value="<?php echo $subject[0]->subject_desc?>" required>
                            <label class="form-label">Description</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="day" value="<?php echo $subject[0]->day?>" required>
                            <label class="form-label">Day</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="time" value="<?php echo $subject[0]->time?>" required>
                            <label class="form-label">Time</label>
                        </div>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
