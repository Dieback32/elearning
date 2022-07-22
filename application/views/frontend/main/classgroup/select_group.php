<div class="create-group-container">
    <div class="grade-header">
        <h4>Class Group</h4>
    </div>
    <div class="group-content-box">
        <?php if ($this->session->flashdata('failedupload')){ ?>
            <span> <?php echo $this->session->flashdata('failedupload'); ?></span>
        <?php } ?>

        <?php if ($class_group == NULL){ ?>
            <h4 style="text-align: center">Empty</h4>
        <?php  }else{ ?>
        <?php foreach ($class_group as $cg){ ?>
        <div class="row group-list-data" >
            <div class="col-md-3">
                <a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $cg->id;?>" style="color: black">
                    <?php if ($cg->group_img == ''){ ?>
                        <img src="<?php echo base_url()?>assets/images/default-img.png" alt="" width="100" height="100">
                    <?php }else{ ?>
                        <img src="<?php echo base_url()?>uploads/classphoto/<?php echo $cg->group_img;?>" alt="" width="100" height="100">
                    <?php } ?>
                </a>
            </div>
            <?php foreach ($class_subject as $subject){ ?>
                <?php if ($subject->id == $cg->subject_id){ ?>
                <div class="col-md-5" style="padding-top: 40px">
                    <a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $cg->id;?>" style="color: black">
                        <strong><?php echo $subject->subject_code;?> </strong><br>
                        <strong><?php echo $cg->subject_name?> </strong></br>
                    </a>
                </div>
                <div class="col-md-2" style="padding-top: 40px">
                    <strong><?php echo $subject->semester;?> Sem</strong><br>
                    <strong><?php echo $subject->school_year;?> </strong><br>
                </div>
                <?php } ?>
            <?php }?>
            <div class="col-md-2">
                <div class="g-settings dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>
                        <ul class="dropdown-menu">
                            <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#upload" class="uploadPhotos" id="<?php echo $cg->id; ?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Upload Photo</a></li>
                            <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#delete_group" class="deleteGroup" id="<?php echo $cg->id; ?>"><i style="margin-right: 20px;" class="fa fa-trash" aria-hidden="true"></i>Remove Photo</a></li>
                        </ul>
                    </a>
                </div>
            </div>
        </div>
        <div class="row clearfix"></div>
        <?php } }?>
    </div>

</div>


<!--Upload Photo-->
<div id="upload" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Photo</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('class_group/uploadGroupPhoto');?>
                <input type="hidden" name="id_group" id="id_group">
                <input type="file" name="userfile" size="20" />
                <br />
                <input type="submit" class="btn btn-info" value="Upload" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Delete Group-->
<div id="delete_group" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Remove Photo</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="delete-group">
                    <div class="form-group">
                        <h4 style="text-align: center">Are you sure you want to remove the group photo?</h4>
                    </div>
                    <div class="form-group" style="text-align: center">
                        <input type="hidden" name="group_id" id="gID">
                        <input style="border-radius: 0;margin-right: 25px;" type="submit" class="btn btn-danger" value="Delete">
                        <button style="border-radius: 0" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>