<div class="container" style="padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group[0]->id;?>"><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_library?id=<?php echo $group[0]->id;?>" class="" ><img src="<?php echo base_url()?>assets/frontend/images/book library.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Library</a></li>
            <li>
                <a href="<?php echo site_url()?>class_group/class_discussion?id=<?php echo $group[0]->id;?>" class="active-link"><img src="<?php echo base_url()?>assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20"> &nbsp;&nbsp;Class Discussion</a>
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
            <h4>Class Discussion</h4>
        </div>
        <div style="margin: 20px 20px 0 20px" >
        <div class="_chatbox-content" >
            <?php
            $data = array(
                'chatmessage' => $this->chat_message->getMessage(),
                'user' => $this->user_management->getAllUsers()
            );
            $this->load->view('frontend/main/messages/chat_message',$data);
            ?>
        </div>
        </div>
        <div class="_chatbox-message-container">
            <div class="_chatbox-message-1">
                <div class="_chatbox-message-2">
                    <div class="_chatbox-message-3">
                        <input type="hidden" id="chat_uri" value="class_group/class_discussion?id=<?php echo $group[0]->id;?>">
                        <input type="hidden" name="image_user" id="image_user" value="<?php echo $this->session->userdata('avatar');?>">
                        <input type="hidden" name="user" id="user" value="<?php echo $this->session->userdata('id');?>">
                        <button class="btn btn-default"  onclick="startConverting();" style="color: black; border-radius: 60%;float: right;margin-right: 20px"><i class="fa fa-microphone fa-lg"></i></button>
                        <input type="hidden" id="group_Id" value="<?php echo $group[0]->id;?>">
                        <textarea  style="position: absolute;" class="_chatbox-text-field" name="msg" id="userMsg" cols="" rows="" placeholder="Type a message..."></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>

<!--<script>-->
<!--    function strip(e) {-->
<!--        var text = document.getElementById(e);-->
<!--        var regex = /[^a-z 0-9?!.,_@%$*^()|-]/gi;-->
<!--        text.value = text.value.replace(regex, "");-->
<!--    }-->
<!--</script>-->
