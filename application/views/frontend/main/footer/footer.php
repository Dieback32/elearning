<?php if ($this->uri->segment(2) == "changePassword"){ ?>
    <div class="footer-grading">
        <?php if ($footer == null){ ?>
            <span style="float: right">&copy;</span>
            <span></span>
        <?php }else{?>
            <span style="float: right"><?php echo $footer[0]->message;?> &copy; <?php echo $footer[0]->year; ?></span>
            <span><?php echo $footer[0]->company_name;?></span>
        <?php }?>
    </div>
<?php }elseif($this->uri->segment(1) == "userprofile"){ ?>
    <div class="footer-profile">
        <?php if ($footer == null){ ?>
            <span style="float: right">&copy;</span>
            <span></span>
        <?php }else{?>
            <span style="float: right"><?php echo $footer[0]->message;?> &copy; <?php echo $footer[0]->year; ?></span>
            <span><?php echo $footer[0]->company_name;?></span>
        <?php }?>
    </div>
<?php }elseif($this->uri->segment(1) == "grading_sheet"){?>
    <div class="footer-grading">
        <?php if ($footer == null){ ?>
            <span style="float: right">&copy;</span>
            <span></span>
        <?php }else{?>
            <span style="float: right"><?php echo $footer[0]->message;?> &copy; <?php echo $footer[0]->year; ?></span>
            <span><?php echo $footer[0]->company_name;?></span>
        <?php }?>
    </div>
<?php }else{?>
    <div class="footer">
        <?php if ($footer == null){ ?>
            <span style="float: right">&copy;</span>
            <span></span>
        <?php }else{?>
            <span style="float: right"><?php echo $footer[0]->message;?> &copy; <?php echo $footer[0]->year; ?></span>
            <span><?php echo $footer[0]->company_name;?></span>
        <?php }?>
    </div>
<?php } ?>
