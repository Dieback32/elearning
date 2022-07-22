<?php
if ($chatmessage != null){
    foreach ($chatmessage as $msg){
        foreach ($user as $info){
            if ($info->id == $msg->user_id){
                $chat_logs = date_create($msg->logs)
?>
            <div style="margin-bottom: 8px" class="chat-container">
                <?php if ($info->avatar == null){ ?>
                    <img src="<?php echo base_url();?>uploads/users/fbpic.jpg" alt="" width="30" height="30" style="border-radius: 50%">
                <?php }else{?>
                    <img src="<?php echo base_url();?>uploads/users/<?php echo $info->avatar;?>" alt="" width="30" height="30" style="border-radius: 50%">
                <?php }?>
                <span class="chat-messages" ><span style="font-weight: bold;font-size: 14px;margin-right: 10px"><?php echo $info->firstname;?></span><?php echo $msg->message;?></span>
                <span class="chat-logs"><?php echo date_format($chat_logs,'M d, Y h:i A');?> </span>
                <br>
            </div>

<?php
            }

        }
    }
}

?>

