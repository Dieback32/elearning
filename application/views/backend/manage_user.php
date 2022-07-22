<?php
if ($this->session->userdata('authorization') != 'admin'){
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
                <div class="header">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')" id="delete" name="delete" style="float: right"  class="btn btn-danger">Delete &nbsp;<i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    <h2>
                        User Management
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th style="text-align: center"><input type="checkbox" id="checkAll">
                                    <label for="checkAll"></label></th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($user_data as $data){ ?>
                                <tr>
                                    <td style="text-align: center"><input type="checkbox" id="checkbox" name="checkbox[]" value="<?php echo $data->id?>">
                                        <label for="checkbox"></label></td>
                                    <td><?php echo $data->complete_name?></td>
                                    <td><?php echo $data->username; ?></td>
                                    <td><?php echo $data->email;?></td>
                                    <td></td>
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