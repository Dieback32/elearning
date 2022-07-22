<?php
if ($this->session->userdata('authorization') == 'student' && $on_going_exam != null){
    foreach ($on_going_exam as $exam){
        $start = $exam->start;
        $end = $exam->time_limit;
    }
    $present = date('Y-m-d H:i:s');
    if ($start >= $present && $end >= $present){
?>
<div class="chat-sidebar" >
    <?php foreach ($all_users as $users){ ?>
        <?php if ($users->id != $this->session->userdata('id') ){ ?>
            <div class="sidebar-name">
                <?php if ($users->avatar == null){ ?>
                    <img src="<?php echo base_url()?>uploads/users/fbpic.jpg" alt="user">
                <?php }else{ ?>
                    <img src="<?php echo base_url()?>uploads/users/<?php echo $users->avatar;?>" alt="user">
                <?php } ?>
                <span><?php echo $users->firstname." ";?><?php echo $users->lastname;?></span>
            </div>
        <?php } } ?>
</div>
    <?php }?>
<?php  }else{ ?>
<div class="chat-sidebar" >
    <?php foreach ($all_users as $users){ ?>
        <?php if ($users->id != $this->session->userdata('id') ){ ?>
            <div class="sidebar-name">
                <?php if ($users->avatar == null){ ?>
                    <img src="<?php echo base_url()?>uploads/users/fbpic.jpg" alt="user">
                <?php }else{ ?>
                    <img src="<?php echo base_url()?>uploads/users/<?php echo $users->avatar;?>" alt="user">
                <?php } ?>
                <span><?php echo $users->firstname." ";?><?php echo $users->lastname;?></span>
            </div>
        <?php } } ?>
<?php }?>

<!--    javascript:register_popup('<?php echo $users->id?>','<?php echo $users->firstname." ";?><?php echo $users->lastname;?>');-->