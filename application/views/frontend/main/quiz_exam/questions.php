<?php
foreach ($get_quiz as $g_id){
    $group_id = $g_id->group_id;
}
?>
<div class="container" style="margin-bottom: 50px;padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group_id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/quizAndExam?id=<?php echo $group_id;?> " class="quiz-exam active-link "><img src="<?php echo base_url()?>assets/frontend/images/icon_045780_256.png" alt="" width="20" height="20"> &nbsp;&nbsp;Quizzes & Exams</a></li>
            <li><a href="<?php echo site_url()?>class_group/projects?id=<?php echo $group_id;?>"><img src="<?php echo base_url()?>assets/frontend/images/project.png" alt="" width="20" height="20"> &nbsp;&nbsp;Projects</a></li>
            <li><a href="<?php echo site_url()?>class_group/live_lecture?id=<?php echo $group_id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/download.png" alt="" width="20" height="20"> &nbsp;&nbsp;Live Lecture</a></li>
            <li><a href="<?php echo site_url()?>class_group/members?id=<?php $group_id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/member.png" alt="" width="20" height="20"> &nbsp;&nbsp;Members</a></li>
        </ul>
    </div>
    <div class="quiz-container">
        <div class="quiz-header">
            <span>Quizzes & Exams</span>
        </div>
        <div class="quiz-content">

        </div>
    </div>
</div>