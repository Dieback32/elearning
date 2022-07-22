<?php
if ($this->session->userdata('authorization') != 'registrar' && $this->session->userdata('authorization') != 'staff'){
    redirect('dashboard');
}

foreach ($instructor as $data){
    $fname = $data->firstname;
    $lname = $data->lastname;
    $user = $data->id;
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Instructor : <?php echo $fname;?>&nbsp;<?php echo $lname?></h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <form action="<?php echo site_url()?>dashboard/assigningInstructor" method="post">

                    <button style="float: right" type="submit" class="btn btn-info">Assign</button>
                    <h4>List of Available Subjects</h4>
                    <input type="hidden" name="id" value="<?php echo $user?>">
                    <div class="clearfix row" style="margin-bottom: 15px"></div>
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                        <tr>
                            <th style="text-align: center;"><input type="checkbox" id="checkAll">
                                <label for="checkAll"></label></th>
                            <th>Subject Code</th>
                            <th>Description</th>
                            <th>Day</th>
                            <th>Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($loaded as $data){ ?>
                            <tr>
                                <td style="text-align: center;" ><input type="checkbox" id="<?php echo $data->id;?>" name="checkbox[]" value="<?php echo $data->id;?>">
                                    <label for="<?php echo $data->id;?>"></label></td>
                                <td><?php echo $data->subject_code?></td>
                                <td><?php echo $data->subject_desc?></td>
                                <td><?php echo $data->day?></td>
                                <td><?php echo $data->time?></td>
                            </tr>
                        <?php }  ?>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
