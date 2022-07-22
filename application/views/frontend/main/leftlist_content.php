<?php
foreach ($user_data as $profile){
    $avatar = $profile->avatar;
    $cover_photo = $profile->cover_photo;
}
?>
<!--Left Sidebar-->
<div style="margin-top: 55px; margin-left: 30px;margin-right: 30px; height: inherit;">
    <div class="" id="left-sidebar">
        <ul class="nav nav-pills  nav-stacked">
            <li role="presentation">
                <a href="<?php echo site_url()?>userprofile">
                    <?php if ($avatar == ''){ ?>
                        <img src="<?php echo base_url()?>uploads/users/fbpic.jpg" alt="User" style="width: 30px; height: 30px;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;">
                    <?php }else{ ?>
                        <img src="<?php echo base_url()?>uploads/users/<?php echo $avatar;?>" alt="User" style="width: 30px; height: 30px;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;">
                    <?php } ?>
                    &nbsp;&nbsp;<?php echo $this->session->userdata('firstname');?>&nbsp;<?php echo $this->session->userdata('lastname');?>
                </a>
            </li>
            <li role="presentation"><a href="#" class="active-link"><img src="<?php echo base_url();?>assets/frontend/images/calendar-512.png" alt="Event" width="20" height="20"> &nbsp;&nbsp;Events</a></li>
            <li role="presentation"><a href="<?php echo site_url()?>class_group"><img src="<?php echo base_url()?>assets/frontend/images/User_Group.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Group</a></li>
            <li role="presentation"><a href="<?php echo site_url()?>grading_sheet""><img src="<?php echo base_url()?>assets/frontend/images/Sheets-icon.png" alt="" width="20" height="20"> &nbsp;&nbsp;Grading Sheet</a></li>
<!--            <li role="presentation"><a href="--><?php //echo site_url();?><!--messages"><img src="--><?php //echo base_url()?><!--assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20"> &nbsp;&nbsp;Messages</a></li>-->
        </ul>
    </div>
    <!--Content-->
    <div id="content">
        <div style="background: white;height: 45px;padding-top: 11px;padding-left: 30px;border-bottom: 1px solid #dddfe2;">
            <span style="font-weight: bold">Upcoming Events</span>
        </div>
        <?php  if ($this->session->userdata('authorization') == 'instructor'){?>
            <div>
                <button class="btn btn-default" style="border-radius: 0;margin: 20px 0 0 30px;background: #4267b2;font-weight: bold;color: white" data-toggle="modal" data-target="#create-event"><i class="fa fa-plus"></i> Create Event</button>
            </div>
        <?php } ?>
        <div style="margin: 20px 20px 20px 20px;">
            <?php if ($this->session->flashdata('event_success')){ ?>
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('event_success')?>
                </div>
            <?php }elseif ($this->session->flashdata('event_failed')){?>
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('event_failed')?>
                </div>
            <?php }?>
        </div>
        <?php foreach ($event as $details){ ?>
            <?php
                $event_date = date_create($details->date_time);
            ?>
            <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
            <div class="row event-header">
                <div class="event-settings dropdown" style="float: right">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-ellipsis-h fa-2x"></i>
                        <ul class="dropdown-menu">
                            <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#edit-event" class="editEvent" id="<?php echo $details->id;?>" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Edit</a></li>
                            <li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#delete-event" class="deleteEvent" id="<?php echo $details->id;?>"><i style="margin-right: 20px;" class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                        </ul>
                    </a>
                </div>
            </div>
            <?php }?>
            <?php if ($event == null){ ?>
                <div class="event-container row" >
                    <div class="col-md-12" style="text-align: center">
                        <h3>No event has been set.</h3>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="event-container row" >
                    <div class="col-md-4">
                        <img src="<?php echo base_url();?>uploads/event_photos/<?php echo $details->event_photo;?>" alt="Event Photo" width="270" height="200">
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-4">
                            <span class="event-day"><?php echo date_format($event_date,'M')?></span>
                            <span class="event-month"><?php echo date_format($event_date,'d')?></span>
                        </div>
                        <div class="col-md-8" style="margin-top: 60px;text-align: center">
                            <span class="event-title"><?php echo $details->event_name;?></span>
                            <span class="event-date-location"><?php echo date_format($event_date,'D M d ');?> <i class="fa fa-circle"></i> <?php echo date_format($event_date,'h A');?></span>
                            <span class="event-date-location"><?php echo $details->location;?></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <br>
                        <span class="event-desc"><?php echo $details->description;?></span>
                    </div>
                </div>
            <?php }?>
        <?php } ?>
    </div>
    <div class="footer-home">
        <?php if ($footer == null){ ?>
            <span style="float: right">&copy; </span>
            <span></span>
        <?php }else{?>
            <span style="float: right"><?php echo $footer[0]->message;?> &copy; <?php echo $footer[0]->year; ?></span>
            <span><?php echo $footer[0]->company_name;?></span>
        <?php }?>

    </div>
</div>


<!--Create Event Modal -->
<div id="create-event" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" style="font-weight: bold">Create Event</h5>
            </div>
            <div class="event-note" style=" height: inherit;width: 100%;background: #4080ff;color: white; padding: 20px 20px 20px 20px">
                <span>You're creating an public event. This will be publish on the event wall.</span>
            </div>
            <div class="modal-body" >
                <form action="<?php echo site_url();?>home/createEvent" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Event Photo</label>
                        <input type="file" name="userfile" class="btn btn-info" size="20" style="border-radius: 0">
                    </div>
                    <div class="form-group">
                        <label for="">Event Name</label>
                        <input type="text" name="event_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" name="event_location" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Date/Time</label>
                        <input type="text" id="event-date" placeholder="<?php echo date('Y-m-d h:00 A')?>" name="event_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea style="resize: none;" name="event_desc" id="" class="form-control" placeholder="Tell people more about the event" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="border-radius: 0;float: right;">Create Event</button>
            </div>
            </form>
        </div>

    </div>
</div>

<!--Edit Event Modal -->
<div id="edit-event" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" style="font-weight: bold">Edit Event</h5>
            </div>
            <div class="event-note" style=" height: inherit;width: 100%;background: #4080ff;color: white; padding: 20px 20px 20px 20px">
                <span>You're creating an public event. This will be publish on the event wall.</span>
            </div>
            <div class="modal-body" >
                <form action="" method="post" id="event-edit" >
                    <div class="form-group">
                        <input type="hidden" name="event_id" id="event-id">
                    </div>
                    <div class="form-group">
                        <label for="">Event Name</label>
                        <input type="text" name="event_name" id="event-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" name="event_location" id="event-location" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="present-date" value="<?php echo date('Y/m/d H:i')?>">
                        <label for="">Date/Time</label>
                        <input type="text" id="event-datetime" name="event_date" class="form-control" required>
                        <span style="color: red" id="event-error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea style="resize: none;" name="event_desc" id="event-desc" class="form-control" placeholder="Tell people more about the event" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="border-radius: 0;float: right;">Update</button>
            </div>
            </form>
        </div>

    </div>
</div>


<!--Delete Event Modal -->
<div id="delete-event" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" >
                <form action="" method="post" id="event-delete">
                    <div class="form-group">
                        <h4 style="text-align: center">Are you sure you want to delete this item?</h4>
                    </div>
                    <div class="form-group" style="text-align: center">
                        <input type="hidden" name="id_event" id="id_event">
                        <input style="border-radius: 0;margin-right: 25px;" type="submit" class="btn btn-danger" value="Delete">
                        <button style="border-radius: 0" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>
