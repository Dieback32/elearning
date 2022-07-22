<div class="container" style="padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group[0]->id;?>" class="active-link"><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_library?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/book library.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Library</a></li>
            <li>
                <span class="notify-badge"  style="z-index: 1000;position: absolute;margin-left: -5px"><?php if ($count_notify_chat == null){ }else{ ?><span class="label label-danger"><?php echo $count_notify_chat; ?></span><?php } ?></span>
                <a class="group-chat-count" id="<?php echo $group[0]->id;?>" href="<?php echo site_url()?>class_group/class_discussion?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20">&nbsp;&nbsp;Class Discussion</a>
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
            <?php if ($group[0]->group_img == null){?>
                <img src="<?php echo base_url()?>assets/images/default-img.png" alt="Class Photo" width="50" height="50" style="border-radius: 50%">
            <?php }else{?>
                <img src="<?php echo base_url()?>uploads/classphoto/<?php echo $group[0]->group_img;?>" alt="Class Photo" width="50" height="50" style="border-radius: 50%;">
            <?php }?>
            <?php foreach ($subject as $sub){ ?>
                <?php if ($sub->id == $group[0]->subject_id){?>
                <span style="font-weight: bold;font-size: 15px;margin-left: 12px;"><?php echo $sub->subject_code;?></span>
                <?php }?>
            <?php }?>
            <span style="font-weight: bold;font-size: 15px;margin-left: 12px;"><?php echo $group[0]->subject_name;?></span>
        </div>
        <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
            <div class="class-wall-container">
                <textarea style="resize: none;border-radius: 0" name="" id="comment-textarea" cols="" rows="4" class="form-control" ></textarea>
                <div class="form-group" style="float: right;margin-top: 20px">
                    <input type="button" class="btn btn-info" value="POST" id="post-btn" style="border-radius: 0">
                </div>
            </div>
        <?php } ?>
        <div class="comment-holder">
        <?php if ($comment == null){ ?>
            <div class="clearfix row"></div>
            <div id="comment" class="comment">
                <div class="user-comment">
<!--                    <h4 style="text-align: center;">Empty post</h4>-->
                </div>
            </div>
        <?php }else{ ?>
        <?php foreach ($comment as $com): ?>
        <div class="clearfix row"></div>
        <div id="comment" class="comment">
            <div class="user-image">
                <img src="<?php echo base_url()?>uploads/users/<?php echo $com->avatar?>" alt="Avatar">
                <strong style="padding-left: 15px" ><?php echo $com->name?></strong>
            </div>
            <div class="user-comment">
                <span><?php echo $com->comment;?></span>
            </div>
        </div>
        <?php endforeach; ?>
        <?php } ?>
        </div>
        <input type="hidden" id="uri" value="class_group/classWall?id=<?php echo $group[0]->id;?>">
        <input type="hidden" id="group_image" value="<?php echo $group[0]->group_img;?>">
        <input type="hidden" id="userId" value="<?php echo $this->session->userdata('id');?>">
        <input type="hidden" id="userName" value="<?php echo $this->session->userdata('firstname');?>&nbsp;<?php echo $this->session->userdata('lastname');?>">
        <input type="hidden" id="avatar" value="<?php echo $this->session->userdata('avatar');?>">
        <input type="hidden" id="group_id" value="<?php echo $group[0]->id;?>">
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>

<!--<script>-->
<!--    function strip(e) {-->
<!--        var text = document.getElementById(e);-->
<!--        var regex = /[^a-z 0-9?!.,_@%$*^()=|-]/gi;-->
<!--        text.value = text.value.replace(regex, "");-->
<!--    }-->
<!--</script>-->
