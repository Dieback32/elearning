<?php
if ($this->session->userdata('authorization') != 'admin'){
    redirect('dashboard');
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Menu Management Form</h2>
            </div>
            <div class="body">
                <form id="form_validation" action="<?php echo site_url()?>dashboard/addMenu" method="POST">
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
                        <label class="form-label">Select Menu Type : </label>
                        <input name="menu_type" type="radio" id="parent" value="parent" class="radio-col-cyan" />
                        <label for="parent">Parent</label>
                        <input name="menu_type" type="radio" id="child" value="child"  class="radio-col-cyan" checked/>
                        <label for="child">Child</label>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="menu_title" required>
                            <label class="form-label">Menu Title</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <select class="form-control show-tick" name="selparent" id="selparent"  >
                            <option value="">--Select Parent--</option>
                            <?php foreach ($show_parent as $prow){ ?>
                                <option><?php echo $prow->parent_title?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group form-float">
                        <select class="form-control show-tick" name="selcontent" required>
                            <option value="">--Select Page Content--</option>
                            <?php foreach ($show_content as $crow){?>
                                <?php if ($crow->content_title == 'default'):?>
                                <?php else:?>
                                    <option><?php echo $crow->content_title?></option>
                                <?php endif;?>
                            <?php }?>
                        </select>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
