<?php
foreach ($get_quiz as $g_id){
    $group_id = $g_id->group_id;
}

?>
<style>
    .tab {
        display: none;
    }
    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #4CAF50;
    }
</style>
<div class="container" style="padding-top: 55px;">
    <div class="group-sidebar">

    </div>
    <div class="quiz-container">
        <div class="quiz-header">
            <span ></span><br>
            <span style="position: absolute;"><?php echo $get_quiz[0]->name;?></span><span id="timer" style="float: right"></span>
        </div>
<!--        <div class="quiz-content">-->
            <?php if ($numberofquestion == $summary || $get_quiz[0]->status == 'deactivated'){?>
                <?php redirect('class_group/createQuestion?q='.$get_quiz[0]->id); ?>
            <?php }?>
            <?php if ($question == null){ ?>
                <?php redirect('class_group/createQuestion?q='.$get_quiz[0]->id); ?>
            <?php } ?>
            <?php foreach ($question as $cnt=>$data){ ?>
<!--            <div class="mySlides">-->
            <form id="checkAnswer" action="<?php echo site_url()?>class_group/getScore" method="post">
            <div class="questions-list">
                <input type="hidden" name="quiz_id" value="<?php echo $get_quiz[0]->id;;?>">
                <input type="hidden" name="question_id" value="<?php echo $data->id;?>">
                <input type="hidden" name="number" value="<?php echo $data->question_number;?>">
                <input type="hidden" name="type" value="<?php echo $data->type;?>">
                <input type="hidden" name="exam_type" value="<?php echo $get_quiz[0]->type;?>">
                <input type="hidden" name="term" value="<?php echo $get_quiz[0]->term;?>">
                <input type="hidden" name="group_id" value="<?php echo $group_id;?>">
                <h4><?php echo $data->question;?></h4>
                <?php foreach ($choices as $choice){ ?>
                    <?php if ($data->id == $choice->question_id){ ?>
                    <?php if ($data->type == 'Multiple Choice' || $data->type == 'True or False'){ ?>
                <input type="radio" name="answer" value="<?php echo $choice->choices; ?>"   >
                <span><?php echo $choice->choices; ?></span><br>
                <?php }?>
                <?php if ($data->type == 'Fill in the Blank'){ ?>
                    <input type="text" name="answer" class="form-control" placeholder="Input your answer" >
                <?php } } } ?>
            </div>
<!--                <br>-->
<!--                <button type="button" class="btn btn-default" onclick="plusDivs(-1)">&#10094;</button>-->
<!--                <button type="button" class="btn btn-default" onclick="plusDivs(+1)">&#10095;</button>-->
<!--                <br>-->
<!--                <br>-->
            </form>
<!--            </div>-->
        <?php }  ?>
        <div style="margin-bottom: 30px;margin-right: 20px">
            <input style="float: right;border-radius:0"  id="submitAll" class="btn btn-success"  type="button" value="Submit" onclick="submitForms()" >
        </div>

<!--            <ul class="pagination">-->
<!--                --><?php //for ($i = 1; $i <= count($question) ;$i++){ ?>
<!--                    <li><a href="#">--><?php //echo $i;?><!--</a></li>-->
<!--                --><?php //} ?>
<!--            </ul>-->

        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>

<script>
     function submitForms() {
         confirm('Are you sure you want submit this quiz/exam?');
        $('form').each(function() {
            var that = $(this);
            $.post(that.attr('action'), that.serialize());
        });
         window.location.href = "/elearning/class_group/createQuestion?q="+<?php echo $get_quiz[0]->id;?>;
    }
</script>

<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        if (n > x.length) {slideIndex = 1 }
        if (n < 1) {slideIndex = x.length} ;
        for (i = 0; i < x.length; i++) {
            console.log("ResponseText: " + x.length);
            x[i].style.display = "none";
        }

        x[slideIndex-1].style.display = "block";
    }
</script>

<?php

$minutes_to_add = $get_quiz[0]->time_limit;

$start_time = $get_quiz[0]->start;
$time = new DateTime($start_time);
$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

$stamp = $time->format('Y-m-d H:i:s');

?>

<script>
    // Set the date we're counting down to
    var countDownDate = new Date("<?php echo $stamp;?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "EXPIRED";
            $('form').each(function() {
                var that = $(this);
                $.post(that.attr('action'), that.serialize());
            });
            window.location.href = "/elearning/class_group/createQuestion?q="+<?php echo $get_quiz[0]->id;?>;
        }
    }, 1000);
</script>


