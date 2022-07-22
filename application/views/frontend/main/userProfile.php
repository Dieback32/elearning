<?php
 foreach ($user_data as $profile){
     $avatar = $profile->avatar;
     $cover_photo = $profile->cover_photo;
 }
?>
<div class="container" id="profile-container">
    <div  id="coverphoto">
        <div class="overlay">
            <div>
                <a href="" data-toggle="modal" data-target="#profileCoverPhoto" style="margin-left: 20px;margin-top:15px;font-weight: bold;color: white;position: absolute "><i class="fa fa-camera fa-lg" aria-hidden="true"></i></a>
            </div>
            <div class="profile-picture" style="">
                <a href="" data-toggle="modal" data-target="#profileAvatar">
                    <?php if ($avatar == ''){ ?>
                        <img src="<?php echo base_url()?>uploads/users/fbpic.jpg" alt="Profile Picture" style="width: 174px;height: 194px; border-radius: 3px;margin: 3px">
                    <?php }else{ ?>
                    <img src="<?php echo base_url()?>uploads/users/<?php echo $avatar;?>" alt="Profile Picture" style="width: 174px;height: 194px; border-radius: 3px;margin: 3px">
                    <?php } ?>
                </a>
            </div>
            <div class="user-name">
                <h3><?php echo $this->session->userdata('firstname');?>&nbsp;<?php echo $this->session->userdata('lastname');?></h3>
            </div>
        </div>
        <?php if ($cover_photo == ''){ ?>
            <img src="<?php echo base_url()?>uploads/coverphoto/default-banner-mobile.jpg" alt="Cover Photo">
        <?php }else{ ?>
            <img src="<?php echo base_url()?>uploads/coverphoto/<?php echo $cover_photo;?>" alt="Cover Photo">
        <?php } ?>


        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="navbar-brand" >Profile</span>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active" style="padding: 10px 10px 10px 10px;background: #c8ccd4"><strong style="font-size: 20px;">About</strong></li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<div class="about-container">
    <div class="about-header">
        <h3>
            <i class="fa fa-user" aria-hidden="true"></i> &nbsp;About
        </h3>
    </div>
    <div class="about-sidebar">
        <ul class="menu-list">
            <li><a href="#overview" class="overview active-link">Overview</a></li>
            <li><a href="#place"  class="place">Place You've Lived</a></li>
            <li><a href="#contact"  class="contact">Contact</a></li>
            <li><a href="#info"  class="info">Basic Info</a></li>
            <li><a href="#about"  class="about">Details About you</a></li>
        </ul>
    </div>
    <div class="about-content" id="result">
        <?php $this->load->view('frontend/main/userprofile/overview');?>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>

<!--Modal Profile Avatar-->
<div id="profileAvatar" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Profile Avatar</h4>
            </div>
            <div class="modal-body">
                <?php if ($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger">
                        <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php } ?>
                <?php echo form_open_multipart('userprofile/uploadAvatar');?>
                <input type="file" name="userfile" size="20" />
                <br />
                <input type="submit" class="btn btn-primary" value="Upload" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal Cover Photo -->
<div id="profileCoverPhoto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cover Photo</h4>
            </div>
            <div class="modal-body">
                <?php if ($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger">
                        <strong><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> &nbsp;Sorry!</strong> <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php } ?>
                <?php echo form_open_multipart('userprofile/uploadCoverPhoto');?>
                <input type="file" name="userfile" size="20" />
                <br />
                <input type="submit" class="btn btn-primary" value="Upload" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
