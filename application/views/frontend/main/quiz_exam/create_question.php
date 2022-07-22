<?php
    foreach ($get_quiz as $g_id){
        $group_id = $g_id->group_id;
        $quiz_id = $g_id->id;
    }
?>
<div class="container" style="padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group_id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_library?id=<?php echo $group_id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/book library.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Library</a></li>
            <li>
                <span class="notify-badge"  style="z-index: 1000;position: absolute;margin-left: -5px"><?php if ($count_notify_chat == null){ }else{ ?><span class="label label-danger"><?php echo $count_notify_chat; ?></span><?php } ?></span>
                <a class="group-chat-count" id="<?php echo $group_id;?>" href="<?php echo site_url()?>class_group/class_discussion?id=<?php echo $group_id;?>"><img src="<?php echo base_url()?>assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20"> &nbsp;&nbsp;Class Discussion</a>
            </li>
            <li><a href="<?php echo site_url()?>class_group/quizAndExam?id=<?php echo $group_id;?> " class="quiz-exam active-link "><img src="<?php echo base_url()?>assets/frontend/images/icon_045780_256.png" alt="" width="20" height="20"> &nbsp;&nbsp;Quizzes & Exams</a></li>
            <li><a href="<?php echo site_url()?>class_group/projects?id=<?php echo $group_id;?>"><img src="<?php echo base_url()?>assets/frontend/images/project.png" alt="" width="20" height="20"> &nbsp;&nbsp;Projects</a></li>
            <li><a href="<?php echo site_url()?>class_group/video_tutorial?id=<?php echo $group_id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/download.png" alt="" width="20" height="20"> &nbsp;&nbsp;Video Tutorial</a></li>
            <li><a href="<?php echo site_url()?>class_group/members?id=<?php echo $group_id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/member.png" alt="" width="20" height="20"> &nbsp;&nbsp;Members</a></li>
        </ul>
    </div>
    <div class="quiz-container">
        <div class="quiz-header">
            <?php
                $date_start = date_create($get_quiz[0]->start);
                $status = "";
                if ($get_quiz[0]->start < date('Y-m-d H:i:s')){
                    $status = "On Going";
                }else{
                    $status = "Pending";
                }
            ?>
            <span ><?php echo $get_quiz[0]->name;?></span>&nbsp;<span>(<?php echo $get_quiz[0]->set_by;?>)</span><br>
            <?php if ($get_quiz[0]->set_by == 'automatic'){ ?>
                <span style="position: absolute;">Date Start: <?php echo date_format($date_start,'M d, Y h:i A'); ?></span><span style="float: right">Time Limit: <?php echo $get_quiz[0]->time_limit;?>min</span>
            <?php }else{?>
                <span style="float: right;margin-right: 20px;"><?php echo $status;?></span>
                <span style="position: absolute;">Time Limit : <?php echo $get_quiz[0]->time_limit;?>min</span>
            <?php }?>
        </div>
        <div id="msg">
            <?php if ($this->session->flashdata('no_question')){ ?>
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong>&nbsp;<?php echo $this->session->flashdata('no_question');?>
                </div>
            <?php }?>
        </div>
        <div class="quiz-content">
<!--            Instructor's Menu-->
            <input type="hidden" id="present_time" value="<?php echo date('Y-m-d H:i:s');?>">
            <input type="hidden" id="check_start" value="<?php echo $get_quiz[0]->start;?>">
            <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
                <?php if ($get_quiz[0]->set_by == 'manual'){ ?>
                    <button type="button" class="btn btn-success" name="start-time-quiz" data-toggle="modal" data-target="#startOfQuiz" style="float: right;" id="start-btn-quiz" >Start</button>
                <?php } ?>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addQuestion" id="add-btn-quiz" >Add Question</button>

            <?php foreach ($question as $list){ ?>
            <div class="quiz-list">
                <h4><?php echo $list->question_number;?>.&nbsp;<?php echo $list->question;?></h4>
                <small><?php echo $list->type;?></small>
                <div class="q-settings dropdown edit-delete-quiz" id="edit-delete-quiz">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>
                        <ul class="dropdown-menu">
                            <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#edit-question" class="QuestionEdit" id="<?php echo $list->id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Edit</a></li>
                            <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#delete-question" class="QuestionDelete" id="<?php echo $list->id;?>"><i style="margin-right: 20px;" class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                        </ul>
                    </a>
                </div>
            </div>
            <?php } }?>
