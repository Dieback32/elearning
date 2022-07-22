<?php
if ($this->session->userdata('authorization') != 'registrar' && $this->session->userdata('authorization') != 'staff'){
    redirect('dashboard');
}

?>

    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success">
            <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('success');?>
        </div>
    <?php }elseif ($this->session->flashdata('failed')) {?>
        <div class="alert alert-danger">
            <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry,</strong> <?php echo $this->session->flashdata('failed');?>
        </div>
    <?php }?>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header" style="margin-bottom: 20px">
                    <span style="font-size: 14px;font-weight: bold"><?php echo $subject[0]->subject_code;?>&nbsp;<?php echo $subject[0]->subject_desc;?></span>
                </div>
                <div class="body">
                    <?php if ($subject[0]->instructor_id != null || $subject[0]->instructor_id != 0){ ?>
                    <?php foreach ($instructor as $ins){ ?>
                        <?php if ($ins->id == $subject[0]->instructor_id){ ?>
                            <div  class="row clearfix">
                                <div class="col-sm-4">
                                    <?php if ($ins->avatar == null){ ?>
                                        <img style="margin-left: 50px;" src="<?php echo base_url();?>uploads/users/fbpic.jpg" alt="Avatar" width="150" height="200">
                                    <?php }else{ ?>
                                        <img style="margin-left: 50px;" src="<?php echo base_url();?>uploads/users/<?php echo $ins->avatar;?>" alt="Avatar" width="150" height="200">
                                    <?php } ?>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group form-float">
                                        <label class="form-label">Name :</label>
                                        <span><?php echo $ins->firstname;?>&nbsp;<?php echo $ins->lastname;?></span>
                                    </div>
                                    <div class="form-group form-float">
                                        <label class="form-label">ID number :</label>
                                        <span><?php echo $ins->id_number;?></span>
                                    </div>
                                    <div class="form-group form-float">
                                        <label class="form-label">Email :</label>
                                        <span><?php echo $ins->email;?></span>
                                    </div>
                                </div>
                            </div>
                    <?php } }?>
                    <?php }else{ ?>
                        <h4 style="text-align: center">No Instructor is Assign</h4>
                    <?php } ?>
                    <?php if ($instructor == null){ ?>
                        <h4 style="text-align: center">No Instructor is Assign</h4>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <span style="font-size: 20px">Students</span>
                </div>
                <?php if ($this->session->flashdata('error_delete')){ ?>
                    <div class="alert alert-danger">
                        <strong>Sorry!</strong> <?php echo $this->session->flashdata('error_delete');?>
                    </div>
                <?php } ?>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>ID No.</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Year</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($students as $data){ ?>
                                <?php foreach ($student_group as $group){ ?>
                                    <?php if ($data->id == $group->student_id){ ?>
                            <tr>
                                <td><?php echo $data->id_number;?></td>
                                <td><?php echo $data->firstname;?>&nbsp;<?php echo $data->lastname;?></td>
                                <td><?php echo $data->course;?></td>
                                <td><?php echo $data->year;?></td>
                                <td><?php echo $group->status;?></td>
                                <td style="text-align: center">
                                    <a style="display: inline;color: red" href="<?php echo site_url()?>dashboard/dropStudents?id=<?php echo $data->id;?>&sub=<?php echo $subject[0]->id;?>"><i class="fa fa-minus-circle fa-2x"></i></a>
                                    <a style="margin-left: 7px;color: black;" href="<?php echo site_url()?>dashboard/unassignStudents?id=<?php echo $data->id;?>&sub=<?php echo $subject[0]->id;?>"><i class="fa fa-trash fa-2x"></i></a>
                                </td>
                            </tr>
                                    <?php }?>
                                <?php }?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


