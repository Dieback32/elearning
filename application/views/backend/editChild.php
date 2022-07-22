<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a style="float: right;" href="<?php echo site_url()?>dashboard/menuList/childlist" class="btn btn-default">Return to Menu List</a>
                <h2>Edit Child Menu Form</h2>
            </div>
            <div class="body">
                <form id="form_validation" action="<?php echo site_url()?>dashboard/updateChild" method="POST">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="hidden" name="child_id" value="<?php echo $child_name[0]->id; ?>">
                            <input type="text" class="form-control" name="child_title" value="<?php echo $child_name[0]->child_title; ?>" required>
                            <label class="form-label">Child Title</label>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label">Parent Title</label>
                        <select class="form-control show-tick" name="selparent">
                            <?php if ($parent_name[0]->parent_title == NULL){?>
                            <?php $parent_title = "NULL";?>
                            <?php }else{
                                $parent_title = $parent_name[0]->parent_title;
                            }?>
                            <option><?php echo $parent_title;?></option>
                            <?php foreach ($show_parent as $prow){ ?>
                            <option><?php echo $prow->parent_title;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label">Content Title</label>
                        <select class="form-control show-tick" name="selcontent">
                            <?php if ($content_title[0]->content_title == NULL){
                                    $content_data = "NULL";
                            }else{
                                    $content_data = $content_title[0]->content_title;
                            }
                            ?>
                            <option><?php echo $content_data;?></option>
                            <?php foreach ($show_content as $row){ ?>
                                <?php if ($row->content_title == 'default'): ?>
                                <?php else:?>
                                <option><?php echo $row->content_title;?></option>
                                <?php endif;?>
                            <?php } ?>
                        </select>
                    </div>
                    <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</div>