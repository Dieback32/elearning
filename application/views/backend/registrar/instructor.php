<?php
if ($this->session->userdata('authorization') != 'registrar'){
    redirect('dashboard');
}

?>
<form action="<?php echo site_url();?>dashboard/deleteUser" method="post">
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
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')" id="delete" name="delete" style="float: right"  class="btn btn-danger">Delete &nbsp;<i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    <h2>Manage Instructor</h2>
                </div>
                <?php if ($this->session->flashdata('ins_updated')){ ?>
                    <div style="margin: 0 auto; width: 50%;" class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('ins_updated');?>
                    </div>
                <?php }elseif($this->session->flashdata('ins_failed')){?>
                    <div style="margin: 0 auto; width: 50%;" class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('ins_failed');?>
                    </div>
                <?php }elseif($this->session->flashdata('deactivated')){?>
                    <div style="margin: 0 auto; width: 50%;" class="alert alert-info alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('deactivated');?>
                    </div>
                <?php }elseif($this->session->flashdata('activated')){ ?>
                    <div style="margin: 0 auto; width: 50%;" class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('activated');?>
                    </div>
                <?php } ?>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th style="text-align: center"><input type="checkbox" id="checkAll">
                                    <label for="checkAll"></label></th>
                                <th>ID No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($get_users as $data){ ?>
                                <tr>
                                    <td style="text-align: center"><input type="checkbox" id="checkbox" name="checkbox[]" value="<?php echo $data->id?>">
                                        <label for="checkbox"></label></td>
                                    <td><?php echo $data->id_number;?></td>
                                    <td><?php echo $data->firstname?>&nbsp;<?php echo $data->lastname?></td>
                                    <td><?php echo $data->email; ?></td>
                                    <td><?php echo $data->status;?></td>
                                    <td style="text-align: center">
                                        <div class="dropdown">
                                            <a style="color: #777777;" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog fa-lg" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                                <li role="presentation"><a style="font-weight: bold;" role="menuitem" href="#" data-toggle="modal" data-target="#edit-instructor" class="EditInstructor" id="<?php echo $data->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;Edit</a></li>
                                                <li role="presentation" class="divider"></li>
                                                <li role="presentation"><a style="font-weight: bold;" role="menuitem" href="#" data-toggle="modal" data-target="#deactivate-instructor" class="deactivateInstructor" id="<?php echo $data->id;?>"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Deactivate</a></li>
                                                <li role="presentation"><a style="font-weight: bold;" role="menuitem" href="#" data-toggle="modal" data-target="#activate-instructor" class="activateInstructor" id="<?php echo $data->id;?>"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Activate</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<!--Edit Instructor Modal -->
<div id="edit-instructor" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Instrutor's Data</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url()?>dashboard/editInstructorsData" method="post" id="form_advanced_validation">
                    <input type="hidden" name="ins_id" id="ins_id">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="id_no" id="id_no" value=""  required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="fname" id="fname" value=""  required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="lname" id="lname" value=""  required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" id="email" value="" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Deactivate Instructor Modal -->
<div id="deactivate-instructor" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body" style="text-align: center">
                <span>Are you sure that you want to <strong>Deactivate</strong> this account?</span>
            </div>
            <div class="modal-footer">
                <form style="text-align: center" action="<?php echo site_url()?>dashboard/deactivateInstructor" method="post" id="form_advanced_validation">
                    <input type="hidden" name="instructor_id" id="id_ins">
                    <button type="submit" class="btn btn-danger">Deactivate</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Activate Instructor Modal -->
<div id="activate-instructor" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body" style="text-align: center">
                <span>Are you sure that you want to <strong>Activate</strong> this account?</span>
            </div>
            <div class="modal-footer">
                <form style="text-align: center" action="<?php echo site_url()?>dashboard/activateInstructor" method="post" id="form_advanced_validation">
                    <input type="hidden" name="instructor_id" id="id_instructor">
                    <button type="submit" class="btn btn-success">Activate</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>