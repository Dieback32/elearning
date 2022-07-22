<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Add Subject to the School Year</h2>
            </div>
            <div class="body ">
                <form action="<?php echo site_url();?>dashboard/insertingSubjects" method="post">
                    <?php if ($this->session->flashdata('inserted')){ ?>
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> <?php echo $this->session->flashdata('inserted');?>
                        </div>
                    <?php } ?>
                    <div class="form-group form-float">
                        <input style="float: right" type="submit" class="btn btn-primary" value="Submit">
                        <select name="year" id="" class="show-tick" required>
                            <option value="">--Select School Year</option>
                            <?php foreach ($sy as $data){ ?>
                                <option><?php echo $data->school_year;?></option>
                            <?php } ?>
                        </select>
                        <label for="form-label">Select Semester: </label>
                        <input name="semester" type="radio" value="1st" class="with-gap" id="radio_3" checked>
                        <label for="radio_3">1st</label>
                        <input name="semester" type="radio" value="2nd" id="radio_4" class="with-gap">
                        <label for="radio_4">2nd</label>
                    </div>
                    <div class="table-responsive" style="padding-top: 20px;">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th style="text-align: center"><input type="checkbox" id="checkAll">
                                    <label for="checkAll"></label></th>
                                <th style="text-align: center">Subject Code</th>
                                <th style="text-align: center">Description</th>
                                <th style="text-align: center">Day</th>
                                <th style="text-align: center">Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($subjects as $sub){ ?>
                                <tr>
                                    <td style="text-align: center"><input type="checkbox" id="<?php echo $sub->id;?>" name="checkbox[]" value="<?php echo $sub->id;?>">
                                        <label for="<?php echo $sub->id;?>"></label></td>
                                    <td><?php echo $sub->subject_code;?></td>
                                    <td><?php echo $sub->subject_desc;?></td>
                                    <td><?php echo $sub->day;?></td>
                                    <td><?php echo $sub->time;?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                </form>
            </div>
        </div>
    </div>
</div>
