<div class="container-message">
    <div class="message-header"></div>
    <div class="message-body">
        <div class="col-md-3 message-leftside">
            <div class="leftside-header">
                <?php if ($this->session->userdata('avatar') == null){ ?>
                    <img style="border-radius: 50%;" src="<?php echo base_url();?>assets/frontend/images/fbpic.jpg" width="34" height="34" alt="Avatar">
                <?php }else{?>
                    <img style="border-radius: 50%;" src="<?php echo base_url();?>uploads/users/<?php echo $this->session->userdata('avatar');?>" width="34" height="34" alt="Avatar">
                <?php }?>

                <span style="margin-left: 10px"><?php echo $this->session->userdata('firstname');?>&nbsp;<?php echo $this->session->userdata('lastname');?></span>
            </div>
            <div>
                <div class="leftside-status"><span>Contacts (30)</span></div>
                <ul>
                    <?php foreach ($all_users as $users): ?>
                    <?php if ($users->id != $this->session->userdata('id')){ ?>
                    <a href="#<?php echo $users->id?>" class="select-chat" id="<?php echo $users->id;?>">
                    <li>
                        <div style="float: right;" >
                            <div class="users-active-status"></div>
                        </div>
                        <div class="listofusers">
                            <?php if ($users->avatar == null){ ?>
                                <img style="border-radius: 50%;" src="<?php echo base_url();?>assets/frontend/images/fbpic.jpg" width="34" height="34" alt="Avatar">
                            <?php }else{?>
                                <img style="border-radius: 50%;" src="<?php echo base_url();?>uploads/users/<?php echo $users->avatar;?>" width="34" height="34" alt="Avatar">
                            <?php }?>
                            <span style="margin-left: 10px"><?php echo $users->firstname;?>&nbsp;<?php echo $users->lastname;?></span>
                        </div>
                    </li>
                    </a>
                    <?php }?>
                    <?php endforeach;?>
                </ul>
           </div>
        </div>
        <div class="col-md-7 message-content">
            <div class="_chatbox-container-header">
                <div class="_chatbox-header clearfix">
                    <div class="_user-img">
                        <img style="border-radius: 50%;" src="<?php echo base_url();?>assets/frontend/images/fbpic.jpg" width="60" height="60" alt="Avatar">
                    </div>
                    <input type="hidden" id="users_id">
                    <div>
                        <div class="_users-name">
                            <span id="fname">Firstname</span> <span id="lname">Lastname</span>
                        </div>
                    </div>
                    <div class="_users-data-msg">
                        <span>You're friend in CATC</span>
                    </div>
                    <div>
                        <div class="_users-profession">
                            <span id="course">Course/Profession</span> <span id="year">Year</span>
                        </div>
                        <div class="_users-address">
                            <span>Lives in</span>&nbsp;<span id="city">City</span>,<span id="hometown">Hometown</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="_chatbox-content" >
                <?php
                $data = array(
                    'chatmessage' => $this->chat_message->getMessage(),
                    'user' => $this->user_management->getAllUsers()
                );
                $this->load->view('frontend/main/messages/chat_message',$data);
                ?>
            </div>
            <div class="_chatbox-message-container">
                <div class="_chatbox-message-1">
                    <div class="_chatbox-message-2">
                        <div class="_chatbox-message-3">
                            <input type="hidden" name="user" id="user" value="<?php echo $this->session->userdata('id');?>">
<!--                            <a href="#" style="float: right;margin-right: 10px;margin-top: 10px"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>-->
                            <textarea class="_chatbox-text-field" name="msg" id="msg" cols="" rows="" placeholder="Type a message..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 message-rightside"></div>
    </div>
</div>

