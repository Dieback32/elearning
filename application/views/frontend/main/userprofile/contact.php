<?php
foreach ($user_info as $info){
    $mobile = $info->mobile;
    $address = $info->current_city;
}
?>
<div class="header-info">
    <span>contact information</span>
</div>
<div class="data-list">
    <?php if ($mobile != ''){ ?>
        <span id="label">Mobile Phones</span>
        <span id="data"><?php echo $mobile;?></span>
    <?php }else{?>
        <span id="label">Mobile Phones</span>
        <span id="data">None</span>
    <?php }?>

<!--    <span class="edit-contact"><a href="">Edit</a></span>-->
</div>
<div class="data-list">
    <?php if ($address != ''){ ?>
        <span id="label">Address</span>
        <span id="data"><?php echo $address;?></span>
    <?php }else{?>
        <span id="label">Address</span>
        <span id="data">None</span>
    <?php }?>

<!--    <span class="edit-contact"><a href="">Edit</a></span>-->
</div>
<div class="data-list">
    <span id="label">Email</span>
    <span id="data"><?php echo $this->session->userdata('email');?></span>
<!--    <span class="edit-contact"><a href="">Edit</a></span>-->
</div>