<div class="container" style="padding-top: 55px;">
    <div class="grading-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>grading_sheet" class="active-link"><i class="fa fa-table" aria-hidden="true"></i> &nbsp;&nbsp;Grading Sheet</a></li>
        </ul>
    </div>
    <div class="grading-content">
        <div class="grade-header">
            <h4><?php echo $group[0]->subject_name;?></h4>
        </div>
        <div class="row" style="margin-top: 10px"></div>
        <div style="margin: 0 auto">
            <?php if ($this->session->flashdata('participation_error')){ ?>
                <div class="alert alert-danger alert-dismissable " style="width: 450px; margin: 0 auto;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong><?php echo $this->session->flashdata('participation_error');?>
                </div>
            <?php }elseif($this->session->flashdata('participation_success')){?>
                <div class="alert alert-success alert-dismissable" style="width: 450px; margin: 0 auto;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><?php echo $this->session->flashdata('participation_success');?>
                </div>
            <?php }elseif($this->session->flashdata('exam_success')){?>
                <div class="alert alert-success alert-dismissable" style="width: 450px; margin: 0 auto;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><?php echo $this->session->flashdata('exam_success');?>
                </div>
            <?php }elseif($this->session->flashdata('exam_error')){?>
                <div class="alert alert-danger alert-dismissable" style="width: 450px; margin: 0 auto;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Sorry!</strong><?php echo $this->session->flashdata('exam_error');?>
                </div>
            <?php }?>
        </div>
        <div class="grade-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="pill" href="#grades">Final Grade</a></li>
                <li><a data-toggle="tab" href="#prelim">Prelim</a></li>
                <li><a data-toggle="tab" href="#midterm">Midterm</a></li>
                <li><a data-toggle="tab" href="#prefinal">Prefinal</a></li>
                <li><a data-toggle="tab" href="#finals">Finals</a></li>
            </ul>

            <div class="tab-content" style="padding-top: 20px">
                <div id="grades" class="tab-pane fade in active">
                    <?php if ($this->session->userdata('authorization') == 'student'){ ?>
                        <table id="class-grade" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Prelim</th>
                                <th>Midterm</th>
                                <th>Prefinal</th>
                                <th>Finals</th>
                                <th>Final Grade</th>
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($gwa as $grades){ ?>
                                    <?php if ($this->session->userdata('id') == $grades->student_id){ ?>
                                        <tr>
                                            <td><?php echo $this->session->userdata('firstname');?>&nbsp;<?php echo $this->session->userdata('lastname');?></td>
                                            <td><?php echo $grades->prelim;?></td>
                                            <td><?php echo $grades->midterm;?></td>
                                            <td><?php echo $grades->prefinal;?></td>
                                            <td><?php echo $grades->finals;?></td>
                                            <td><?php echo $grades->average;?>/<?php echo $grades->gwa;?></td>
                                            <td><?php echo $grades->remarks?></td>
                                        </tr>
                                    <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php }else{ ?>
                        <table id="class-grade" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Prelim</th>
                                <th>Midterm</th>
                                <th>Prefinal</th>
                                <th>Finals</th>
                                <th>Final Grade</th>
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($gwa as $grades){ ?>
                                <?php foreach ($all_users as $student){ ?>
                                    <?php if ($student->id == $grades->student_id){ ?>
                                        <tr>
                                            <td><?php echo $student->firstname;?>&nbsp;<?php echo $student->lastname;?></td>
                                            <td><?php echo $grades->prelim;?></td>
                                            <td><?php echo $grades->midterm;?></td>
                                            <td><?php echo $grades->prefinal;?></td>
                                            <td><?php echo $grades->finals;?></td>
                                            <td><?php echo $grades->average;?>/<?php echo $grades->gwa;?></td>
                                            <td><?php echo $grades->remarks?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php }?>
                </div>
                <div id="prelim" class="tab-pane fade">
                    <?php if ($this->session->userdata('authorization') == 'student'){ ?>
                        <table id="grade-prelim" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Quiz Score</th>
                                <th>Exam Score</th>
                                <th>Participation</th>
                                <th>Project</th>
                                <th>Average</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($prelim as $grades){ ?>
                                    <?php if ($this->session->userdata('id') == $grades->student_id){ ?>
                                        <tr>
                                            <td><?php echo $this->session->userdata('firstname');?>&nbsp;<?php echo $this->session->userdata('lastname');?></td>
                                            <td><?php echo $grades->quiz;?></td>
                                            <td><?php echo $grades->term_exam;?></td>
                                            <td><?php echo $grades->participation;?></td>
                                            <td><?php echo $grades->project;?></td>
                                            <td><?php echo $grades->average;?></td>
                                        </tr>
                                    <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php }else{ ?>
                        <button style="float: right;border-radius: 0" class="btn btn-primary" data-toggle="modal" data-target="#prelimNumItems">Set No. of Items (Exam)</button>
                        <div class="row" style="margin-bottom: 15px"></div>
                        <table id="grade-prelim" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Quiz</th>
                                <th>Exam</th>
                                <th>Participation</th>
                                <th>Project</th>
                                <th>Average</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><?php echo $prelim[0]->exam_items;?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php foreach ($prelim as $grades){ ?>
                                <?php foreach ($all_users as $student){ ?>
                                    <?php if ($student->id == $grades->student_id){ ?>
                                        <tr>
                                            <td><?php echo $student->firstname;?>&nbsp;<?php echo $student->lastname;?></td>
                                            <td><?php echo $grades->quiz;?></td>
                                            <td><?php echo $grades->term_exam;?></td>
                                            <td><?php echo $grades->participation;?></td>
                                            <td><?php echo $grades->project;?></td>
                                            <td><?php echo $grades->average;?></td>
                                            <td style="text-align: center">
                                                <div class="dropdown">
                                                    <a style="text-decoration: none;color: #0a0a0a;" href="#" class="dropdown-toggle" id="menu1" data-toggle="dropdown">
                                                        <i class="fa fa-cogs" aria-hidden="true"></i>
                                                        &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </a>
                                                    <ul style="border-radius: 0" class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                        <li><a style="font-weight: bold;" href="#" data-toggle="modal" data-target="#prelimParticipaition" class="prelimPart" id="<?php echo $grades->student_id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Participation</a></li>
                                                        <li><a style="font-weight: bold;" href="#" data-toggle="modal" data-target="#prelimExamScore" class="prelimExamScoreStudent" id="<?php echo $grades->student_id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Exam Score</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php }?>
                </div>
                <div id="midterm" class="tab-pane fade">
                    <?php if ($this->session->userdata('authorization') == 'student'){ ?>
                        <table id="grade-midterm" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Quiz Score</th>
                                <th>Exam Score</th>
                                <th>Participation</th>
                                <th>Project</th>
                                <th>Average</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($midterm as $grades){ ?>
                                    <?php if ($this->session->userdata('id') == $grades->student_id){ ?>
                                        <tr>
                                            <td><?php echo $this->session->userdata('firstname');?>&nbsp;<?php echo $this->session->userdata('lastname');?></td>
                                            <td><?php echo $grades->quiz;?></td>
                                            <td><?php echo $grades->term_exam;?></td>
                                            <td><?php echo $grades->participation;?></td>
                                            <td><?php echo $grades->project;?></td>
                                            <td><?php echo $grades->average;?></td>
                                        </tr>
                                    <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php }else{ ?>
                        <button style="float: right;border-radius: 0" class="btn btn-primary" data-toggle="modal" data-target="#midtermNumItems">Set No. of Items (Exam)</button>
                        <div class="row" style="margin-bottom: 15px"></div>
                        <table id="grade-midterm" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Quiz Score</th>
                                <th>Exam Score</th>
                                <th>Participation</th>
                                <th>Project</th>
                                <th>Average</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><?php echo $midterm[0]->exam_items;?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php foreach ($midterm as $grades){ ?>
                                <?php foreach ($all_users as $student){ ?>
                                    <?php if ($student->id == $grades->student_id){ ?>
                                        <tr>
                                            <td><?php echo $student->firstname;?>&nbsp;<?php echo $student->lastname;?></td>
                                            <td><?php echo $grades->quiz;?></td>
                                            <td><?php echo $grades->term_exam;?></td>
                                            <td><?php echo $grades->participation;?></td>
                                            <td><?php echo $grades->project;?></td>
                                            <td><?php echo $grades->average;?></td>
                                            <td style="text-align: center">
                                                <div class="dropdown">
                                                    <a style="text-decoration: none;color: #0a0a0a;" href="#" class="dropdown-toggle" id="menu1" data-toggle="dropdown">
                                                        <i class="fa fa-cogs" aria-hidden="true"></i>
                                                        &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </a>
                                                    <ul style="border-radius: 0" class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                        <li><a style="font-weight: bold;" href="#" data-toggle="modal" data-target="#midtermParticipaition" class="midtermPart" id="<?php echo $grades->student_id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Participation</a></li>
                                                        <li><a style="font-weight: bold;" href="#" data-toggle="modal" data-target="#midtermExamScore" class="midtermExamScoreStudent" id="<?php echo $grades->student_id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Exam Score</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php }?>
                </div>
                <div id="prefinal" class="tab-pane fade">
                    <?php if ($this->session->userdata('authorization') == 'student'){ ?>
                        <table id="grade-prefinal" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Quiz Score</th>
                                <th>Exam Score</th>
                                <th>Participation</th>
                                <th>Project</th>
                                <th>Average</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($prefinal as $grades){ ?>
                                    <?php if ($this->session->userdata('id') == $grades->student_id){ ?>
                                        <tr>
                                            <td><?php echo $this->session->userdata('firstname');?>&nbsp;<?php echo $this->session->userdata('lastname');?></td>
                                            <td><?php echo $grades->quiz;?></td>
                                            <td><?php echo $grades->term_exam;?></td>
                                            <td><?php echo $grades->participation;?></td>
                                            <td><?php echo $grades->project;?></td>
                                            <td><?php echo $grades->average;?></td>
                                        </tr>
                                    <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php }else{ ?>
                        <button style="float: right;border-radius: 0" class="btn btn-primary" data-toggle="modal" data-target="#prefinalNumItems">Set No. of Items (Exam)</button>
                        <div class="row" style="margin-bottom: 15px"></div>
                        <table id="grade-prefinal" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Quiz Score</th>
                                <th>Exam Score</th>
                                <th>Participation</th>
                                <th>Project</th>
                                <th>Average</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><?php echo $prefinal[0]->exam_items;?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php foreach ($prefinal as $grades){ ?>
                                <?php foreach ($all_users as $student){ ?>
                                    <?php if ($student->id == $grades->student_id){ ?>
                                        <tr>
                                            <td><?php echo $student->firstname;?>&nbsp;<?php echo $student->lastname;?></td>
                                            <td><?php echo $grades->quiz;?></td>
                                            <td><?php echo $grades->term_exam;?></td>
                                            <td><?php echo $grades->participation;?></td>
                                            <td><?php echo $grades->project;?></td>
                                            <td><?php echo $grades->average;?></td>
                                            <td style="text-align: center">
                                                <div class="dropdown">
                                                    <a style="text-decoration: none;color: #0a0a0a;" href="#" class="dropdown-toggle" id="menu1" data-toggle="dropdown">
                                                        <i class="fa fa-cogs" aria-hidden="true"></i>
                                                        &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </a>
                                                    <ul style="border-radius: 0" class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                        <li><a style="font-weight: bold;" href="#" data-toggle="modal" data-target="#prefinalParticipaition" class="prefinalPart" id="<?php echo $grades->student_id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Participation</a></li>
                                                        <li><a style="font-weight: bold;" href="#" data-toggle="modal" data-target="#prefinalExamScore" class="prefinalExamScoreStudent" id="<?php echo $grades->student_id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Exam Score</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php }?>
                </div>
                <div id="finals" class="tab-pane fade">
                    <?php if ($this->session->userdata('authorization') == 'student'){ ?>
                        <table id="grade-finals" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Quiz Score</th>
                                <th>Exam Score</th>
                                <th>Participation</th>
                                <th>Project</th>
                                <th>Average</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($finals as $grades){ ?>
                                    <?php if ($this->session->userdata('id') == $grades->student_id){ ?>
                                        <tr>
                                            <td><?php echo $this->session->userdata('firstname');?>&nbsp;<?php echo $this->session->userdata('lastname');?></td>
                                            <td><?php echo $grades->quiz;?></td>
                                            <td><?php echo $grades->term_exam;?></td>
                                            <td><?php echo $grades->participation;?></td>
                                            <td><?php echo $grades->project;?></td>
                                            <td><?php echo $grades->average;?></td>
                                        </tr>
                                    <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php }else{ ?>
                        <button style="float: right;border-radius: 0" class="btn btn-primary" data-toggle="modal" data-target="#finalsNumItems">Set No. of Items (Exam)</button>
                        <div class="row" style="margin-bottom: 15px"></div>
                        <table id="grade-finals" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                            <thead>
                            <tr>
                                <th>Student</th>
                                <th>Quiz Score</th>
                                <th>Exam Score</th>
                                <th>Participation</th>
                                <th>Project</th>
                                <th>Average</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><?php echo $finals[0]->exam_items;?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php foreach ($finals as $grades){ ?>
                                <?php foreach ($all_users as $student){ ?>
                                    <?php if ($student->id == $grades->student_id){ ?>
                                        <tr>
                                            <td><?php echo $student->firstname;?>&nbsp;<?php echo $student->lastname;?></td>
                                            <td><?php echo $grades->quiz;?></td>
                                            <td><?php echo $grades->term_exam;?></td>
                                            <td><?php echo $grades->participation;?></td>
                                            <td><?php echo $grades->project;?></td>
                                            <td><?php echo $grades->average;?></td>
                                            <td style="text-align: center">
                                                <div class="dropdown">
                                                    <a style="text-decoration: none;color: #0a0a0a;" href="#" class="dropdown-toggle" id="menu1" data-toggle="dropdown">
                                                        <i class="fa fa-cogs" aria-hidden="true"></i>
                                                        &nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
                                                    </a>
                                                    <ul style="border-radius: 0" class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                        <li><a style="font-weight: bold;" href="#" data-toggle="modal" data-target="#finalsParticipaition" class="finalsPart" id="<?php echo $grades->student_id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Participation</a></li>
                                                        <li><a style="font-weight: bold;" href="#" data-toggle="modal" data-target="#finalsExamScore" class="finalsExamScoreStudent" id="<?php echo $grades->student_id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Exam Score</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>

<!-- Prelim Participation-->
<div id="prelimParticipaition" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Prelim Participation</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="part-prelim">
                    <div class="form-group">
                        <input type="hidden" name="studentId" id="std_ID">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="participation-prelim" id="participation-prelim" class="form-control" placeholder="Remarks">
                        <div><i id="partPrelim-error" style="color: red"></i></div>
                    </div>
                    <input type="submit" class="btn btn-success" id="midterm-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Midterm Participation-->
<div id="midtermParticipaition" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Midterm Participation</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="part-midterm">
                    <div class="form-group">
                        <input type="hidden" name="studentId" id="std_Id">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="participation-midterm" id="participation-midterm" class="form-control" placeholder="Remarks">
                        <div><i id="partMidterm-error" style="color: red"></i></div>
                    </div>
                    <input type="submit" class="btn btn-success" id="midterm-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Prefinal Participation-->
<div id="prefinalParticipaition" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Prefinal Participation</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="part-prefinal">
                    <div class="form-group">
                        <input type="hidden" name="studentId" id="stdId">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="participation-prefinal" id="participation-prefinal" class="form-control" placeholder="Remarks">
                        <div><i id="partPrefinal-error" style="color: red"></i></div>
                    </div>
                    <input type="submit" class="btn btn-success" id="midterm-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Finals Participation-->
<div id="finalsParticipaition" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Finals Participation</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="part-finals">
                    <div class="form-group">
                        <input type="hidden" name="studentId" id="stdID">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="participation-finals" id="participation-finals" class="form-control" placeholder="Remarks">
                        <div><i id="partFinals-error" style="color: red"></i></div>
                    </div>
                    <input type="submit" class="btn btn-success" id="midterm-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!-- Prelim Number of Items in Exam-->
<div id="prelimNumItems" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Number of Items (Prelim Exam)</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>grading_sheet/prelimNumItems" method="post">
                    <div class="form-group">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="numitems-prelim" id="numitems-prelim" class="form-control" placeholder="Number of Items">
                    </div>
                    <input type="submit" class="btn btn-success" id="midterm-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Midterm Number of Items in Exam-->
<div id="midtermNumItems" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Number of Items (Midterm Exam) </h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>grading_sheet/midtermNumItems" method="post">
                    <div class="form-group">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="numitems-midterm" id="numitems-midterm" class="form-control" placeholder="Number of Items">
                    </div>
                    <input type="submit" class="btn btn-success" id="midterm-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Prefinal Number of Items in Exam-->
<div id="prefinalNumItems" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Number of Items (Prefinal Exam) </h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>grading_sheet/prefinalNumItems" method="post">
                    <div class="form-group">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="numitems-prefinal" id="numitems-prefinal" class="form-control" placeholder="Number of Items">
                    </div>
                    <input type="submit" class="btn btn-success" id="prefinal-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Finals Number of Items in Exam-->
<div id="finalsNumItems" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Number of Items (Finals Exam) </h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url();?>grading_sheet/finalsNumItems" method="post">
                    <div class="form-group">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="numitems-finals" id="numitems-finals" class="form-control" placeholder="Number of Items">
                    </div>
                    <input type="submit" class="btn btn-success" id="finals-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Prelim Exam Score Manual-->
<div id="prelimExamScore" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Prelim Exam Score(<?php echo $prelim[0]->exam_items;?>&nbsp;items)</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="prelim-exam-score" >
                    <div class="form-group">
                        <input type="hidden" id="prelim-totalitems" value="<?php echo $prelim[0]->exam_items;?>">
                        <input type="hidden" name="studentId" id="std-exam-prelim">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="exam_prelim-score" id="exam_prelim-score" class="form-control" placeholder="Score">
                        <div><i id="exam-div-score" style="color: red"></i></div>
                    </div>
                    <input type="submit" class="btn btn-success" id="midterm-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Midterm Exam Score Manual-->
<div id="midtermExamScore" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Midterm Exam Score(<?php echo $midterm[0]->exam_items;?>&nbsp;items)</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="midterm-exam-score" >
                    <div class="form-group">
                        <input type="hidden" id="midterm-totalitems" value="<?php echo $midterm[0]->exam_items;?>">
                        <input type="hidden" name="studentId" id="std-exam-midterm">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="exam_midterm-score" id="exam_midterm-score" class="form-control" placeholder="Score">
                        <div><i id="exam-div-score-mid" style="color: red"></i></div>
                    </div>
                    <input type="submit" class="btn btn-success" id="midterm-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Prefinal Exam Score Manual-->
<div id="prefinalExamScore" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Prefinal Exam Score(<?php echo $prefinal[0]->exam_items;?>&nbsp;items)</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="prefinal-exam-score" >
                    <div class="form-group">
                        <input type="hidden" id="prefinal-totalitems" value="<?php echo $prefinal[0]->exam_items;?>">
                        <input type="hidden" name="studentId" id="std-exam-prefinal">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="exam_prefinal-score" id="exam_prefinal-score" class="form-control" placeholder="Score">
                        <div><i id="exam-div-score-pre" style="color: red"></i></div>
                    </div>
                    <input type="submit" class="btn btn-success" id="midterm-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!-- Finals Exam Score Manual-->
<div id="finalsExamScore" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Finals Exam Score(<?php echo $finals[0]->exam_items;?>&nbsp;items)</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="finals-exam-score" >
                    <div class="form-group">
                        <input type="hidden" id="finals-totalitems" value="<?php echo $finals[0]->exam_items;?>">
                        <input type="hidden" name="studentId" id="std-exam-finals">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="exam_finals-score" id="exam_finals-score" class="form-control" placeholder="Score">
                        <div><i id="exam-div-score-finals" style="color: red"></i></div>
                    </div>
                    <input type="submit" class="btn btn-success" id="midterm-btn" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
