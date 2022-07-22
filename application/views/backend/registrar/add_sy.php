<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>School Year</h2>
            </div>
            <div class="body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#add-sy">Add School Year</a></li>
                    <li><a data-toggle="tab" href="#settings">Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div id="add-sy" class="tab-pane fade in active">
                        <form id="form_advanced_validation" action="<?php echo site_url()?>dashboard/addSchoolYear" method="POST">
                            <?php if ($this->session->flashdata('errors')):?>
                                <div class="alert alert-danger">
                                    <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong><?php echo $this->session->flashdata('errors');?>
                                </div>
                            <?php elseif ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success">
                                    <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('success');?>
                                </div>
                            <?php elseif ($this->session->flashdata('sy_delete')): ?>
                                <div class="alert alert-danger">
                                    <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('sy_delete');?>
                                </div>
                            <?php endif;?>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="sy" value=""  required>
                                    <label class="form-label">School Year</label>
                                </div>
                                <div class="help-info">Ex: 2017 - 2018</div>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                        </form>
                    </div>
                    <div id="settings" class="tab-pane fade">
                        <form action="<?php echo site_url();?>dashboard/deleteSY" method="post">
                            <button style="float: right;margin-right: 30px" type="submit" class="btn btn-danger">Delete</button>
                        <div class="clearfix row"></div>
                        <div class="table-responsive" style="padding-top: 20px;">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th style="text-align: center"><input type="checkbox" id="checkAll">
                                        <label for="checkAll"></label></th>
                                    <th style="text-align: center">School Year</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($sy as $data){ ?>
                                    <tr>
                                        <td style="text-align: center"><input type="checkbox" id="<?php echo $data->id;?>" name="checkbox[]" value="<?php echo $data->id;?>">
                                            <label for="<?php echo $data->id;?>"></label></td>
                                        <td style="text-align: center"><?php echo $data->school_year;?></td>
                                        <td style="text-align: center"><a href=""><i class="material-icons">mode_edit</i></a></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
