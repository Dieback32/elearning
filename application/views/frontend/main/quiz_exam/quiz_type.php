<?php
foreach ($get_quiz as $g_id){
    $group_id = $g_id->group_id;
}
?>
<div class="container" style="margin-bottom: 50px;padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group[0]->id;?>"><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_library?id=<?php echo $group[0]->id;?>" class="" ><img src="<?php echo base_url()?>assets/frontend/images/book library.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Library</a></li>
            <li>
                <span class="notify-badge" style="z-index: 1000;position: absolute;margin-left: 14px"><?php if ($notify_count == null){ }else{ ?><span class="label label-danger"><?php echo $notify_count; ?></span><?php } ?></span>
                <a href="<?php echo site_url()?>class_group/class_discussion?id=<?php echo $group[0]->id;?>" class="active-link"><img src="<?php echo base_url()?>assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20"> &nbsp;&nbsp;Class Discussion</a>
            </li>
            <li><a href="<?php echo site_url()?>class_group/quizAndExam?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/icon_045780_256.png" alt="" width="20" height="20"> &nbsp;&nbsp;Quizzes & Exams</a></li>
            <li><a href="<?php echo site_url()?>class_group/projects?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/project.png" alt="" width="20" height="20"> &nbsp;&nbsp;Projects</a></li>
            <li><a href="<?php echo site_url()?>class_group/video_tutorial?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/download.png" alt="" width="20" height="20"> &nbsp;&nbsp;Video Tutorial</a></li>
            <li><a href="<?php echo site_url()?>class_group/members?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/member.png" alt="" width="20" height="20"> &nbsp;&nbsp;Members</a></li>
        </ul>
    </div>
    <div class="quiz-container">
        <div class="quiz-header">
            <span>Quizzes & Exams</span>
        </div>
        <div class="quiz-content">
            <?php if ($get_quiz == null){ ?>
                <h3 style="text-align: center">No Data</h3>
            <?php }else{ ?>
                <?php foreach ($get_quiz as $info){ ?>
                    <?php if ($info->question_type == 'multi'){ ?>

                        <form action="<?php echo site_url();?>class_group/multipleChoice" method="post" style="margin-top: 20px;">
                            <input type="hidden" name="quest_id" value="<?php echo $info->id;?>">
                            <input type="hidden" name="group_id" value="<?php echo $group_id?>">
                            <input type="hidden" name="loop" value="<?php echo $info->items?>">
                            <div class="form-group">
                                <div class="quiz-choices">
                                    <input type="text" name="quest" class="form-control" placeholder="Enter Question">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="quiz-choices">
                                    <input type="text" name="choice1[]" class="form-control" placeholder="Enter Choices">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="quiz-choices">
                                    <input type="text" name="choice1[]" class="form-control" placeholder="Enter Choices">
                                </div>
                            </div>
                            <button type="submit" name="btn-submit" class="btn btn-primary">Next</button>
                        </form>
                    <?php }elseif ($info->question_type == 'trueorfalse'){ ?>
                    <?php }elseif ($info->question_type == 'essay'){ ?>
                    <?php }elseif ($info->question_type == 'enumeration'){ ?>
                    <?php }elseif ($info->question_type == 'identification'){ ?>
                    <?php } ?>
                <?php  } } ?>
        </div>
    </div>
</div>