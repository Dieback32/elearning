<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Grades of Student</h2>
            </div>
            <div class="body">
                <div class="form-group form-float" style="margin-top: 20px">
                    <label for="">Semester : </label>
                    <select name="school-year" id="select_sem" class="show-tick">
                        <option>1st</option>
                        <option>2nd</option>
                    </select>
                    <select name="school-year" id="sy_select_grades" class="show-tick">
                        <option value="">--Select School Year--</option>
                        <?php foreach ($school_year as $sy){ ?>
                            <option value="<?php echo $sy->school_year;?>"><?php echo $sy->school_year;?></option>
                        <?php } ?>
                    </select>
                    <div class="clearfix row"></div>
                    <div id="reports-container-list">
                        <?php foreach ($subjects as $sub){ ?>
                        <div class="display-subjects">
                        <div class="col-md-3" style="text-align: center">
                            <span>Semester: <?php echo $sub->semester;?></span>
                        </div>
                        <div class="col-md-3" style="text-align: center">
                            <span><?php echo $sub->subject_code;?></span>
                        </div>
                        <div class="col-md-3" style="text-align: center">
                            <span><?php echo $sub->subject_desc;?></span>
                        </div>
                        <div class="col-md-3">
                            <div class="dropdown" style="text-align: right">
                                <a style="color: #777777;" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog fa-lg" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li role="presentation"><a style="font-weight: bold;" role="menuitem" href="<?php echo site_url()?>dashboard/reportsPrelim?subject=<?php echo $sub->id;?>" >&nbsp;Prelim</a></li>
                                    <li role="presentation"><a style="font-weight: bold;" role="menuitem" href="<?php echo site_url()?>dashboard/reportsMidterm?subject=<?php echo $sub->id;?>" >&nbsp;Midterm</a></li>
                                    <li role="presentation"><a style="font-weight: bold;" role="menuitem" href="<?php echo site_url()?>dashboard/reportsPrefinal?subject=<?php echo $sub->id;?>" >&nbsp;Prefinal</a></li>
                                    <li role="presentation"><a style="font-weight: bold;" role="menuitem" href="<?php echo site_url()?>dashboard/reportsFinals?subject=<?php echo $sub->id;?>" >&nbsp;Finals</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a style="font-weight: bold;" role="menuitem" href="<?php echo site_url()?>dashboard/reportsFinalGrade?subject=<?php echo $sub->id;?>" >&nbsp;Final Grade</a></li>
                                </ul>
                            </div>
                        </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>