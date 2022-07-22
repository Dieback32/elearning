<?php
if ($this->session->userdata('authorization') != 'admin'){
    redirect('dashboard');
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Content Form</h2>
            </div>
            <div class="body">
                <form id="form_validation" action="<?php echo site_url()?>/dashboard/addPage" method="POST">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success">
                            <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('success');?>
                        </div>
                    <?php }elseif ($this->session->flashdata('failed')) {?>
                        <div class="alert alert-danger">
                            <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry,</strong> <?php echo $this->session->flashdata('failed');?>
                        </div>
                    <?php }?>
                    <br>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="content_title" required>
                            <label class="form-label">Content Title</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label">Page Content</label>
                        <textarea id="ckeditor" name="content">

                        </textarea>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
