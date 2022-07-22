<div class="container" style="padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_library?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/book library.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Library</a></li>
            <li>
                <span class="notify-badge"  style="z-index: 1000;position: absolute;margin-left: -5px"><?php if ($count_notify_chat == null){ }else{ ?><span class="label label-danger"><?php echo $count_notify_chat; ?></span><?php } ?></span>
                <a class="group-chat-count" id="<?php echo $group[0]->id;?>" href="<?php echo site_url()?>class_group/class_discussion?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20"> &nbsp;&nbsp;Class Discussion</a>
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
            <span>Quizzes & Exams</span>
        </div>
        <div class="quiz-content">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#list">List</a></li>
                <li><a data-toggle="tab" href="#quizResult">Results</a></li>
            </ul>

            <div class="tab-content">
                <div id="list" class="tab-pane fade in active">
                    <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
                        <div class="add-search-container">
<!--                            <button style="border-radius: 0;margin-top: 20px;" data-toggle="modal" data-target="#AddQuiz" type="button" class="btn btn-primary">Add Quiz/Exam</button>-->
                            <div class="dropdown" style="border-radius: 0;margin-top: 20px;position: absolute">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Add Quiz/Exam
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu" style="border-radius: 0">
                                    <li role="presentation">
                                        <a href="#" data-toggle="modal" data-target="#AddQuiz">
                                            <span style="font-size: 15px;font-weight: bold">Automatic</span> <h4 class="divider"></h4>
                                            <span style="color: gray">This will set to the future quiz/exam.</span>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li role="presentation">
                                        <a href="#" data-toggle="modal" data-target="#manualQuiz">
                                            <span style="font-size: 15px;font-weight: bold">Manual</span>  <h4 class="divider"></h4>
                                            <span style="color: gray">This will start after the instructor click the start button.</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <input type="text" class="form-control search-quiz" id="<?php echo $group[0]->id;?>" style="float: right;position: relative;width: 200px; margin-top: 20px" placeholder="Search">
                        </div>
                        <div class="row"></div>
                    <?php } ?>

                    <div class="quiz-list-content" id="result">
                    <?php if ($quiz_info != null){ ?>
                        <?php foreach ($quiz_info as $info){ ?>
                            <?php $id = $info->id; ?>
                            <?php if ($this->session->userdata('authorization') == 'student'){ ?>
                                <?php if ($info->status != 'Hidden'){ ?>
                                    <div class="quiz-list" >
                                        <div style="padding-bottom: 30px;">
                                            <div class="col-md-4">
                                                <span><a style="font-weight: bold;" href="<?php echo site_url()?>class_group/createQuestion?q=<?php echo $info->id;?>"><?php echo $info->name;?></a></span>
                                            </div>
                                            <div class="col-md-4" style="text-align: center;">
                                                <span style="font-weight: bold;"><?php echo $info->set_by;?></span>
                                            </div>
                                            <?php if ($info->set_by == "automatic"){ ?>
                                                <div class="col-md-4">
                                                    <span style="font-weight: bold;"><?php echo $info->start;?></span>
                                                </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php }else{ ?>
                                <div class="quiz-list" >
                                    <div style="padding-bottom: 30px;">
                                        <div class="col-md-4">
                                            <span><a style="font-weight: bold;" href="<?php echo site_url()?>class_group/createQuestion?q=<?php echo $info->id;?>"><?php echo $info->name;?></a></span>
                                        </div>
                                        <div class="col-md-4" style="text-align: center;">
                                            <span style="font-weight: bold;"><?php echo $info->set_by;?></span>
                                        </div>
                                    <div class="q-settings dropdown">
                                        <a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a style="font-weight: bold;" href="" data-toggle="modal" data-target="#edit-modal" class="QuizEdit" id="<?php echo $info->id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                                </li>
                                                <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#delete-modal" class="QuizDelete" id="<?php echo $info->id;?>"><i style="margin-right: 20px;" class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                                            </ul>
                                        </a>
                                    </div>
                                    </div>
                                </div>
                            <?php } ?>

                        <?php } }else{ ?>
                        <div class="quiz-list"><h4 style="text-align: center;margin-top: 20px;" >Empty Data</h4></div>
                    <?php } ?>
                    </div>
                </div>
                <div id="quizResult" class="tab-pane fade">
                    <div class="quiz-list-content" id="result">
                        <?php if ($quiz_info != null){ ?>
                            <?php foreach ($quiz_info as $info){ ?>
                                <?php $id = $info->id; ?>
                                <?php if ($this->session->userdata('authorization') == 'student'){ ?>
                                    <?php if ($info->status != 'Hidden'){ ?>
                                        <div class="quiz-list" >
                                            <div style="padding-bottom: 30px;">
                                                <div class="col-md-4">
                                                    <span><a style="font-weight: bold;" href="<?php echo site_url()?>class_group/viewSummary?q=<?php echo $info->id;?>&id=<?php echo $group[0]->id;?>"><?php echo $info->name;?></a></span>
                                                </div>
                                                <?php if ($info->set_by == "automatic"){ ?>
                                                    <div class="col-md-4">
                                                        <span style="font-weight: bold;"><?php echo $info->start;?></span>
                                                    </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <div class="quiz-list" >
                                        <div style="padding-bottom: 30px;">
                                            <div class="col-md-4">
                                                <span><a style="font-weight: bold;" href="<?php echo site_url()?>class_group/viewSummary?q=<?php echo $info->id;?>&id=<?php echo $group[0]->id;?>"><?php echo $info->name;?></a></span>
                                            </div>
                                            <div class="col-md-4" style="text-align: center;">
                                                <span style="font-weight: bold;"><?php echo $info->start;?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            <?php } }else{ ?>
                            <div class="quiz-list"><h4 style="text-align: center;margin-top: 20px;" >Empty Data</h4></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>

<!--Add Modal Automatic-->
<div id="AddQuiz" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Quiz/Exam</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="insert_quiz">
                    <div class="form-group">
                        <input type="text" name="quiz_name" id="quiz_name" class="form-control" placeholder="Name" required>
                        <input type="hidden" name="group_id" value="<?php echo  $group[0]->id;?>">
                    </div>
                    <div class="form-group">
                        <label for="term">Term</label><br>
                        <select name="term" id="term" class="form-control" required>
                            <option value="">--Select Term--</option>
                            <option value="prelim">Prelim</option>
                            <option value="midterm">Midterm</option>
                            <option value="prefinal">Prefinal</option>
                            <option value="finals">Finals</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label><br>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">--Select Type--</option>
                            <option value="quiz">Quiz</option>
                            <option value="exam">Term Exam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start">Start at</label><br>
                        <input type="hidden" name="present" id="present" value="<?php echo date('Y/m/d H:i')?>">
                        <input type="text" class="form-control" id="start_date" name="start_date" required>
                        <div id="start-error" style="color: red"></div>
                    </div>
                    <div class="form-group">
                        <label for="end">Time Limit</label><br>
                        <input type="number" class="form-control"  name="limit" required>
<!--                        <div id="end-error" style="color: red"></div>-->
                    </div>
                    <div class="form-group">
                        <span><strong>Note:</strong> This will indicate whether to <i>Published</i> or <i>Hide</i> the Exam/Quiz you have created. </span><br>
                        <label for="post">Status</label><br>
                        <select name="post" id="post" class="form-control">
                            <option>Hidden</option>
                            <option>Published</option>
                        </select>
                    </div>
                    <input style="border-radius: 0" type="submit" name="insert" id="insert" class="btn btn-success" value="Add">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<?php
$minutes_to_add = 9999;

$start_time = date('Y-m-d H:i:s');
$time = new DateTime($start_time);
$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

$stamp = $time->format('Y-m-d H:i:s');
?>
<!--Add Modal Manual-->
<div id="manualQuiz" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Quiz/Exam</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="insert_quiz_manual">
                    <div class="form-group">
                        <input type="text" name="quiz_name" id="quiz_name" class="form-control" placeholder="Name" required>
                        <input type="hidden" name="group_id" value="<?php echo  $group[0]->id;?>">
                    </div>
                    <div class="form-group">
                        <label for="term">Term</label><br>
                        <select name="term" id="term" class="form-control" required>
                            <option value="">--Select Term--</option>
                            <option value="prelim">Prelim</option>
                            <option value="midterm">Midterm</option>
                            <option value="prefinal">Prefinal</option>
                            <option value="finals">Finals</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label><br>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">--Select Type--</option>
                            <option value="quiz">Quiz</option>
                            <option value="exam">Term Exam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="start_time" value="<?php echo $stamp;?>">
                        <label for="end">Time Limit</label><br>
                        <input type="number" class="form-control"  name="limit" required>
                    </div>
                    <div class="form-group">
                        <span><strong>Note:</strong> This will indicate whether to <i>Published</i> or <i>Hide</i> the Exam/Quiz you have created. </span><br>
                        <label for="post">Status</label><br>
                        <select name="post" id="post" class="form-control">
                            <option>Hidden</option>
                            <option>Published</option>
                        </select>
                    </div>
                    <input style="border-radius: 0" type="submit" name="insert" id="insert" class="btn btn-success" value="Add">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Edit Modal Automatic-->
<div id="edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Quiz/Exam</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="edit_quiz">
                    <div class="form-group">
                        <input type="text" name="quiz_name" id="edit-quiz_name" class="form-control" placeholder="Name" required>
                        <input type="hidden" name="group_id" value="<?php echo  $group[0]->id;?>">
                    </div>
                    <div class="form-group">
                        <label for="term">Term</label><br>
                        <select name="term" id="edit-term" class="form-control" required>
                            <option value="">--Select Term--</option>
                            <option value="prelim">Prelim</option>
                            <option value="midterm">Midterm</option>
                            <option value="prefinal">Prefinal</option>
                            <option value="finals">Finals</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label><br>
                        <select name="type" id="edit-type" class="form-control" required>
                            <option value="">--Select Type--</option>
                            <option value="quiz">Quiz</option>
                            <option value="exam">Term Exam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start">Start at</label><br>
                        <input type="hidden" name="present" id="present" value="<?php echo date('Y-m-d H:i:s A')?>">
                        <input type="text" class="form-control" id="edit-start_date" name="start_date" required>
                        <div id="edit-start-error" style="color: red"></div>
                    </div>
                    <div class="form-group">
                        <label for="end">Will end at</label><br>
                        <input type="text" class="form-control" id="edit-limit" name="limit" placeholder="Enter Minutes" required>
                        <div id="edit-end-error" style="color: red"></div>
                    </div>
                    <div class="form-group">
                        <span><strong>Note:</strong> This will indicate whether to <i>Published</i> or <i>Hide</i> the Exam/Quiz you have created. </span><br>
                        <label for="post">Status</label><br>
                        <select name="post" id="edit-post" class="form-control">
                            <option>Hidden</option>
                            <option>Published</option>
                        </select>
                    </div>
                    <input type="hidden" name="quiz_id" id="quiz_id">
                    <input style="border-radius: 0" type="submit" class="btn btn-primary" value="Update">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Delete Modal-->
<div id="delete-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="delete_quiz">
                    <div class="form-group">
                      <h4 style="text-align: center">Are you sure you want to delete this item?</h4>
                    </div>
                    <div class="form-group" style="text-align: center">
                            <input type="hidden" name="group_id" value="<?php echo  $group[0]->id;?>">
                            <input type="hidden" name="id_quiz" id="id_quiz">
                            <input style="border-radius: 0;margin-right: 25px;" type="submit" class="btn btn-danger" value="Delete">
                            <button style="border-radius: 0" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


