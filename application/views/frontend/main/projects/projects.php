<div class="container" style="padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_library?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/book library.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Library</a></li>
            <li>
                <span class="notify-badge"  style="z-index: 1000;position: absolute;margin-left: -5px"><?php if ($count_notify_chat == null){ }else{ ?><span class="label label-danger"><?php echo $count_notify_chat; ?></span><?php } ?></span>
                <a class="group-chat-count" id="<?php echo $group[0]->id;?>" href="<?php echo site_url()?>class_group/class_discussion?id=<?php echo $group[0]->id;?>"><img src="<?php echo base_url()?>assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20"> &nbsp;&nbsp;Class Discussion</a>
            </li>
            <li><a href="<?php echo site_url()?>class_group/quizAndExam?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/icon_045780_256.png" alt="" width="20" height="20"> &nbsp;&nbsp;Quizzes & Exams</a></li>
            <li><a href="<?php echo site_url()?>class_group/projects?id=<?php echo $group[0]->id;?>" class="active-link"><img src="<?php echo base_url()?>assets/frontend/images/project.png" alt="" width="20" height="20"> &nbsp;&nbsp;Projects</a></li>
            <li><a href="<?php echo site_url()?>class_group/video_tutorial?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/download.png" alt="" width="20" height="20"> &nbsp;&nbsp;Video Tutorial</a></li>
            <li><a href="<?php echo site_url()?>class_group/members?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/member.png" alt="" width="20" height="20"> &nbsp;&nbsp;Members</a></li>
        </ul>
        <div class="row clearfix"></div>
