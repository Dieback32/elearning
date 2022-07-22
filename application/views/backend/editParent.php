<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <a style="float: right;" href="<?php echo site_url()?>/dashboard/menuList/parentlist" class="btn btn-default">Return to Menu List</a>
                <h2>Edit Parent Menu Form</h2>
            </div>
            <div class="body">
                <form id="form_validation" action="<?php echo site_url()?>/dashboard/updateParent" method="POST">
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="msg"><i class="fa fa-check" id="bg-success" aria-hidden="true"> <span id="font-family"> <?php echo $this->session->flashdata('success');  ?></span></i></div>
                    <?php }elseif ($this->session->flashdata('failed')) {?>
                        <div class="msg"><i class="fa fa-exclamation-circle" id="bg-failed" aria-hidden="true"> <span id="font-family"> <?php echo $this->session->flashdata('failed');  ?></span></i></div>
                    <?php }?>
                    <br>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="hidden" name="parent_id" value="<?php echo $parent_title[0]->id; ?>">
                            <input type="text" class="form-control" name="parent_title" value="<?php echo $parent_title[0]->parent_title; ?>" required>
                            <label class="form-label">Parent Title</label>
                        </div>
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
                                <?php if ($row->content_title == 'default'):?>
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