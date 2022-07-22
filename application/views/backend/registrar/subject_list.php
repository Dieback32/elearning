<?php
if ($this->session->userdata('authorization') != 'registrar' && $this->session->userdata('authorization') != 'staff'){
    redirect('dashboard');
}

?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Subjects</h2>
            </div>
            <div class="body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="pill" href="#home">Subject List</a></li>
                    <li><a data-toggle="pill" href="#menu1">Assign Instructor</a></li>
                </ul>
                <?php if ($this->session->flashdata('failed_delete')){ ?>
                    <div class="alert alert-danger">
                        <strong>Sorry!</strong> <?php echo $this->session->flashdata('failed_delete');?>
                    </div>
                <?php } ?>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <form id="form_validation" action="" method="post" >
                            <div class="form-group form-float" style="margin-top: 20px">
                                <label for="">Semester :</label>
                                <select name="school-year" id="sem-subjects" class="show-tick">
                                    <option>1st</option>
                                    <option>2nd</option>
                                </select>
                                <select name="school-year" id="school-year" class="show-tick">
                                    <option value="">--Select School Year--</option>
                                    <?php foreach ($school_year as $sy){ ?>
                                        <option value="<?php echo $sy->school_year;?>"><?php echo $sy->school_year;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </form>
                        <form action="<?php echo site_url()?>dashboard/deleteSubject" method="post">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;Delete</button>
                            <div >
                            <div class="table-responsive" style="padding-top: 20px;">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center"><input type="checkbox" id="checkAll">
                                            <label for="checkAll"></label></th>
                                        <th>Semester</th>
                                        <th>Subject Code</th>
                                        <th>Description</th>
                                        <th>Day</th>
                                        <th>Time</th>
                                        <th>Instructor</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="show-subject">
                                        <?php echo $subjects;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </form>
                    </div>

                    <div id="menu1" class="tab-pane fade">
                        <div class="table-responsive" style="padding-top: 30px">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th>ID Number</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Assign</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($instructor != null){ ?>
                                <?php foreach ($instructor as $data){ ?>
                                    <tr>
                                        <td><?php echo $data->id_number;?></td>
                                        <td><?php echo $data->firstname?></td>
                                        <td><?php echo $data->lastname?></td>
                                        <td><?php echo $data->email?></td>
                                        <td style="text-align: center;"><a href="<?php echo site_url()?>dashboard/assignInstructor?id=<?php echo $data->id?>"><i class="material-icons">assignment</i></a></td>
                                    </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
