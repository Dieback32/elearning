<?php
foreach ($user_info as $info){
    $birth = $info->birthdate;
    $gender = $info->gender;
}
?>
<div class="header-info">
    <span>Basic Information</span>
</div>
<div class="data-list">
    <span id="label">Firstname</span>
    <span id="data"><?php echo $this->session->userdata('firstname');?></span>
<!--    <span class="edit-info"><a href="">Edit</a></span>-->
</div>
<div class="data-list">
    <span id="label" style="margin-right: 50px">MI</span>
    <span id="data">F</span>
<!--    <span class="edit-info"><a href="">Edit</a></span>-->
</div>
<div class="data-list">
    <span id="label">Lastname</span>
    <span id="data"><?php echo $this->session->userdata('lastname');?></span>
<!--    <span class="edit-info"><a href="">Edit</a></span>-->
</div>
<div class="data-list">
    <?php if ($birth != ''){ ?>
        <span id="label">Birthdate</span>
        <span id="data"><?php echo $birth;?></span>
    <?php }else{?>
        <span id="label">Birthdate</span>
        <span id="data">None</span>
    <?php }?>
<!--    <span class="edit-info"><a href="">Edit</a></span>-->
</div>
<div class="data-list">
    <?php if ($gender != ''){ ?>
        <span id="label">Gender</span>
        <span id="data"><?php echo $gender;?></span>
    <?php }else{?>
        <span id="label">Gender</span>
        <span id="data">None</span>
    <?php }?>

<!--    <span class="edit-info"><a href="">Edit</a></span>-->
</div>
