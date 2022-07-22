<div class="container" style="padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_library?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/book library.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Library</a></li>
            <li>
                <span class="notify-badge"  style="z-index: 1000;position: absolute;margin-left: -5px"><?php if ($count_notify_chat == null){ }else{ ?><span class="label label-danger"><?php echo $count_notify_chat; ?></span><?php } ?></span>
                <a class="group-chat-count" id="<?php echo $group[0]->id;?>" href="<?php echo site_url()?>class_group/class_discussion?id=<?php echo $group[0]->id;?>"><img src="<?php echo base_url()?>assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20"> &nbsp;&nbsp;Class Discussion</a>
            </li>
            <li><a href="<?php echo site_url()?>class_group/quizAndExam?id=<?php echo $group[0]->id;?> " class="quiz-exam active-link "><img src="<?php echo base_url()?>assets/frontend/images/icon_045780_256.png" alt="" width="20" height="20"> &nbsp;&nbsp;Quizzes & Exams</a></li>
            <li><a href="<?php echo site_url()?>class_group/projects?id=<?php echo $group[0]->id;?>"><img src="<?php echo base_url()?>assets/frontend/images/project.png" alt="" width="20" height="20"> &nbsp;&nbsp;Projects</a></li>
            <li><a href="<?php echo site_url()?>class_group/video_tutorial?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/download.png" alt="" width="20" height="20"> &nbsp;&nbsp;Video Tutorial</a></li>
            <li><a href="<?php echo site_url()?>class_group/members?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/member.png" alt="" width="20" height="20"> &nbsp;&nbsp;Members</a></li>
        </ul>
        <div class="row clearfix"></div>
        <!--        <div class="access-code"></div>-->
    </div>
    <div class="quiz-container">
        <div class="quiz-header">
            <span>Summary</span>
        </div>
        <div class="quiz-content">
            <?php if ($this->session->userdata('authorization') == 'student'){ ?>
            <?php foreach ($student_score as $score){ ?>
                    <?php if ($score->student_id == $this->session->userdata('id')){ ?>
                        <div class="col-md-12">
                            <span style="font-size: 16px;font-weight: bold"><?php echo $score->score;?>&nbsp;out of &nbsp;<?php echo $score->total_items?></span><br>
                            <span style="font-size: 16px;font-weight: bold">Equivalent: &nbsp;<?php echo $score->equivalent;?></span>
                        </div>
                    <?php }?>
                <div class="row" style="margin-bottom: 30px"></div>
            <?php }?>
                <?php foreach ($questions as $quest){ ?>
                    <?php foreach ($exam_summary as $summary){ ?>
                        <?php if ($summary->question_id == $quest->id && $summary->student_id == $this->session->userdata('id')){ ?>
                            <span style="font-size: 17px;font-weight: bold;background: #475080;color: ghostwhite;padding: 5px 5px 5px 5px;border-radius: 3px 3px 3px 3px"><?php echo $quest->question;?></span><br>
                            <div class='row'></div>
                            <span style='font-size: 15px;font-weight: bold;'>Answer</span> : <span style='font-size: 15px;'><?php echo $summary->answer;?></span><br>
                            <?php foreach ($choices as $cho){ ?>
                                <?php if ($cho->question_id == $summary->question_id){ ?>
                                    <?php if ($cho->is_correct == 1){ ?>
                                        <span style='font-size: 15px;font-weight: bold;'>Correct Answer</span> : <span style='font-size: 15px;'><?php echo $cho->choices;?></span><br>
                                    <?php }?>
                                <?php }?>
                            <?php } ?>
                            <div class='row' style='margin-top: 10px;'></div>
                        <?php }?>
                    <?php }?>
                <?php }?>
            <?php }else{ ?>
                <?php foreach ($studentsGroup as $studGroup){ ?>
                        <?php foreach ($getStudens as $userdata){ ?>
                            <?php if ($studGroup->student_id == $userdata->id){ ?>
                                <div class="quiz-list" style="padding-bottom: 40px">
                                    <div class="col-md-4">
                                        <span style="font-weight: bold;"><?php echo $userdata->firstname;?>&nbsp;<?php echo $userdata->lastname;?></span>
                                    </div>

                            <?php foreach ($student_score as $score){ ?>
                                    <?php if ($userdata->id == $score->student_id){ ?>
                                        <div class="col-md-4">
                                            <span style="font-weight: bold;"><?php echo $score->score;?> out of <?php echo $score->total_items;?></span>
                                        </div>
                                        <div class="col-md-2">
                                            <span style="font-weight: bold;"><?php echo $score->equivalent;?></span>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="hidden" id="quizID" value="<?php echo $score->quiz_id?>">
                                            <div class="q-settings dropdown">
                                                <a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>
                                                    <ul class="dropdown-menu" style="border-radius: 0">
                                                        <li>
                                                            <a style="font-weight: bold;" href="" data-toggle="modal" data-target="#exam-summary" class="examSummary" id="<?php echo $userdata->id;?>" ><i style="margin-right: 20px" class="fa fa-list-ul"></i>Exam Summary</a>
                                                        </li>
                                                    </ul>
                                                </a>
                                            </div>
                                        </div>
                                    <?php }?>
<!--                                    <div class="col-md-4">-->
<!--                                        <span style="font-weight: bold;">Did not take the quiz/exam.</span>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-2">-->
<!--                                        <span style="font-weight: bold;">65.00</span>-->
<!--                                    </div>-->

                            <?php } ?>


                                </div>
                            <?php } ?>
                    <?php }?>
                <?php }?>

            <?php }?>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>

<!--Exam Summary-->
<div id="exam-summary" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Exam Summary</h4>
            </div>
            <div class="modal-body" style="overflow-y: scroll;min-height: 400px">
             <div class="form-group">
                <div id="questions-container"></div>
             </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