<!--            Student's Menu-->
            <?php
                foreach ($get_result as $score){
                    $student_score = $score->score;
                }
                if ($get_result == null){
                    $student_score = '0';
                }
            ?>
            <?php $present = date('Y-m-d H:i:s'); ?>
            <?php if ($question == null){ ?>
                <h4 style="text-align: center">No Question has been created</h4>
            <?php }else{ ?>
            <?php if ($this->session->userdata('authorization') == 'student'){ ?>
                    <?php if ($get_quiz[0]->start >= $present){ ?>
                        <h4 style="text-align: center">The Exam/Quiz has not been started.</h4>
                    <?php }else{ ?>
                <?php if ($numberofquestion == $summary || $get_quiz[0]->status == 'deactivated' ) { ?>
                    <h4>Your Score is <?php echo $student_score;?> out of <?php echo $numberofquestion;?></h4>
                    <?php }else{ ?>
                <?php if ($question != null){ ?>
                    <a style="border-radius: 0" href="<?php echo site_url()?>class_group/startOfExam?q=<?php echo $quiz_id;?>" class="btn btn-success" >Begin</a>
<!--                    <h4 style="text-align: center;margin-top: 20px;"><strong>Remember: </strong>You cannot change your answer after you click the <i>Submit</i> button</h4>-->
                <?php }?>
                <?php }?>
            <?php } } }  ?>

        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>
<!--Add Question Modal -->
<div id="addQuestion" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Question</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <select name="type" id="type" class="form-control">
                        <option value="">--Select Type--</option>
                        <option value="multiple">Multiple Choice</option>
                        <option value="trueORfalse">True or False</option>
                        <option value="blank">Fill in the Blank</option>
                    </select>
                </div>
                <?php
                    if ($numbering == null){
                        $number = 1;
                    }else{
                        $number = $numbering[0]->question_number + 1;
                    }

                ?>
                <form action="<?php echo site_url()?>class_group/questionAndAnswer" method="post">
                    <input type="hidden" name="group_id" value="<?php echo $group_id;?>">
                    <input type="hidden" name="term" value="<?php echo $get_quiz[0]->term;?>">
                    <input type="hidden" name="kind_of" value="<?php echo $get_quiz[0]->type;?>">
                    <input type="hidden" name="quest_id" value="<?php echo $get_quiz[0]->id;?>">
                    <input type="hidden" name="question_number" value="<?php echo $number;?>">
                    <h4><?php echo $number;?></h4>
                    <div class="form-group">
                        <input type="text" class="form-control" name="question" id="question" placeholder="Enter Question" required>
                    </div>
                    <div id="show-question"><h4>No Item Selected</h4></div>
                    <button style="border-radius: 0;" type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Edit Question Modal-->
<div id="edit-question" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Question</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url()?>class_group/editQuestion" method="post" >
                    <input type="hidden" name="question_id" id="question_ID">
                    <input type="hidden" name="quiz_id" value="<?php echo $get_quiz[0]->id;?>">
                    <div class="form-group">
                        <select name="type" id="type-question" class="form-control">
                            <option value="">--Select Type--</option>
                            <option value="multiple">Multiple Choice</option>
                            <option value="trueORfalse">True or False</option>
                            <option value="blank">Fill in the Blank</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="question" id="questions" placeholder="Enter Question" required>
                    </div>
                    <div id="show-edit-question"></div>
                    <button style="border-radius: 0" type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!--Delete Question Modal-->
<div id="delete-question" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url()?>class_group/deleteQuestions" method="post">
                    <div class="form-group">
                        <h4 style="text-align: center">Are you sure you want to delete this item?</h4>
                    </div>
                    <div class="form-group" style="text-align: center">
                        <input type="hidden" name="quiz_id" value="<?php echo $get_quiz[0]->id;?>">
                        <input type="hidden" name="questionID" id="questionID">
                        <input style="border-radius: 0;margin-right: 25px;" type="submit" class="btn btn-danger" value="Delete">
                        <button style="border-radius: 0" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<!--Delete Modal-->
<div id="startOfQuiz" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="delete_quiz">
                    <div class="form-group">
                        <h4 style="text-align: center">Are you sure you want to start this Quiz/Exam?</h4>
                    </div>
                    <div class="form-group" style="text-align: center">
                        <input style="border-radius: 0;margin-right: 25px;" type="submit" class="btn btn-success startOfQuizExam" value="Start" id="<?php echo $get_quiz[0]->id;?>">
                        <button style="border-radius: 0" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

