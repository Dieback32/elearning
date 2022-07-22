<div class="grade-header">
    <h4>Class Group</h4>
</div>
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
                <div class="col-md-4">
                    <?php if ($cg->group_img == null){?>
                        <img src="<?php echo base_url()?>assets/images/default-img.png" alt="" width="100" height="100">
                    <?php }else{?>
                        <img src="<?php echo base_url()?>uploads/classphoto/<?php echo $cg->group_img; ?>" alt="" width="100" height="100">
                    <?php }?>
                </div>
            <?php foreach ($class_subject as $subject){ ?>
                    <?php if ($subject->id ==  $sg->subject_id){ ?>
                <div class="col-md-5" style="margin-top: 40px">
                    <a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $cg->id;?>" style="color: black;font-weight: bold;">
                        <span><?php echo $subject->subject_code;?></span><br>
                        <span><?php echo $subject->subject_desc;?></span>
                    </a>
                </div>
                <div class="col-md-3" style="margin-top: 40px">
                    <span style="color: black;font-weight: bold;"><?php echo $subject->school_year;?></span>
                </div>
                    <?php } ?>
            <?php } ?>
            </div>
            <div class="row clearfix"></div>
        <?php } } }?>
</div>