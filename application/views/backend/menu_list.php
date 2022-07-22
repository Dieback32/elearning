<?php
if ($this->session->userdata('authorization') != 'admin'){
    redirect('dashboard');
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <button style="height: 50px; width: 100%; text-align: left; font-size: large" class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">--Select List--
                <i class="material-icons" style="float: right">menu</i></button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" style="width: 100%">
                <li role="presentation"><a role="menuitem" id="btn" href="<?php echo site_url()?>dashboard/menuList/parentlist">Parent List</a></li>
                <li role="presentation"><a role="menuitem"  href="<?php echo site_url()?>dashboard/menuList/childlist">Child List</a></li>
                <li role="presentation"><a role="menuitem"  href="<?php echo site_url()?>dashboard/menuList/contentlist">Content List</a></li>

            </ul>
        </div>
    </div>
</div>
<?php if ($this->uri->segment(3) == 'childlist'){ ?>
    <form action="<?php echo site_url();?>dashboard/deleteChild" method="post">
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
                            Child Menu List
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th style="text-align: center"><input type="checkbox" id="checkAll">
                                        <label for="checkAll"></label></th>
                                    <th>Child Title</th>
                                    <th>Parent Title</th>
                                    <th>Content Title</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($show_child as $child) { ?>
                                    <tr>
                                        <td style="text-align: center;" ><input type="checkbox" id="<?php echo $child->id;?>" name="checkbox[]" value="<?php echo $child->id;?>">
                                            <label for="<?php echo $child->id;?>"></label></td>
                                        <td><?php echo $child->child_title; ?></td>
                                        <?php $parent_title = "NULL";?>
                                        <?php foreach ($show_parent as $parent){ ?>
                                            <?php if ($child->parent_id == NULL){?>
                                                <?php $parent_title = "NULL";?>
                                            <?php }elseif ($child->parent_id == $parent->id){ ?>
                                                <?php $parent_title = $parent->parent_title;?>
                                            <?php } }?>
                                        <td><?php echo $parent_title; ?></td>
                                        <?php $content_title = "NULL";?>
                                        <?php foreach ($show_content as $content){?>
                                            <?php
                                            if ($child->content_id == NULL) {
                                                $content_title = "NULL";
                                                ?>
                                            <?php }elseif($child->content_id == $content->id) {
                                                $content_title = $content->content_title;
                                            } ?>
                                        <?php }?>
                                        <td><?php echo $content_title; ?></td>
                                        <td style="text-align: center;"><a href="<?php echo site_url();?>dashboard/editChild/?id=<?php echo $child->id?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
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
<?php }elseif ($this->uri->segment(3) == 'parentlist'){ ?>
    <form action="<?php echo site_url();?>dashboard/deleteParent" method="post">
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
                        <button type="submit" id="delete" name="delete" style="float: right" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete &nbsp;<i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        <h2>
                            Parent Menu List
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th style="text-align: center"><input type="checkbox" id="checkAll">
                                        <label for="checkAll"></label></th>
                                    <th>Parent Title</th>
                                    <th>Content Title</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($show_parent as $parent){ ?>
                                    <tr>
                                        <td style="text-align: center"><input type="checkbox" id="<?php echo $parent->id?>" name="checkbox[]" value="<?php echo $parent->id?>">
                                            <label for="<?php echo $parent->id?>"></label></td>
                                        <td><?php echo $parent->parent_title;?></td>
                                        <?php $content_title = "NULL";?>
                                        <?php foreach ($show_content as $content) {
                                            if ($parent->content_id == NULL) {
                                                $content_title = "NULL";
                                            } elseif ($parent->content_id == $content->id) {
                                                $content_title = $content->content_title;
                                            }
                                        }
                                        ?>
                                        <td><?php echo $content_title ?></td>
                                        <td style="text-align: center;"><a href="<?php echo site_url();?>dashboard/editParent/?id=<?php echo $parent->id?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php }elseif ($this->uri->segment(3) == 'contentlist'){?>
    <form action="<?php echo site_url();?>dashboard/deleteContent" method="post">
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
                        <button type="submit" id="delete" name="delete" style="float: right" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete &nbsp;<i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        <h2>
                            Content Page List
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <th style="text-align: center"><input type="checkbox" id="checkAll">
                                        <label for="checkAll"></label></th>
                                    <th>Content Title</th>
                                    <th><p>Content</p></th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($show_content as $content){   ?>
                                    <?php if ($content->content_title == "default") { ?>

                                    <?php }else{ ?>
                                        <tr>
                                            <td style="text-align: center"><input type="checkbox" id="<?php echo $content->id;?>" name="checkbox[]" value="<?php echo $content->id;?>">
                                                <label for="<?php echo $content->id;?>"></label></td>
                                            <td><?php echo $content->content_title;?></td>
                                            <td><?php echo $content->content;?></td>
                                            <td style="text-align: center;"><a href="<?php echo site_url();?>dashboard/editContent/?id=<?php echo $content->id;?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
                                        </tr>
                                    <?php } }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php }?>

