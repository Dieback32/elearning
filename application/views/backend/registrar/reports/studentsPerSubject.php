<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2><?php echo $subjects[0]->subject_desc;?></h2>
            </div>
            <div class="body">
                <input name="b_print" type="button" class="btn btn-default" onClick="printDiv('div_print');" value=" Print ">
                <div class="row clearfix" style="margin-bottom: 20px"></div>
                <div class="table-responsive">
                    <div id="div_print">
                        <div class="repost-header">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <img style="float: right" src="<?php echo base_url();?>assets/images/catc-logo.jpg" alt="Logo" width="60" height="60">
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="text-align: center;">
                                <span style="text-align: center;font-size: 18px;font-weight: bold;">Computer Arts and Technological College, Inc.</span><br>
                                <span style="text-align: center;font-size: 15px;font-weight: bold;"><?php echo $subjects[0]->subject_code;?>&nbsp;<?php echo $subjects[0]->subject_desc;?>&nbsp;</span><br>
                                <span style="text-align: center;font-size: 15px;font-weight: bold;"><?php echo $subjects[0]->school_year;?></span>
                                <span style="text-align: center;font-size: 15px;font-weight: bold;">Semester: <?php echo $subjects[0]->semester;?></span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

                            </div>
                        </div>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID No.</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Year</th>
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
                                    </tr>
                                <?php }?>
                            <?php }?>
                        <?php } ?>
                        </tbody>
                    </table>

                        <div class="row clearfix" style="margin-top: 50px"></div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="text-align: center;">

                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <?php if ($instructor != null){ ?>
                                <?php foreach ($instructor as $ins){ ?>
                                    <?php if ($ins->id == $subjects[0]->instructor_id){ ?>
                                        <?php
                                        $fname = $ins->firstname;
                                        $lname = $ins->lastname;
                                        ?>
                                    <?php }elseif($subjects[0]->instructor_id == NULL || $subjects[0]->instructor_id == 0){?>
                                        <?php
                                        $fname = 'Not';
                                        $lname = 'Assigned';
                                        ?>
                                    <?php }?>
                                <?php }?>
                            <?php }else{ ?>
                                <?php
                                $fname = 'Not';
                                $lname = 'Assigned';
                                ?>
                            <?php }?>
                            <span style="text-align: center;font-size: 15px;"><?php echo $fname;?>&nbsp;<?php echo $lname;?></span>
                            <div style="margin:2px -5px 5px -2px;border-top: 1px solid black;"></div>
                            <span style="text-align: center;font-size: 15px;font-weight: bold;">Instructor</span>
                        </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printDiv(div_print) {
        var printContents = document.getElementById(div_print).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>