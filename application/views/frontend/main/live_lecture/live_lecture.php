<style>
    video {
        height: 400px;
        width: 350px;
        margin-top: 10px;
        margin-bottom: 20px;
        position: relative;
    }
</style>
<div class="container" style="padding-top: 55px;">
    <div class="group-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>class_group/classWall?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/c7e1c249.png" width="25" height="25" alt=""> &nbsp;Class Wall</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_library?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/book library.png" alt="" width="20" height="20"> &nbsp;&nbsp;Class Library</a></li>
            <li><a href="<?php echo site_url()?>class_group/class_discussion?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/Grafikartes-Flat-Retro-Modern-Messages.ico" alt="" width="20" height="20"> &nbsp;&nbsp;Class Discussion</a></li>
            <li><a href="<?php echo site_url()?>class_group/quizAndExam?id=<?php echo $group[0]->id;?>" ><img src="<?php echo base_url()?>assets/frontend/images/icon_045780_256.png" alt="" width="20" height="20"> &nbsp;&nbsp;Quizzes & Exams</a></li>
            <li><a href="<?php echo site_url()?>class_group/projects?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/project.png" alt="" width="20" height="20"> &nbsp;&nbsp;Projects</a></li>
            <li><a href="<?php echo site_url()?>class_group/live_lecture?id=<?php echo $group[0]->id;?>" class="active-link"><img src="<?php echo base_url()?>assets/frontend/images/download.png" alt="" width="20" height="20"> &nbsp;&nbsp;Live Lecture</a></li>
            <li><a href="<?php echo site_url()?>class_group/members?id=<?php echo $group[0]->id;?>" class=""><img src="<?php echo base_url()?>assets/frontend/images/member.png" alt="" width="20" height="20"> &nbsp;&nbsp;Members</a></li>
        </ul>
        <div class="row clearfix"></div>
    </div>
    <div class="wall-content">
        <div class="grade-header">
            <h4 style="margin-left: 12px;">Live Lecture</h4>
        </div>
        <div class="class-wall-container">
            <div id="container">
<!--                --><?php //if ($this->session->userdata('authorization') == 'instructor'){ ?>
<!--                    <video id="localVideo" autoplay muted width="300" height="300" style="background: #0a0a0a;position: relative"></video>-->
<!--                --><?php //}?>
<!--               --><?php //if ($this->session->userdata('authorization') == 'student'){ ?>
<!--                   <div style="width: 300px;height: 200px;border: 1px solid grey;float: right;" id="speech-result"></div>-->
<!--                <video id="remoteVideo" width="300" height="300" style="background: #0a0a0a;" autoplay></video>-->
<!--               --><?php //}?>
<!--                --><?php //if ($this->session->userdata('authorization') == 'instructor'){ ?>
<!--                    <div>-->
<!--                        <button class="btn btn-default" id="startButton">Start</button>-->
<!--                        <button class="btn btn-success" id="callButton">Call</button>-->
<!--                        <button class="btn btn-danger" id="hangupButton">Hang Up</button>-->
<!--                    </div>-->
<!--                --><?php //}?>
                <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
                    <input type="hidden" id="instructorID" value="<?php echo $this->session->userdata('id');?>">
                    <input type="hidden" id="groupID" value="<?php echo $group[0]->id;?>">
                    <div style="float: right;position: relative; width: 270px;height: 300px;border: 1px solid #dddfe2;overflow-y: scroll;margin-bottom: 20px; margin-top: 40px;" id="speech-result"></div>
                    <button class="btn btn-default"  onclick="startConverting();" style="color: black; border-radius: 60%;"><i class="fa fa-microphone fa-lg"></i></button>
                <?php }else{ ?>
                    <div style="float: right;position: relative; width: 270px;height: 300px;border: 1px solid #dddfe2;overflow-y: scroll;margin-bottom: 20px; margin-top: 40px;" id="student-speech"></div>
                <?php }?>
                <input id="txt-roomid">
                <button class="btn btn-success" id="btn-open-or-join-room">Stream or Join</button>
                <div id="videos-container"></div>

            </div>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>


<!--<script src="--><?php //echo base_url();?><!--assets/frontend/js/webrtc/adapter-latest.js"></script>-->
<!--<script src="--><?php //echo base_url();?><!--assets/frontend/js/webrtc/common.js"></script>-->
<!--<script src="--><?php //echo base_url();?><!--assets/frontend/js/webrtc/main.js"></script>-->
<!--<script src="--><?php //echo base_url();?><!--assets/frontend/js/webrtc/ga.js"></script>-->
<!--Live Lecture JS-->
<script src="<?php echo base_url();?>assets/frontend/js/RTCMultiConnection.min.js"></script>
<script src="<?php echo base_url();?>assets/frontend/js/socket.io.js"></script>
<script>
    var connection = new RTCMultiConnection();

    // this line is VERY_important
    connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';

    // all below lines are optional; however recommended.

    connection.session = {
        audio: true,
        video: true
    };

    connection.sdpConstraints.mandatory = {
        OfferToReceiveAudio: true,
        OfferToReceiveVideo: true
    };

    var videosContainer = document.getElementById('videos-container');
    connection.onstream = function (event) {
      var video = event.mediaElement;

      videosContainer.appendChild(video);
    };

    var roomid = document.getElementById('txt-roomid');

    roomid.value = connection.token();


    document.getElementById('btn-open-or-join-room').onclick = function() {
        this.disabled = true;
        connection.openOrJoin( roomid.value || 'predefiend-roomid' );
    };

</script>
