<?php if ($class_group == null){ ?>
    <h4 style="text-align: center">Empty Class Group</h4>
<?php  }else{ ?>
    <?php foreach ($class_group as $cg){ ?>
        <?php foreach ($subjects as $sub){ ?>
            <?php if ($sub->id == $cg->subject_id){ ?>
        <div class="col-md-12 group-list-data" style="border-bottom: 1px solid #e9ebee; padding-bottom: 10px;padding-top: 10px;">
            <?php if ($cg->group_img == ''){ ?>
                <img src="<?php echo base_url()?>assets/images/default-img.png" alt="" width="100" height="100">
            <?php }else{ ?>
                <img src="<?php echo base_url()?>uploads/classphoto/<?php echo $cg->group_img;?>" alt="" width="100" height="100">
            <?php }?>

            <a href="<?php echo site_url()?>grading_sheet/gradesPerGroup?id=<?php echo $cg->id;?>" style="color: black">
                <strong style="padding-left: 30px "><?php echo $sub->subject_code;?></strong>
                <strong style="padding-left: 30px "><?php echo $cg->subject_name;?></strong>
                <strong style="padding-left: 30px "><?php echo $sub->school_year;?></strong>
            </a>
<!--            <div class="g-settings dropdown">-->
<!--                <a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>-->
<!--                    <ul class="dropdown-menu">-->
<!--                        <li><a href="#">Published</a></li>-->
<!--                        <li><a href="#">Hidden</a></li>-->
<!--                    </ul>-->
<!--                </a>-->
<!--            </div>-->
        </div>
        <div class="row clearfix"></div>
            <?php }?>
    <?php }?>
<?php } }?>

