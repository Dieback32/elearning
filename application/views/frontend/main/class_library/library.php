<div class="container" style="padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group[0]->id;?>"><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_library?id=<?php echo $group[0]->id;?>" class="active-link" ><img src="<?php echo base_url()?>assets/frontend/images/book library.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Library</a></li>
            <li>
                <span class="notify-badge"  style="z-index: 1000;position: absolute;margin-left: -5px"><?php if ($count_notify_chat == null){ }else{ ?><span class="label label-danger"><?php echo $count_notify_chat; ?></span><?php } ?></span>
                <a class="group-chat-count" id="<?php echo $group[0]->id;?>" href="<?php echo site_url()?>class_group/class_discussion?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20"> &nbsp;&nbsp;Class Discussion</a>
            </li>
            <li><a href="<?php echo site_url()?>class_group/quizAndExam?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/icon_045780_256.png" alt="" width="20" height="20"> &nbsp;&nbsp;Quizzes & Exams</a></li>
            <li><a href="<?php echo site_url()?>class_group/projects?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/project.png" alt="" width="20" height="20"> &nbsp;&nbsp;Projects</a></li>
            <li><a href="<?php echo site_url()?>class_group/video_tutorial?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/download.png" alt="" width="20" height="20"> &nbsp;&nbsp;Video Tutorial</a></li>
            <li><a href="<?php echo site_url()?>class_group/members?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/member.png" alt="" width="20" height="20"> &nbsp;&nbsp;Members</a></li>
        </ul>
        <div class="row clearfix"></div>
<!--        <div class="access-code"></div>-->
    </div>
    <div class="wall-content">
        <div class="grade-header">
            <h4>Class Library</h4>
        </div>
        <div style="margin: 20px 20px 0 20px">
            <?php if ($this->session->flashdata('library_error')){ ?>
                <div class="alert alert-danger alert-dismissable " style="width: 450px; margin: 0 auto;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong>&nbsp;<?php echo $this->session->flashdata('library_error');?>
                </div>
            <?php }elseif ($this->session->flashdata('library_uploaded')){ ?>
                <div class="alert alert-success alert-dismissable" style="width: 450px; margin: 0 auto;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong>&nbsp;<?php echo $this->session->flashdata('library_uploaded');?>
                </div>
            <?php }elseif ($this->session->flashdata('delete_file')){ ?>
            <div class="alert alert-success alert-dismissable" style="width: 450px; margin: 0 auto;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong>&nbsp;<?php echo $this->session->flashdata('delete_file');?>
            </div>
            <?php } ?>
            <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
            <div style="margin-top: 20px">
                <form action="<?php echo site_url()?>class_group/uploadLibraryFiles" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="group_id" value="<?php echo $group[0]->id;?>">
                    <input type="hidden" name="subject_id" value="<?php echo $group[0]->subject_id;?>">
                    <input type="hidden" name="user" value="<?php echo $this->session->userdata('id')?>">
                    <input type="hidden" name="image" value="<?php echo $group[0]->group_img;?>">
                    <input type="hidden" name="uri" value="class_group/class_library?id=<?php echo $group[0]->id;?>">
                    <div class="form-group">
                        <input type="file" name="userfile" class="btn btn-info" size="20" style="border-radius: 0">
                    </div>
                    <input style="border-radius: 0" type="submit" class="btn btn-default" value="Upload" />
                </form>
            </div>
            <?php }?>
            <?php foreach ($class_files as $files){ ?>
            <div class="quiz-list row" >
                <div class="col-md-6">
                    <span><a style="color: black;font-weight: bold;" href="<?php echo base_url();?>uploads/class_library/<?php echo $files->file;?>" download="<?php echo $files->file;?>"><?php echo $files->file;?></a></span>
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-2">
                    <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
                    <div class="q-settings dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>
                            <ul style="border-radius: 0" class="dropdown-menu">
                                <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#deleteLibrary" class="deleteLibraryItems" id="<?php echo $files->id?>" ><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Delete</a></li>
                            </ul>
                        </a>
                    </div>
                    <?php }?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>

<!-- Delete Library Items-->
<div id="deleteLibrary" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="text-align: center" class="modal-title">Are you sure that you want to delete this file?</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>class_group/deleteLibrary" method="post" >
                    <div class="form-group" style="text-align: center">
                        <input type="hidden" name="file_id" id="file_id">
                        <input type="hidden" name="group_id" value="<?php echo $group[0]->id;?>">
                        <button style="border-radius: 0;margin-right: 20px" type="submit" class="btn btn-danger">Delete</button>
                        <button style="border-radius: 0" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>

