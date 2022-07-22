<?php
    foreach ($user_info as $info){
        $city = $info->current_city;
        $hometown = $info->hometown;
    }
?>
<div class="header-place">
    <span>current city and hometown</span>
</div>
<div class="current-city">
    <?php if ($city == ''){ ?>
        <span>No Data</span>
        <br>
    <?php }else{ ?>
        <span><?php echo $city;?></span>
        <br>
    <?php } ?>
<!--    <span class="edit-place"><a data-toggle="modal" data-target="#City" href="" >Edit</a></span><br>-->
    <small>Current City</small>
</div>
<div class="current-city">
    <span>Legazpi City</span><br>
<!--    <span class="edit-place"><a data-toggle="modal" data-target="#Hometown" href="" >Edit</a></span><br>-->
    <small>Hometown</small>

</div>


<!--Modal City-->
<div id="City" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Current City</h4>
            </div>
            <div class="modal-body">
                <?php if ($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger">
                        <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php } ?>
                <form action="<?php echo site_url()?>userprofile/editCity" method="post">
                    <div class="form-group">
                        <label for="place">Current City</label>
                        <input type="hidden" name="id" value="<?php echo $this->session->userdata('id');?>">
                        <input type="text" name="city" class="form-control" placeholder="Current City">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Modal Hometown-->
<div id="Hometown" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hometown</h4>
            </div>
            <div class="modal-body">
                <?php if ($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger">
                        <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php } ?>
                <form action="<?php echo site_url()?>userprofile/editHometown" method="post">
                    <div class="form-group">
                        <label for="place">Hometown</label>
                        <input type="hidden" name="id" value="<?php echo $this->session->userdata('id');?>">
                        <input type="text" name="city" class="form-control" placeholder="Hometown">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>