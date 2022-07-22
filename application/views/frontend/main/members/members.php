<div class="container" style="padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_library?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/book library.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Library</a></li>
            <li>
                <span class="notify-badge"  style="z-index: 1000;position: absolute;margin-left: -5px"><?php if ($count_notify_chat == null){ }else{ ?><span class="label label-danger"><?php echo $count_notify_chat; ?></span><?php } ?></span>
                <a class="group-chat-count" id="<?php echo $group[0]->id;?>" href="<?php echo site_url()?>class_group/class_discussion?id=<?php echo $group[0]->id;?>"><img src="<?php echo base_url()?>assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20"> &nbsp;&nbsp;Class Discussion</a>
            </li>
            <li><a href="<?php echo site_url()?>class_group/quizAndExam?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/icon_045780_256.png" alt="" width="20" height="20"> &nbsp;&nbsp;Quizzes & Exams</a></li>
            <li><a href="<?php echo site_url()?>class_group/projects?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/project.png" alt="" width="20" height="20"> &nbsp;&nbsp;Projects</a></li>
            <li><a href="<?php echo site_url()?>class_group/video_tutorial?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/download.png" alt="" width="20" height="20"> &nbsp;&nbsp;Video Tutorial</a></li>
            <li><a href="<?php echo site_url()?>class_group/members?id=<?php echo $group[0]->id;?>" class="active-link"><img src="<?php echo base_url()?>assets/frontend/images/member.png" alt="" width="20" height="20"> &nbsp;&nbsp;Members</a></li>

        </ul>
        <div class="row clearfix"></div>
<!--        <div class="access-code"></div>-->
    </div>
    <div class="wall-content" style="padding: 20px 20px 20px 20px;">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">All</a></li>
            <li><a data-toggle="tab" href="#menu1">Students</a></li>
            <li><a data-toggle="tab" href="#menu2">Instructor</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
<!--                Display the Instructor of the Group-->
                <?php foreach ($instructor as $ins){ ?>
                    <?php if($group[0]->instructor_id == $ins->id){ ?>
                    <div class="user-content">
                        <?php if ($ins->avatar == null){ ?>
                            <img id="user-picture" src="<?php echo base_url()?>uploads/users/fbpic.jpg" alt="Avatar">
                        <?php }else{ ?>
                            <img id="user-picture" src="<?php echo base_url()?>uploads/users/<?php echo $ins->avatar;?>" alt="Avatar">
                        <?php } ?>
                        <strong><?php echo $ins->firstname;?>&nbsp;<?php echo $ins->lastname;?></strong>
                        <img id="user-position" src="<?php echo base_url()?>uploads/users/64958-200.png" alt="Position" >
                    </div>
                <?php } } ?>
<!--                Display All the Students of the Group-->
                <?php
                foreach ($all_students as $std_grp){
                    $std_id = $std_grp->student_id;
                    ?>
                <?php foreach ($students as $std_data){ ?>
                    <?php if ($std_id == $std_data->id){ ?>
                <div class="user-content">
                    <?php if ($std_data->avatar == null){ ?>
                        <img id="user-picture" src="<?php echo base_url()?>uploads/users/fbpic.jpg" alt="Avatar">
                    <?php }else{ ?>
                        <img id="user-picture" src="<?php echo base_url()?>uploads/users/<?php echo $std_data->avatar;?>" alt="Avatar">
                    <?php } ?>
                    <strong><a href="#"><?php echo $std_data->firstname;?>&nbsp;<?php echo $std_data->lastname;?></a></strong>
                    <img id="user-position" src="<?php echo base_url()?>uploads/users/student.png" alt="Position" >
                    <?php if ($std_data->status == 'activated'){ ?>
                    <img class="user-status" src="<?php echo base_url()?>uploads/users/active.png" alt="Active">
                    <?php }else{ ?>
                    <img class="user-status" src="<?php echo base_url()?>uploads/users/deactivate.png" alt="Deactivated">
                    <?php } ?>
                </div>

                <?php } } }?>
            </div>
            <div id="menu1" class="tab-pane fade">
                <!--                Display All the Students of the Group-->
                <?php if ($all_students == null){ ?>
                    <div class="user-content">
                        <h3 style="text-align: center">Empty Data</h3>
                    </div>
                <?php }else{ ?>
                <?php
                foreach ($all_students as $std_grp){
                    $std_id = $std_grp->student_id;
                    ?>
                    <?php foreach ($students as $std_data){ ?>
                        <?php if ($std_id == $std_data->id){ ?>
                            <div class="user-content">
                                <?php if ($std_data->avatar == null){ ?>
                                    <img id="user-picture" src="<?php echo base_url()?>uploads/users/fbpic.jpg" alt="Avatar">
                                <?php }else{ ?>
                                    <img id="user-picture" src="<?php echo base_url()?>uploads/users/<?php echo $std_data->avatar;?>" alt="Avatar">
                                <?php } ?>
                                <strong><?php echo $std_data->firstname;?>&nbsp;<?php echo $std_data->lastname;?></strong>
                                <img id="user-position" src="<?php echo base_url()?>uploads/users/student.png" alt="Position" >
                                <?php if ($std_data->status == 'activated'){ ?>
                                    <img class="user-status" src="<?php echo base_url()?>uploads/users/active.png" alt="Active">
                                <?php }else{ ?>
                                    <img class="user-status" src="<?php echo base_url()?>uploads/users/deactivate.png" alt="Deactivated">
                                <?php } ?>
                            </div>
                        <?php } } } }?>
            </div>
            <div id="menu2" class="tab-pane fade">
                <!--                Display the Instructor of the Group-->
                <?php foreach ($instructor as $ins){ ?>
                    <?php if($group[0]->instructor_id == $ins->id){ ?>
                        <div class="user-content">
                            <?php if ($ins->avatar == null){ ?>
                                <img id="user-picture" src="<?php echo base_url()?>uploads/users/fbpic.jpg" alt="Avatar">
                            <?php }else{ ?>
                                <img id="user-picture" src="<?php echo base_url()?>uploads/users/<?php echo $ins->avatar;?>" alt="Avatar">
                            <?php } ?>
                            <strong><?php echo $ins->firstname;?>&nbsp;<?php echo $ins->lastname;?></strong>
                            <img id="user-position" src="<?php echo base_url()?>uploads/users/64958-200.png" alt="Position" >
                        </div>
                    <?php } } ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>