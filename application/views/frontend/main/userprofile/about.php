<?php
foreach ($user_info as $info){
    $about = $info->about_you;
}
?>
<div class="header-info">
    <span>About you</span>
</div>
<div class="data-list">
    <?php if ($about != ''){ ?>
        <span class="edit-about"><a href="#" data-toggle="modal" data-target="#about" >Edit</a></span>
        <p style="margin-right: 50px"><?php echo $about?></p>
    <?php }else{?>
        <span class="edit-about"><a href="#" data-toggle="modal" data-target="#about" >Edit</a></span>
        <p style="margin-right: 50px">This is the information about you.</p>
    <?php }?>

</div>

<!--Modal About-->
<div id="about" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tell About Yourself</h4>
            </div>
            <div class="modal-body">
                <?php if ($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger">
                        <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php } ?>
                <form action="<?php echo site_url()?>userprofile/aboutYourself" method="post">
                    <div class="form-group">
                        <label for="place">About You</label>
                        <input type="hidden" name="id" value="<?php echo $this->session->userdata('id');?>">
                        <textarea style="resize: none;" name="about" class="form-control" id="" cols="20" rows="5" placeholder="Tell about yourself..."></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
