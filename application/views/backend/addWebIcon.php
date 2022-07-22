<?php
if ($this->session->userdata('authorization') != 'admin'){
    redirect('dashboard');
}

if ($webdata == $check_webdata){
    $web_title = '';
    $brand_name = '';
    $web_icon = '';
    $logo = '';
    $banner = '';
}else{

    foreach ($webdata as $data){
        $web_title = $data->web_title;
        $brand_name = $data->brand_name;
        $web_icon = $data->web_icon;
        $logo = $data->logo;
        $banner = $data->banner;
    }

}
?>
<div class="row clearfix">
<!--    Web Icon-->
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <div class="card">
            <div class="header">
                <h2 class="text-uppercase" style="text-align: center"> Website Icon</h2>
            </div>
            <div class="body">
                <?php if ($this->session->flashdata('error')):?>
                    <div class="alert alert-danger">
                        <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry,</strong> <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php elseif ($this->session->flashdata('uploaded')):?>
                    <div class="alert alert-success">
                        <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('uploaded');?>
                    </div>
                <?php endif;?>

                    <?php if ($web_icon ==''){ ?>
                        <div style="text-align: center"><img src="<?php echo base_url();?>assets/images/icon.png" alt="Web Icon" width="110" height="110"></div>
                    <?php }else{ ?>
                        <div style="text-align: center"><img src="<?php echo base_url();?>uploads/icon/<?php echo $web_icon; ?>" alt="Web Icon" width="110" height="110"></div>
                    <?php } ?>

                <br><br>
                <form style="display: inline;" action="<?php echo site_url();?>dashboard/addIcon" method="post" enctype="multipart/form-data">
                    <input type="file" name="userfile" size="20" />
                    <br />
                    <input type="submit" class="btn btn-primary" value="Upload" style="display: inline-block">
                </form>
                <form style="float: right;" action="<?php echo site_url()?>dashboard/deleteIcon">
                    <button style="" type="submit" class="btn btn-danger">Delete Icon</button>
                </form>
                </div>
        </div>
    </div>


<!--Web Label-->
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <div class="card">
            <div class="header">
                <h2 class="text-uppercase" style="text-align: center"> Website Label</h2>
            </div>
                <div class="body">
                    <form id="form_validation" action="<?php echo site_url()?>dashboard/addTitle" method="POST" style="display: inline">
                        <?php if ($this->session->flashdata('updated')) { ?>
                            <div class="alert alert-success">
                                <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('updated');?>
                            </div>
                        <?php }elseif ($this->session->flashdata('errors')) {?>
                            <div class="alert alert-danger">
                                <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('errors');?>
                            </div>
                        <?php }?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="web_title" value="<?php echo $web_title;?>" required>
                                <label class="form-label">Website Title</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="brand_name" value="<?php echo $brand_name;?>" required>
                                <label class="form-label">Brand Name</label>
                            </div>
                        </div>
                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                    </form>
                    <form action="<?php echo site_url();?>dashboard/deleteWebLabel" method="post" style="float: right">
                        <button class="btn btn-danger">Delete Label</button>
                    </form>
                </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
<!--        Web Logo-->
        <div class="card">
            <div class="header">
                <h2 class="text-uppercase" style="text-align: center"> Website Logo</h2>
            </div>
                <div class="body">
                    <?php if ($this->session->flashdata('error')):?>
                        <div class="alert alert-danger">
                            <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry,</strong> <?php echo $this->session->flashdata('error');?>
                        </div>
                    <?php elseif ($this->session->flashdata('logo')):?>
                        <div class="alert alert-success">
                            <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('logo');?>
                        </div>
                    <?php endif;?>
                        <?php if ($logo ==''){?>
                            <div style="text-align: center"><img src="<?php echo base_url();?>assets/images/images.jpg" alt="Web Logo" width="110" height="110"></div>
                        <?php }else{ ?>
                            <div style="text-align: center"><img src="<?php echo base_url();?>uploads/logo/<?php echo $logo; ?>" alt="Web Logo" width="110" height="110"></div>
                        <?php }?>
                    <br><br>
                    <form action="<?php echo site_url();?>dashboard/addLogo" method="post" enctype="multipart/form-data" style="display: inline;">
                        <input type="file" name="userfile" size="20" />
                        <br /><br />
                        <input type="submit" class="btn btn-primary" value="Upload" />
                    </form>
                    <form action="<?php echo site_url();?>dashboard/deleteLogo" method="post" style="float: right;">
                        <button class="btn btn-danger">Delete Logo</button>
                    </form>
                </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                    <h2 class="text-uppercase">Website Banner</h2>
            </div>
            <div class="body">
                <?php if ($this->session->flashdata('error')):?>
                    <div class="alert alert-danger">
                        <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry,</strong> <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php elseif ($this->session->flashdata('banner')):?>
                    <div class="alert alert-success">
                        <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('banner');?>
                    </div>
                <?php endif;?>
                    <?php if ($banner ==''){ ?>
                        <div style="text-align: center"><img src="<?php echo base_url();?>assets/images/default-banner.jpg" alt="Web Banner" style="width: 95%;height: 500px "></div>
                    <?php }else{ ?>
                        <div style="text-align: center"><img src="<?php echo base_url();?>uploads/banner/<?php echo $banner; ?>" alt="Web Banner" style="width: 95%;height: 500px "></div>
                    <?php } ?>
                <br><br>
                <form action="<?php echo site_url();?>dashboard/addBanner" method="post" enctype="multipart/form-data" style="display: inline;">
                    <input type="file" name="userfile" size="20" />
                    <br /><br />
                    <input type="submit" class="btn btn-primary" value="Upload" />
                </form>
                <form action="<?php echo site_url()?>dashboard/deleteBanner" method="post" style="float: right">
                    <button class="btn btn-danger">Delete Banner</button>
                </form>
            </div>
        </div>
    </div>

</div>

