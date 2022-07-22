<div class="group-content-box">
    <?php if ($students == null){ ?>
        <h4 style="text-align: center">Their is no group available</h4>
    <?php } ?>
    <?php foreach ($students as $sg){
        $group = $sg->group_id;
        $group_id = $sg->id;
        ?>
    <?php foreach ($class_group as $cg){ ?>
        <?php if ($group == $cg->id){ ?>
            <div class="col-md-12 group-list" style="border-bottom: 1px solid #e9ebee; padding-bottom: 10px;padding-top: 10px;">
                <img src="<?php echo base_url()?>assets/images/default-img.png" alt="" width="100" height="100">
                <a href="<?php echo site_url()?>grading_sheet/gradesPerGroup?id=<?php echo $cg->id;?>" style="color: black"><strong style="padding-left: 30px "><?php echo $cg->subject_name;?></strong></a>
            </div>
            <div class="row clearfix"></div>
    <?php } } }?>
</div>