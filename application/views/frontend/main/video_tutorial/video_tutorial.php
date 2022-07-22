<style>
    /*.vid-container {*/
        /*position: relative;*/
        /*padding-bottom: 52%;*/
        /*padding-top: 30px;*/
        /*height: 0;*/
    /*}*/

    /*.vid-container video,*/
    /*.vid-container object,*/
    /*.vid-container embed {*/
        /*position: absolute;*/
        /*top: 0;*/
        /*left: 0;*/
        /*width: 100%;*/
        /*height: 100%;*/
    /*}*/

    .vid-list-container {
        width: 92%;
        overflow: hidden;
        margin-top: 20px;
        margin-left: 4%;
        padding-bottom: 20px;
    }

    .vid-list {
        width: 1344px;
        position: relative;
        top:0;
        left: 0;
    }
    .vid-item:hover{
      background: #c8ccd4;
    }

    .vid-item .desc{
        color: #21A1D2;
        font-size: 15px;
        margin-top: 5px;
    }

    .vid-item{
        display: block;
        width: 148px;
        height: 148px;
        float: left;
        margin: 0;
        padding: 10px;
        cursor: pointer;
    }

    .thumb{
        overflow: hidden;
        height: 84px;
    }


    .arrows {
        position:relative;
        width: 100%;
    }

    .arrow-left {
        color: #fff;
        position: absolute;
        background: #777;
        padding: 15px;
        left: -25px;
        top: -130px;
        z-index: 99;
        cursor: pointer;
    }

    .arrow-right {
        color: #fff;
        position: absolute;
        background: #777;
        padding: 15px;
        right: -25px;
        top: -130px;
        z-index:100;
        cursor: pointer;
    }

    @media (max-width: 624px) {
        .arrows {
            position:relative;
            margin: 0 auto;
            width:96px;
        }
        .arrow-left {
            left: 0;
            top: -20px;
        }

        .arrow-right {
            right: 0;
            top: -20px;
        }
    }
</style>

<div class="container" style="padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_library?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/book library.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Library</a></li>
            <li>
                <span class="notify-badge"  style="z-index: 1000;position: absolute;margin-left: -5px"><?php if ($count_notify_chat == null){ }else{ ?><span class="label label-danger"><?php echo $count_notify_chat; ?></span><?php } ?></span>
                <a class="group-chat-count" id="<?php echo $group[0]->id;?>" href="<?php echo site_url()?>class_group/class_discussion?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20"> &nbsp;&nbsp;Class Discussion</a>
            </li>
            <li><a href="<?php echo site_url()?>class_group/quizAndExam?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/icon_045780_256.png" alt="" width="20" height="20"> &nbsp;&nbsp;Quizzes & Exams</a></li>
            <li><a href="<?php echo site_url()?>class_group/projects?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/project.png" alt="" width="20" height="20"> &nbsp;&nbsp;Projects</a></li>
            <li><a href="<?php echo site_url()?>class_group/video_tutorial?id=<?php echo $group[0]->id;?>" class="active-link"><img src="<?php echo base_url()?>assets/frontend/images/download.png" alt="" width="20" height="20"> &nbsp;&nbsp;Video Tutorial</a></li>
            <li><a href="<?php echo site_url()?>class_group/members?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/member.png" alt="" width="20" height="20"> &nbsp;&nbsp;Members</a></li>
        </ul>
        <div class="row clearfix"></div>
    </div>
    <div class="wall-content">
        <div class="grade-header">
            <h4 style="margin-left: 12px;">Video Tutorial</h4>
        </div>
        <?php if ($this->session->flashdata('video_uploaded')){ ?>
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('video_uploaded');?>
            </div>
        <?php }elseif($this->session->flashdata('video_error')){ ?>
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> <?php echo $this->session->flashdata('video_error');?>
            </div>
        <?php } ?>
        <div class="class-wall-container">
            <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
                <button style="float: right;border-radius: 0" class="btn btn-danger" data-toggle="modal" data-target="#deleteVideo"><i class="fa fa-trash"></i>&nbsp;Delete Video</button>
                <button style="border-radius: 0" class="btn btn-primary" data-toggle="modal" data-target="#uploadVideo"><i class="fa fa-plus"></i> Upload Video</button>
            <?php } ?>

            <div class="row"></div>
            <div class="col-md-12" style="padding: 30px 10px 10px 10px">
                <?php if ($video != null){?>
                    <div class="vid-container">
                        <video controls poster="" class="video-playback">
                            <source  src="<?php echo base_url();?>uploads/video_tutorial/<?php echo $video[0]->video;?>" type="video/mp4">
                            <source  src="<?php echo base_url();?>uploads/video_tutorial/<?php echo $video[0]->video;?>" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                <?php }else{?>
                    <div class="vid-container">
                       <span style="text-align: center;font-weight: bold;font-size: 16px">No Video has been Uploaded.</span>
                    </div>
                <?php }?>
            </div>
            <div class="row"></div>
            <?php if ($video != null){ ?>
                <div class="vid-list-container">
                    <div class="vid-list">
                        <?php foreach ($video as $play){ ?>
                            <div class="vid-item" id="<?php echo $play->id;?>" ">
                            <div class="thumb">
                                <img class="img-thumbnail" src="<?php echo base_url();?>uploads/video_tutorial/Icon_10-512.png" alt="Icon"  width="84" height="100" style="margin-left: 20px;" />
                            </div>
                            <div class="desc">
                                <?php echo $play->video_name;?>
                            </div>
                    </div>
                        <?php } ?>

                </div>
            <?php } ?>

            </div>
        <?php if ($video != null){ ?>
            <div class="arrows">
                <div class="arrow-left">
                    <i class="fa fa-chevron-left fa-lg"></i>
                </div>
                <div class="arrow-right">
                    <i class="fa fa-chevron-right fa-lg"></i>
                </div>
            </div>
        <?php } ?>

            <div class="row"></div>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>