<!--        <div class="access-code"></div>-->
    </div>
    <div class="wall-content">
        <div class="grade-header">
            <h4>Projects</h4>
        </div>
        <div class="tabs" style="margin: 20px 20px 0 20px;">
            <ul class="nav nav-tabs" >
                <li class="active"><a data-toggle="tab" href="#prelim">Prelim</a></li>
                <li><a data-toggle="tab" href="#midterm">Midterm</a></li>
                <li><a data-toggle="tab" href="#prefinal">Prefinal</a></li>
                <li><a data-toggle="tab" href="#finals">Finals</a></li>
            </ul>
            <div class="tab-content">
                <div id="prelim" class="tab-pane fade in active" style="padding-top: 20px;">
                    <?php if ($this->session->flashdata('error')){ ?>
                        <div class="alert alert-danger alert-dismissable " style="width: 450px; margin: 0 auto;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Sorry!</strong><?php echo $this->session->flashdata('error');?>
                        </div>
                    <?php }elseif ($this->session->flashdata('uploaded')){ ?>
                        <div class="alert alert-success alert-dismissable" style="width: 450px; margin: 0 auto;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong><?php echo $this->session->flashdata('uploaded');?>
                        </div>
                    <?php }elseif ($this->session->flashdata('project_success')){ ?>
                        <div class="alert alert-success alert-dismissable" style="width: 450px; margin: 0 auto;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong><?php echo $this->session->flashdata('project_success');?>
                        </div>
                    <?php }elseif ($this->session->flashdata('project_error')){ ?>
                        <div class="alert alert-danger alert-dismissable" style="width: 450px; margin: 0 auto;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Sorry!</strong><?php echo $this->session->flashdata('project_error');?>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
                        <button style="float: right;border-radius: 0;" class="btn btn-info prelimDeadline" data-toggle="modal" data-target="#prelimDeadline" id="<?php echo $group[0]->id;?>">Set Deadline</button>
                        <input type="text" class="form-control search-prelim-project" id="<?php echo $group[0]->id;?>" style="width: 200px;margin: 0 20px 20px 15px;position: relative;" placeholder="Search Lastname">
                        <div class="row"></div>
                        <div class="col-md-12">
                            <span style="font-size: 16px;font-weight: bold;">Deadline :</span>
                        <?php if ($deadline == null){?>
                            <span style="font-size: 15px;color: grey">Not set</span>
                        <?php }else{?>
                            <?php foreach ($deadline as $time){?>
                                <?php
                                $set_time = date_create($time->deadline);
                                ?>
                                <?php if ($time->term == 'prelim'){ ?>
                                    <?php if ($time->deadline < date('Y-m-d H:i:s')){ ?>
                                        <span style="font-size: 15px;color: grey">Expired</span>
                                    <?php }elseif($time->deadline == '' && $time->term == 'prelim'){ ?>
                                        <span style="font-size: 15px;color: grey">Not set</span>
                                    <?php }else{ ?>
                                        <span style="font-size: 15px;color: grey"><?php echo date_format($set_time,'M d, Y h:i A');?></span>
                                    <?php }?>
                                <?php }?>

                            <?php }?>
                        <?php }?>
                        </div>
                        <div class="row"></div>
                        <div id="project-prelim-result">
                    <?php foreach ($all_users as $student): ?>
                        <?php foreach ($students as $data): ?>
                            <?php if ($data->student_id == $student->id){ ?>
                                <?php foreach ($projects as $pro):?>
                                <?php foreach ($prelim as $remarks):?>
                                    <?php if ($remarks->student_id == $student->id){ ?>
                                <?php if ($pro->student_id == $student->id){ ?>

                        <div class="quiz-list row" >
                                <div class="col-md-6">
                                    <span style="color: black;font-weight: bold;"><?php echo $student->lastname;?>,&nbsp;<?php echo $student->firstname;?></span>
                                </div>
                                <div class="col-md-4">
                                    <?php if ($pro->prelim == null){ ?>
                                        <span>No project</span>
                                    <?php }else{ ?>
                                        <span><a href="<?php echo base_url()?>uploads/projects/<?php echo $pro->prelim;?>" download="<?php echo $pro->prelim;?>"><?php echo $pro->prelim;?></a></span>
                                    <?php } ?>
                                </div>
                                <div class="col-md-2">
                                    <span style="font-weight: bold"><?php echo $remarks->project?></span>
                                    <div class="q-settings dropdown">
                                        <a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>
                                            <ul class="dropdown-menu">
                                                <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#prelimRemarks" class="prelimProject" id="<?php echo $student->id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>
                                            </ul>
                                        </a>
                                    </div>
                                </div>
                        </div>

                                <?php } ?>
                                <?php } ?>
                                <?php endforeach; ?>
                                <?php endforeach;?>
                            <?php } ?>
                        <?php endforeach; ?>
                    <?php endforeach;?>
                        </div>
                    <?php }else{?>
                        <div class="row"></div>
                        <div class="col-md-12">
                            <span style="font-size: 16px;font-weight: bold;">Deadline :</span>
                            <?php if ($deadline == null){?>
                                <span style="font-size: 15px;color: grey">Not set</span>
                            <?php }else{?>
                                <?php foreach ($deadline as $time){?>
                                    <?php
                                    $set_time = date_create($time->deadline);
                                    ?>
                                    <?php if ($time->term == 'prelim'){ ?>
                                        <?php if ($time->deadline < date('Y-m-d H:i:s')){ ?>
                                            <span style="font-size: 15px;color: grey">Expired</span>
                                        <?php }elseif($time->deadline == '' && $time->term == 'prelim'){ ?>
                                            <span style="font-size: 15px;color: grey">Not set</span>
                                        <?php }else{ ?>
                                            <span style="font-size: 15px;color: grey"><?php echo date_format($set_time,'M d, Y h:i A');?></span>
                                        <?php }?>
                                    <?php }?>

                                <?php }?>
                            <?php }?>
                        </div>
                        <div class="row"></div>
                        <div class="quiz-list row">
                            <?php foreach ($projects as $pro): ?>
                            <?php if ($pro->student_id == $this->session->userdata('id')){ ?>
                                <?php if ($pro->prelim == null){ ?>
                                    <span>No Project</span>
                                <?php }else{ ?>
                                    <span><?php echo $pro->prelim;?></span>
                            <?php } }?>
                            <?php endforeach; ?>
                            <div class="row" style="margin-bottom: 30px"></div>
                            <?php if ($deadline == null){ ?>
                            <?php }else{?>
                                <?php foreach ($deadline as $time){ ?>
                                    <?php if ($time->term == 'prelim'){ ?>
                                        <?php $time_limit = $time->deadline; ?>
                                    <?php }?>
                                <?php }?>
                                <?php if ($time_limit < date('Y-m-d H:i:s')){ ?>
                                    <div class="col-md-12">
                                        <h4>Sorry! Times Up. </h4>
                                    </div>
                                <?php }else{ ?>
                                    <form action="<?php echo site_url()?>class_group/uploadPrelimProject" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="group_id" value="<?php echo $group[0]->id;?>">
                                        <input type="hidden" name="student_id" value="<?php echo $this->session->userdata('id');?>">
                                        <div class="form-group">
                                            <input type="file" name="userfile" class="btn btn-info" size="20" style="border-radius: 0">
                                        </div>
                                        <input style="border-radius: 0" type="submit" class="btn btn-default" value="Upload" />
                                    </form>
                                <?php } ?>
                            <?php }?>

                        </div>
                    <?php } ?>
                </div>
                <div id="midterm" class="tab-pane fade" style="padding-top: 20px;">
                    <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
                        <button style="float: right;border-radius: 0;" class="btn btn-info midtermDeadline" data-toggle="modal" data-target="#midtermDeadline" id="<?php echo $group[0]->id;?>">Set Deadline</button>
                        <input type="text" class="form-control search-midterm-project" id="<?php echo $group[0]->id;?>" style="width: 200px;margin: 0 20px 20px 15px;position: relative;" placeholder="Search Lastname">
                        <div class="row"></div>
                        <div class="col-md-12">
                            <span style="font-size: 16px;font-weight: bold;">Deadline :</span>
                            <?php if ($deadline == null){?>
                                <span style="font-size: 15px;color: grey">Not set</span>
                            <?php }else{?>
                                <?php foreach ($deadline as $time){?>
                                    <?php
                                    $set_time = date_create($time->deadline);
                                    ?>
                                    <?php if ($time->term == 'midterm'){ ?>
                                        <?php if ($time->deadline < date('Y-m-d H:i:s')){ ?>
                                            <span style="font-size: 15px;color: grey">Expired</span>
                                        <?php }elseif($time->deadline == '' && $time->term == 'midterm'){ ?>
                                            <span style="font-size: 15px;color: grey">Not set</span>
                                        <?php }else{ ?>
                                            <span style="font-size: 15px;color: grey"><?php echo date_format($set_time,'M d, Y h:i A');?></span>
                                        <?php }?>
                                    <?php }?>

                                <?php }?>
                            <?php }?>
                        </div>
                        <div class="row"></div>

                        <div id="project-midterm-result">
                        <?php foreach ($all_users as $student): ?>
                            <?php foreach ($students as $data): ?>
                            <?php if ($data->student_id == $student->id){ ?>
                                <?php foreach ($projects as $pro):?>
                                    <?php foreach ($midterm as $remarks):?>
                                        <?php if ($remarks->student_id == $student->id){ ?>
                                            <?php if ($pro->student_id == $student->id){ ?>
                                                <div class="quiz-list row">
                                                    <div class="col-md-6">
                                                        <span style="color: black;font-weight: bold;"><?php echo $student->lastname;?>,&nbsp;<?php echo $student->firstname;?></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <?php if ($pro->midterm == null){ ?>
                                                            <span>No project</span>
                                                        <?php }else{ ?>
                                                            <span><a href="<?php echo base_url()?>uploads/projects/<?php echo $pro->midterm;?>" download="<?php echo $pro->midterm;?>"><?php echo $pro->midterm;?></a></span>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <span style="font-weight: bold"><?php echo $remarks->project?></span>
                                                        <div class="q-settings dropdown">
                                                            <a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>
                                                                <ul class="dropdown-menu">
                                                                    <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#midtermRemarks" class="midtermProject" id="<?php echo $student->id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>
                                                                </ul>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                <?php endforeach;?>
                            <?php } ?>
                        <?php endforeach; ?>
                    <?php endforeach;?>
                    </div>
                    <?php }else{ ?>
                        <div class="row"></div>
                        <div class="col-md-12">
                            <span style="font-size: 16px;font-weight: bold;">Deadline :</span>
                            <?php if ($deadline == null){?>
                                <span style="font-size: 15px;color: grey">Not set</span>
                            <?php }else{?>
                                <?php foreach ($deadline as $time){?>
                                    <?php
                                    $set_time = date_create($time->deadline);
                                    ?>
                                    <?php if ($time->term == 'midterm'){ ?>
                                        <?php if ($time->deadline < date('Y-m-d H:i:s')){ ?>
                                            <span style="font-size: 15px;color: grey">Expired</span>
                                        <?php }elseif($time->deadline == '' && $time->term == 'prelim'){ ?>
                                            <span style="font-size: 15px;color: grey">Not set</span>
                                        <?php }else{ ?>
                                            <span style="font-size: 15px;color: grey"><?php echo date_format($set_time,'M d, Y h:i A');?></span>
                                        <?php }?>
                                    <?php }?>

                                <?php }?>
                            <?php }?>
                        </div>
                        <div class="row"></div>
                        <div class="quiz-list row">
                            <?php foreach ($projects as $pro): ?>
                                <?php if ($pro->student_id == $this->session->userdata('id')){ ?>
                                    <?php if ($pro->midterm == null){ ?>
                                        <span>No Project</span>
                                    <?php }else{ ?>
                                        <span><?php echo $pro->midterm;?></span>
                                    <?php } }?>
                            <?php endforeach; ?>

                            <?php if ($deadline == null){ ?>
                            <?php }else{?>
                                <?php foreach ($deadline as $time){ ?>
                                    <?php if ($time->term == 'midterm'){ ?>
                                        <?php $time_limit = $time->deadline; ?>
                                    <?php }?>
                                <?php }?>
                                <?php if ($time_limit < date('Y-m-d H:i:s')){ ?>
                                    <div class="col-md-12">
                                        <h4>Sorry! Times Up. </h4>
                                    </div>
                                <?php }else{ ?>
                                    <form action="<?php echo site_url()?>class_group/uploadMidtermProject" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="group_id" value="<?php echo $group[0]->id;?>">
                                        <input type="hidden" name="student_id" value="<?php echo $this->session->userdata('id');?>">
                                        <div class="form-group">
                                            <input type="file" name="userfile" class="btn btn-info" size="20" style="border-radius: 0">
                                        </div>
                                        <input style="border-radius: 0" type="submit" class="btn btn-default" value="Upload" />
                                    </form>
                                <?php }?>
                            <?php }?>
                        </div>
                    <?php }?>
                </div>
                <div id="prefinal" class="tab-pane fade" style="padding-top: 20px;">
                    <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
                        <button style="float: right;border-radius: 0;" class="btn btn-info prefinalDeadline" data-toggle="modal" data-target="#prefinalDeadline" id="<?php echo $group[0]->id;?>">Set Deadline</button>
                        <input type="text" class="form-control search-prefinal-project" id="<?php echo $group[0]->id;?>" style="width: 200px;margin: 0 20px 20px 15px;position: relative;" placeholder="Search Lastname">
                        <div class="row"></div>
                        <div class="col-md-12">
                            <span style="font-size: 16px;font-weight: bold;">Deadline :</span>
                            <?php if ($deadline == null){?>
                                <span style="font-size: 15px;color: grey">Not set</span>
                            <?php }else{?>
                                <?php foreach ($deadline as $time){?>
                                    <?php
                                    $set_time = date_create($time->deadline);
                                    ?>
                                    <?php if ($time->term == 'prefinal'){ ?>
                                        <?php if ($time->deadline < date('Y-m-d H:i:s')){ ?>
                                            <span style="font-size: 15px;color: grey">Expired</span>
                                        <?php }elseif($time->deadline == '' && $time->term == 'prefinal'){ ?>
                                            <span style="font-size: 15px;color: grey">Not set</span>
                                        <?php }else{ ?>
                                            <span style="font-size: 15px;color: grey"><?php echo date_format($set_time,'M d, Y h:i A');?></span>
                                        <?php }?>
                                    <?php }?>

                                <?php }?>
                            <?php }?>
                        </div>
                        <div class="row"></div>

                        <div id="project-prefinal-result">
                        <?php foreach ($all_users as $student): ?>
                            <?php foreach ($students as $data): ?>
                            <?php if ($data->student_id == $student->id){ ?>
                                <?php foreach ($projects as $pro):?>
                                    <?php foreach ($prefinal as $remarks):?>
                                        <?php if ($remarks->student_id == $student->id){ ?>
                                            <?php if ($pro->student_id == $student->id){ ?>
                                                <div class="quiz-list row">
                                                    <div class="col-md-6">
                                                        <span style="color: black;font-weight: bold;"><?php echo $student->lastname;?>,&nbsp;<?php echo $student->firstname;?></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <?php if ($pro->prefinal == null){ ?>
                                                            <span>No project</span>
                                                        <?php }else{ ?>
                                                            <span><a href="<?php echo base_url()?>uploads/projects/<?php echo $pro->prefinal;?>" download="<?php echo $pro->prefinal;?>"><?php echo $pro->prefinal;?></a></span>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <span style="font-weight: bold"><?php echo $remarks->project?></span>
                                                        <div class="q-settings dropdown">
                                                            <a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>
                                                                <ul class="dropdown-menu">
                                                                    <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#prefinalRemarks" class="prefinalProject" id="<?php echo $student->id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>
                                                                </ul>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                <?php endforeach;?>
                            <?php } ?>
                        <?php endforeach; ?>
                    <?php endforeach;?>
                    </div>
                    <?php }else{ ?>
                        <div class="row"></div>
                        <div class="col-md-12">
                            <span style="font-size: 16px;font-weight: bold;">Deadline :</span>
                            <?php if ($deadline == null){?>
                                <span style="font-size: 15px;color: grey">Not set</span>
                            <?php }else{?>
                                <?php foreach ($deadline as $time){?>
                                    <?php
                                    $set_time = date_create($time->deadline);
                                    ?>
                                    <?php if ($time->term == 'prefinal'){ ?>
                                        <?php if ($time->deadline < date('Y-m-d H:i:s')){ ?>
                                            <span style="font-size: 15px;color: grey">Expired</span>
                                        <?php }elseif($time->deadline == '' && $time->term == 'prelim'){ ?>
                                            <span style="font-size: 15px;color: grey">Not set</span>
                                        <?php }else{ ?>
                                            <span style="font-size: 15px;color: grey"><?php echo date_format($set_time,'M d, Y h:i A');?></span>
                                        <?php }?>
                                    <?php }?>

                                <?php }?>
                            <?php }?>
                        </div>
                        <div class="row"></div>

                        <div class="quiz-list row">
                            <?php foreach ($projects as $pro): ?>
                                <?php if ($pro->student_id == $this->session->userdata('id')){ ?>
                                    <?php if ($pro->prefinal == null){ ?>
                                        <span>No Project</span>
                                    <?php }else{ ?>
                                        <span><?php echo $pro->prefinal;?></span>
                                    <?php } }?>
                            <?php endforeach; ?>

                            <?php if ($deadline == null){ ?>
                            <?php }else{?>
                                <?php foreach ($deadline as $time){ ?>
                                    <?php if ($time->term == 'prefinal'){ ?>
                                        <?php $time_limit = $time->deadline; ?>
                                    <?php }?>
                                <?php }?>
                                <?php if ($time_limit < date('Y-m-d H:i:s')){ ?>
                                    <div class="col-md-12">
                                        <h4>Sorry! Times Up. </h4>
                                    </div>
                                <?php }else{ ?>
                                    <form action="<?php echo site_url()?>class_group/uploadPrefinalProject" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="group_id" value="<?php echo $group[0]->id;?>">
                                        <input type="hidden" name="student_id" value="<?php echo $this->session->userdata('id');?>">
                                        <div class="form-group">
                                            <input type="file" name="userfile" class="btn btn-info" size="20" style="border-radius: 0">
                                        </div>
                                        <input style="border-radius: 0" type="submit" class="btn btn-default" value="Upload" />
                                    </form>
                                <?php } ?>
                            <?php }?>
                        </div>
                    <?php } ?>
                </div>
                <div id="finals" class="tab-pane fade" style="padding-top: 20px;">
                    <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
                        <button style="float: right;border-radius: 0;" class="btn btn-info finalsDeadline" data-toggle="modal" data-target="#finalsDeadline" id="<?php echo $group[0]->id;?>">Set Deadline</button>
                        <input type="text" class="form-control search-finals-project" id="<?php echo $group[0]->id;?>" style="width: 200px;margin: 0 20px 20px 15px;position: relative;" placeholder="Search Lastname">
                        <div class="row"></div>
                        <div class="col-md-12">
                            <span style="font-size: 16px;font-weight: bold;">Deadline :</span>
                            <?php if ($deadline == null){?>
                                <span style="font-size: 15px;color: grey">Not set</span>
                            <?php }else{?>
                                <?php foreach ($deadline as $time){?>
                                    <?php
                                    $set_time = date_create($time->deadline);
                                    ?>
                                    <?php if ($time->term == 'finals'){ ?>
                                        <?php if ($time->deadline < date('Y-m-d H:i:s')){ ?>
                                            <span style="font-size: 15px;color: grey">Expired</span>
                                        <?php }elseif($time->deadline == '' && $time->term == 'finals'){ ?>
                                            <span style="font-size: 15px;color: grey">Not set</span>
                                        <?php }else{ ?>
                                            <span style="font-size: 15px;color: grey"><?php echo date_format($set_time,'M d, Y h:i A');?></span>
                                        <?php }?>
                                    <?php }?>

                                <?php }?>
                            <?php }?>
                        </div>
                        <div class="row"></div>

                        <div id="project-finals-result">
                        <?php foreach ($all_users as $student): ?>
                            <?php foreach ($students as $data): ?>
                            <?php if ($data->student_id == $student->id){ ?>
                                <?php foreach ($projects as $pro):?>
                                    <?php foreach ($finals as $remarks):?>
                                        <?php if ($remarks->student_id == $student->id){ ?>
                                            <?php if ($pro->student_id == $student->id){ ?>
                                                <div class="quiz-list row">
                                                    <div class="col-md-6">
                                                        <span style="color: black;font-weight: bold;"><?php echo $student->lastname;?>,&nbsp;<?php echo $student->firstname;?></span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <?php if ($pro->finals == null){ ?>
                                                            <span>No project</span>
                                                        <?php }else{ ?>
                                                            <span><a href="<?php echo base_url()?>uploads/projects/<?php echo $pro->finals;?>" download="<?php echo $pro->finals;?>"><?php echo $pro->finals;?></a></span>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <span style="font-weight: bold"><?php echo $remarks->project?></span>
                                                        <div class="q-settings dropdown">
                                                            <a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>
                                                                <ul class="dropdown-menu">
                                                                    <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#finalsRemarks" class="finalsProject" id="<?php echo $student->id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>
                                                                </ul>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                <?php endforeach;?>
                            <?php } ?>
                        <?php endforeach; ?>
                    <?php endforeach;?>
                    </div>
                    <?php }else{ ?>

                        <div class="row"></div>
                        <div class="col-md-12">
                            <span style="font-size: 16px;font-weight: bold;">Deadline :</span>
                            <?php if ($deadline == null){?>
                                <span style="font-size: 15px;color: grey">Not set</span>
                            <?php }else{?>
                                <?php foreach ($deadline as $time){?>
                                    <?php
                                    $set_time = date_create($time->deadline);
                                    ?>
                                    <?php if ($time->term == 'finals'){ ?>
                                        <?php if ($time->deadline < date('Y-m-d H:i:s')){ ?>
                                            <span style="font-size: 15px;color: grey">Expired</span>
                                        <?php }elseif($time->deadline == '' && $time->term == 'prelim'){ ?>
                                            <span style="font-size: 15px;color: grey">Not set</span>
                                        <?php }else{ ?>
                                            <span style="font-size: 15px;color: grey"><?php echo date_format($set_time,'M d, Y h:i A');?></span>
                                        <?php }?>
                                    <?php }?>

                                <?php }?>
                            <?php }?>
                        </div>
                        <div class="row"></div>

                        <div class="quiz-list row">
                            <?php foreach ($projects as $pro): ?>
                                <?php if ($pro->student_id == $this->session->userdata('id')){ ?>
                                    <?php if ($pro->finals == null){ ?>
                                        <span>No Project</span>
                                    <?php }else{ ?>
                                        <span><?php echo $pro->finals;?></span>
                                    <?php } }?>
                            <?php endforeach; ?>

                            <?php if ($deadline == null){ ?>
                            <?php }else{?>
                                <?php foreach ($deadline as $time){ ?>
                                    <?php if ($time->term == 'finals'){ ?>
                                        <?php $time_limit = $time->deadline; ?>
                                    <?php }?>
                                <?php }?>
                                <?php if ($time_limit < date('Y-m-d H:i:s')){ ?>
                                    <div class="col-md-12">
                                        <h4>Sorry! Times Up. </h4>
                                    </div>
                                <?php }else{ ?>
                                    <form action="<?php echo site_url()?>class_group/uploadFinalsProject" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="group_id" value="<?php echo $group[0]->id;?>">
                                        <input type="hidden" name="student_id" value="<?php echo $this->session->userdata('id');?>">
                                        <div class="form-group">
                                            <input type="file" name="userfile" class="btn btn-info" size="20" style="border-radius: 0">
                                        </div>
                                        <input style="border-radius: 0" type="submit" class="btn btn-default" value="Upload" />
                                    </form>
                                <?php }?>
                            <?php }?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>

<!-- Prelim Remarks-->
<div id="prelimRemarks" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Prelim Remarks</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="remarks-prelim">
                    <div class="form-group">
                        <input type="hidden" name="student_id" id="student_id">
                        <input type="hidden" name="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="prelim-remarks" id="prelim-remarks" class="form-control" placeholder="Remarks">
                        <div><i id="prelim-error" style="color: red"></i></div>
                    </div>
                    <input type="submit" class="btn btn-success" value="Submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Midterm Remarks-->
<div id="midtermRemarks" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Midterm Remarks</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="remarks-midterm">
                    <div class="form-group">
                        <input type="hidden" name="studentID" id="studentID">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="midterm-remarks" id="midterm-remarks" class="form-control" placeholder="Remarks">
                        <div><i id="midterm-error" style="color: red"></i></div>
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

<!-- Prefinal Remarks-->
<div id="prefinalRemarks" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Prefinal Remarks</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="remarks-prefinal">
                    <div class="form-group">
                        <input type="hidden" name="studentId" id="studentId">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="prefinal-remarks" id="prefinal-remarks" class="form-control" placeholder="Remarks">
                        <div><i id="prefinal-error" style="color: red"></i></div>
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

<!-- Finals Remarks-->
<div id="finalsRemarks" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Finals Remarks</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="remarks-finals">
                    <div class="form-group">
                        <input type="hidden" name="studentId" id="id_student">
                        <input type="hidden" name="groupID" id="group_id" value="<?php echo $group[0]->id;?>">
                        <input type="number" name="finals-remarks" id="finals-remarks" class="form-control" placeholder="Remarks">
                        <div><i id="finals-error" style="color: red"></i></div>
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
<?php
    $present = date('Y/m/d H:i');
?>
<!-- Prelim Deadline-->
<div id="prelimDeadline" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Prelim Deadline</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="deadlinePrelim">
                    <div class="form-group">
                        <label for="">Deadline</label>
                        <input type="hidden" id="presentPrelim" value="<?php echo $present;?>">
                        <input type="hidden" name="groupID" id="prelim_gid">
                        <input type="hidden" name="subjectID" id="prelim_sid">
                        <input type="text" name="deadline" class="form-control" id="prelimTime">
                        <div><span id="deadline-pre-error" style="color: red"></span></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Set</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Midterm Deadline-->
<div id="midtermDeadline" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Midterm Deadline</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="deadlineMidterm">
                    <div class="form-group">
                        <label for="">Deadline</label>
                        <input type="hidden" id="presentMidterm" value="<?php echo $present;?>">
                        <input type="hidden" name="groupID" id="midterm_gid">
                        <input type="hidden" name="subjectID" id="midterm_sid">
                        <input type="text" name="deadline" class="form-control" id="midtermTime">
                        <div><span id="deadline-mid-error" style="color: red"></span></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Set</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Prefinal Deadline-->
<div id="prefinalDeadline" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Prefinal Deadline</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="deadlinePrefinal">
                    <div class="form-group">
                        <label for="">Deadline</label>
                        <input type="hidden" id="presentPrefinal" value="<?php echo $present;?>">
                        <input type="hidden" name="groupID" id="prefinal_gid">
                        <input type="hidden" name="subjectID" id="prefinal_sid">
                        <input type="text" name="deadline" class="form-control" id="prefinalTime">
                        <div><span id="deadline-prefinal-error" style="color: red"></span></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Set</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Finals Deadline-->
<div id="finalsDeadline" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Finals Deadline</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="deadlineFinals">
                    <div class="form-group">
                        <label for="">Deadline</label>
                        <input type="hidden" id="presentFinals" value="<?php echo $present;?>">
                        <input type="hidden" name="groupID" id="finals_gid">
                        <input type="hidden" name="subjectID" id="finals_sid">
                        <input type="text" name="deadline" class="form-control" id="finalsTime">
                        <div><span id="deadline-finals-error" style="color: red"></span></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Set</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>