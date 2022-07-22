<?php
if ($this->session->userdata('authorization') != 'registrar' && $this->session->userdata('authorization') != 'staff'){
    redirect('dashboard');
}

foreach ($subjects as $data){
    $subject_code = $data->subject_code;
    $subject_desc = $data->subject_desc;
    $subject_id = $data->id;
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <span>Subject : <?php echo $subject_code;?>&nbsp;<?php echo $subject_desc?></span>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <form action="<?php echo site_url()?>dashboard/assigningStudent" method="post">

                        <button style="float: right" type="submit" class="btn btn-info">Assign</button>
                        <h4>List of Students</h4>
                        <input type="hidden" name="subject_id" value="<?php echo $subject_id;?>">
                        <div class="clearfix row" style="margin-bottom: 15px"></div>
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th style="text-align: center;"><input type="checkbox" id="checkAll">
                                    <label for="checkAll"></label></th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Year Level</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($students_group == null){ ?>
                            <?php foreach ($students as $users){ ?>

                                <tr>
                                    <td style="text-align: center;" ><input type="checkbox" id="<?php echo $users->id;?>" name="checkbox[]" value="<?php echo $users->id;?>">
                                        <label for="<?php echo $users->id;?>"></label></td>
                                    <td><?php echo $users->id_number;?></td>
                                    <td><?php echo $users->firstname;?>&nbsp;<?php echo $users->lastname;?></td>
                                    <td><?php echo $users->course;?></td>
                                    <td><?php echo $users->year;?></td>
                                </tr>

                                <?php } }else{ ?>
<!--                                    --><?php //foreach ($students_group as $asssigned){ ?>
                                    <?php foreach ($students as $users){ ?>
<!--                                        --><?php //foreach ($class as $group){?>
<!--                                        --><?php //if ($group->student_id == $asssigned->student_id ){?>
<!--                                        --><?php //if ($asssigned->student_id == $users->id){ ?>
                                <tr>
                                    <td style="text-align: center;" ><input type="checkbox" id="<?php echo $users->id;?>" name="checkbox[]" value="<?php echo $users->id;?>">
                                        <label for="<?php echo $users->id;?>"></label></td>
                                    <td><?php echo $users->id_number;?></td>
                                    <td><?php echo $users->firstname;?>&nbsp;<?php echo $users->lastname;?></td>
                                    <td><?php echo $users->course;?></td>
                                    <td><?php echo $users->year;?></td>
                                </tr>
<!--                                        --><?php //}?>
<!--                                        --><?php //}?>
<!--                                        --><?php //} ?>
                                <?php } ?>
<!--                                --><?php //} ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php var_dump($students_group); ?>
