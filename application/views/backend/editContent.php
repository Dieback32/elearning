<?php
if ($this->session->userdata('authorization') != 'admin'){
    redirect('dashboard');
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Edit Content Form</h2>
            </div>
            <div class="body">
                <form id="form_validation" action="<?php echo site_url()?>/dashboard/updateContent" method="POST">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="msg"><i class="fa fa-check" id="bg-success" aria-hidden="true"> <span id="font-family"> <?php echo $this->session->flashdata('success');  ?></span></i></div>
                    <?php }elseif ($this->session->flashdata('failed')) {?>
                        <div class="msg"><i class="fa fa-exclamation-circle" id="bg-failed" aria-hidden="true"> <span id="font-family"> <?php echo $this->session->flashdata('failed');  ?></span></i></div>
                    <?php }?>
                    <br>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="hidden" name="content_id" value="<?php echo $content_title[0]->id;?>">
                            <input type="text" class="form-control" name="content_title" value="<?php echo $content_title[0]->content_title?>" required>
                            <label class="form-label">Content Title</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label">Page Content</label>
                        <textarea id="ckeditor" name="content">
                            <?php echo $content_title[0]->content; ?>
                        </textarea>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