<!--Upload Modal -->
<div id="uploadVideo" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Video Tutorial</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>class_group/uploadVideoTutorial" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-group">
                            <input type="hidden" name="uri" value="class_group/video_tutorial?id=<?php echo $group[0]->id;?>">
                            <input type="hidden" name="image" value="<?php echo $group[0]->group_img;?>">
                            <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id');?>">
                            <input type="hidden" name="groupID" value="<?php echo $group[0]->id;?>">
                            <label for="">Video</label>
                            <input type="file" name="userfile" class="btn btn-info" size="20" style="border-radius: 0" required>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="">Video Name</label>
                                <input type="text" name="vid_name" class="form-control" size="20" style="border-radius: 0" required>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button style="border-radius: 0;" type="submit" class="btn btn-default" >Upload</button>
                </form>
            </div>

        </div>

    </div>
</div>

<!--Delete Modal -->
<div id="deleteVideo" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Video Tutorial</h4>
            </div>
            <div class="modal-body" style="min-height: 400px;max-height: 400px;overflow-y: scroll;min-width: 595px;max-width: 595px">
                <div style="float: right;margin-right: 60px">
                    <span style="margin-right: 10px;font-weight: bold">Selete/Unselect All</span>
                    <input style="height: 18px;width: 18px;" type="checkbox" id="checkAll" class="checkAlldata">
                    <label for="checkAll"></label>
                </div>
                <div class="row"></div>
                <form action="<?php echo site_url();?>class_group/deleteVideoTutorial" method="post">
                    <?php foreach ($video as $list){ ?>
                    <div class="quiz-list row" >
                        <div class="col-md-4">
                            <img class="img-thumbnail" src="<?php echo base_url();?>uploads/video_tutorial/Icon_10-512.png" alt="Icon"  width="84" height="100" style="margin-left: 20px;" />
                        </div>
                        <div class="col-md-6" style="padding-top: 30px">
                            <span style="font-weight: bold"><?php echo $list->video_name;?></span>
                        </div>
                        <div class="col-md-2" style="padding-top: 30px;">
                            <input type="hidden" name="group_id" value="<?php echo $group[0]->id;?>">
                            <input style="height: 18px;width: 18px;" type="checkbox" name="checkbox[]" value="<?php echo $list->id;?>">
                        </div>
                    </div>
                    <?php }?>

            </div>
            <div class="modal-footer">
                <button style="border-radius: 0;" type="submit" class="btn btn-danger" >Delete</button>
                </form>
            </div>

        </div>

    </div>
</div>

