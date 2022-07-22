$(document).ready(function(){
    // Add scrollspy to <body>
    $('body').scrollspy({target: ".navbar", offset: 50});

    // Add smooth scrolling on all links inside the navbar
    $("#myNavbar a").on('click', function(event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        }  // End if
    });
});


// Scrolltop
$(document).ready(function(){
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    $('#back-to-top').tooltip('show');
});

// Active Menu Button
$('.menu-list').on('click','a',function () {
    $('.menu-list a.active-link').removeClass('active-link');
    $(this).addClass('active-link');
});

//DataTables
$(document).ready(function() {
    $('#class-groups-table').DataTable();
} );

$(document).ready(function() {
    $('#class-grade').DataTable();
} );

$(document).ready(function() {
    $('#grade-prelim').DataTable();
} );

$(document).ready(function() {
    $('#grade-midterm').DataTable();
} );

$(document).ready(function() {
    $('#grade-prefinal').DataTable();
} );
$(document).ready(function() {
    $('#grade-finals').DataTable();
} );

// DateTime Picker
$(document).ready(function() {
    $('#start_date').datetimepicker({
        format: "yyyy",
        startView: 'decade',
        minView: 'decade',
        viewSelect: 'decade',
        autoclose: true,
    });
    $('#edit-start_date').datetimepicker();
    $('#event-date').datetimepicker();
    $('#event-datetime').datetimepicker();
    $('#prelimTime').datetimepicker();
    $('#midtermTime').datetimepicker();
    $('#prefinalTime').datetimepicker();
    $('#finalsTime').datetimepicker();
} );

// Checkbox Select All
$(".checkAlldata").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
// Alert Message
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 3000);

// Video Arrow
$(document).ready(function () {
    $(".arrow-right").bind("click", function (event) {
        event.preventDefault();
        $(".vid-list-container").stop().animate({
            scrollLeft: "+=336"
        }, 750);
    });
    $(".arrow-left").bind("click", function (event) {
        event.preventDefault();
        $(".vid-list-container").stop().animate({
            scrollLeft: "-=336"
        }, 750);
    });

    // Video Load

    $(document).on('click','.vid-item',function () {

        var video_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getVideoDetails",
            method:"POST",
            data:{video_id:video_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#video-ID').val(data.video);
                $('.vid-container').load('/elearning/class_group/play_videos');
                // document.getElementById('vid_play').src= $('#uri').val() + data.video;
            }
        });
    });
});

// User Profile Ajax
$(document).ready(function(){
    $(".overview").click(function(){
        $("#result").load("userprofile/overview", function(responseTxt, statusTxt, jqXHR){
            // if(statusTxt == "success"){
            //     alert("New content loaded successfully!");
            // }
            if(statusTxt == "error"){
                alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
            }
        });
    });
    $(".place").click(function(){
        $("#result").load("userprofile/place", function(responseTxt, statusTxt, jqXHR){
            // if(statusTxt == "success"){
            //     alert("New content loaded successfully!");
            // }
            if(statusTxt == "error"){
                alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
            }
        });
    });
    $(".contact").click(function(){
        $("#result").load("userprofile/contact", function(responseTxt, statusTxt, jqXHR){
            // if(statusTxt == "success"){
            //     alert("New content loaded successfully!");
            // }
            if(statusTxt == "error"){
                alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
            }
        });
    });
    $(".info").click(function(){
        $("#result").load("userprofile/info", function(responseTxt, statusTxt, jqXHR){
            // if(statusTxt == "success"){
            //     alert("New content loaded successfully!");
            // }
            if(statusTxt == "error"){
                alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
            }
        });
    });

    $(".about").click(function(){
        $("#result").load("userprofile/about", function(responseTxt, statusTxt, jqXHR){
            // if(statusTxt == "success"){
            //     alert("New content loaded successfully!");
            // }
            if(statusTxt == "error"){
                alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
            }
        });
    });
});

// Class Group Option Ajax
$(document).ready(function(){
    $(".create-group").click(function(){
        $(".group-content").load("class_group/create_classgroup", function(responseTxt, statusTxt, jqXHR){
            // if(statusTxt == "success"){
            //     alert("New content loaded successfully!");
            // }
            if(statusTxt == "error"){
                alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
            }
        });
    });
    $(".select-group").click(function(){
        $(".group-content").load("class_group/select_classgroup", function(responseTxt, statusTxt, jqXHR){
            // if(statusTxt == "success"){
            //     alert("New content loaded successfully!");
            // }
            if(statusTxt == "error"){
                alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
            }
        });
    });
    $(".join-group").click(function(){
        $(".group-content").load("class_group/joinGroup", function(responseTxt, statusTxt, jqXHR){
            // if(statusTxt == "success"){
            //     alert("New content loaded successfully!");
            // }
            if(statusTxt == "error"){
                alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
            }
        });
    });
    $(".student-group").click(function(){
        $(".group-content").load("class_group/studentGroup", function(responseTxt, statusTxt, jqXHR){
            // if(statusTxt == "success"){
            //     alert("New content loaded successfully!");
            // }
            if(statusTxt == "error"){
                alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
            }
        });
    });
});

// Change Password Ajax

$(document).ready(function(){
    $('#change-password').on('submit',function () {
        if ( $('#new').val() != $('#confirm').val() ) {
            document.getElementById("new").style.borderColor = "#E34234";
            document.getElementById("confirm").style.borderColor = "#E34234";
            document.getElementById('error-pass').innerHTML = "* The New Password and Re-type Password field does not match";
            event.preventDefault();
        }
    });

});

//Event Edit and Delete Ajax
$(document).ready(function(){
    $(document).on('click','.editEvent',function () {
        var event_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/home/getEventDetails",
            method:"POST",
            data:{event_id:event_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#event-id').val(data.id);
                $('#event-photo').val(data.photo);
                $('#event-name').val(data.name);
                $('#event-location').val(data.location);
                $('#event-datetime').val(data.date);
                $('#event-desc').val(data.description);
            }
        });
    });

    $('#event-edit').on('submit',function () {
        if ( $('#event-datetime').val() <= $('#present-date').val() ) {
            document.getElementById("event-datetime").style.borderColor = "#E34234";
            document.getElementById('event-error').innerHTML = "* The Date should be in the future.";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/home/editEvent",
                method:"POST",
                data:$('#event-edit').serialize(),
                success:function () {
                    // $('#edit_quiz')[0].reset();
                    $('#edit-event').modal('hide');
                }
            });
        }
    });


    $(document).on('click','.deleteEvent',function () {
        var event_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/home/getEventDetails",
            method:"POST",
            data:{event_id:event_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#id_event').val(data.id);
            }
        });
    });

    $('#event-delete').on('submit',function () {
        $.ajax({
            url:"/elearning/home/deleteEvent",
            method:"POST",
            data:$('#event-delete').serialize(),
            success:function () {
                $('#delete-event').modal('hide');
            }
        });
    });


});

// Message Page Count Ajax
$(document).ready(function(){
    $(document).on('click','.group-chat-count',function () {
        var group_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/messages/countGroupChat",
            method:"POST",
            data:{group_id:group_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.count);
            }
        });
    });

});

// Message Page Ajax
$(document).ready(function(){
    $(document).on('click','.select-chat',function () {
        var user_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/messages/getUsersID",
            method:"POST",
            data:{user_id:user_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#users_id').val(data.id);
                $("#fname").html(data.fname);
                $('#lname').html(data.lname);
                $('#course').html(data.course);
                $('#year').html(data.year);
                $('#city').html(data.city);
                $('#hometown').html(data.hometown);
            }
        });
    });

});

// Chat execution Ajax
$(document).ready(function () {
    $('#userMsg').keyup(function (e) {
        if(e.keyCode == 13){
            var user_id = $('#user').val();
            var chatText = $('#userMsg').val();
            var groupID = $('#group_Id').val();
            var image = $('#image_user').val();
            var uri = $('#chat_uri').val();
            $.ajax({
                type:"POST",
                url:"/elearning/messages/insertMessageChat",
                data:{chatText:chatText,user_id:user_id,groupID:groupID,image:image,uri:uri},
                success:function () {
                    console.log(groupID);
                    window.location.href = "/elearning/class_group/class_discussion?id="+groupID;
                    // console.log("ResponseText: " + chatText);
                    // $('._chatbox-content').load('/elearning/messages/chat_message');
                    $('#userMsg').val("");
                    // $("#msg").animate({ scrollTop: $(document).height() }, "slow");
                }
            });

        }
    });

    setInterval(function () {
        $('._chatbox-content').load('/elearning/messages/chat_message');
    },1200);
    // $('._chatbox-content').animate({ scrollTop: $('._chatbox-content').height() }, "slow");

});

//Limited Message
$("#notify-msg").text(function(index, currentText) {
    return currentText.substr(0, 20)+'...';
});


//Notification Read and Unread
$(document).ready(function(){
    $(document).on('click','.unread_read',function () {
        var notify_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/home/changeUnread",
            method:"POST",
            data:{notify_id:notify_id},
            success:function (data) {
                console.log("ResponseText: " + notify_id);
            }
        });
    });
});



// Speech Recognition
var r = document.getElementById('userMsg');

function startConverting() {

    if('webkitSpeechRecognition' in window){
        var speechRecognizer = new webkitSpeechRecognition();
        speechRecognizer.continuous = true;
        speechRecognizer.interimResults = true;
        speechRecognizer.lang = 'fil-PH','en-US';
        speechRecognizer.start();

        var finalTranscripts = '';

        speechRecognizer.onresult = function (event) {
            var interimTranscript = '';
            for (var i = event.resultIndex;i < event.results.length; i++){
                var transcript = event.results[i][0].transcript;
                transcript.replace("\n","<br>");
                if (event.results[i].isFinal){
                    finalTranscripts += transcript;
                }else{
                    interimTranscript += transcript;
                }

            }

            r.innerHTML = finalTranscripts + interimTranscript;


            // var groupId = $('#groupID').val();
            // var user_id = $('#instructorID').val();
            // var speech = finalTranscripts + interimTranscript;
            // $.ajax({
            //     type:"POST",
            //     url:"/elearning/messages/speechToText",
            //     data:{speech:speech,user_id:user_id,groupId:groupId},
            //     success:function () {
            //         console.log("ResponseText: " + groupId);
            //     }
            // });
        };

        speechRecognizer.onerror = function (event) {

        };
    } else{
        r.innerHTML = 'Your browser is not supported.'
    }
}

// $(document).ready(function () {
//     setInterval(function () {
//         $('#student-speech').load('/elearning/messages/textDisplay');
//     },1200);
// });


//Exam Summary
$(document).ready(function(){
    $(document).on('click','.examSummary',function () {
        var user_id = $(this).attr("id");
        var quiz_id = $('#quizID').val();
        $.ajax({
            url:"/elearning/class_group/getExamSummary",
            method:"POST",
            data:{user_id:user_id,quiz_id:quiz_id},
            success:function (data) {
                console.log("ResponseText: " + user_id);
                $('#questions-container').html(data);
            }
        });
    });
});

// Create Update Delete Questions Ajax
$(document).ready(function(){
    $('#type').change(function () {
        var type = $(this).val();
        $.ajax({
            url:"/elearning/class_group/addQuestion",
            method:"POST",
            data:{type:type},
            success:function (data) {
                $('#show-question').html(data);
            }
        });
    });
// Edit Question
    $(document).on('click','.QuestionEdit',function () {
        var question_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getQuestion",
            method:"POST",
            data:{question_id:question_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.type);
                $('#question_ID').val(data.id);
                $('#type-question').val(data.type);
                $('#questions').val(data.question);
                $('#show-edit-question').html(data.preview);
            }
        });
    });

    $('#type-question').change(function () {
        var type = $(this).val();
        $.ajax({
            url:"/elearning/class_group/addQuestion",
            method:"POST",
            data:{type:type},
            success:function (data) {
                $('#show-edit-question').html(data);
            }
        });
    });
// Delete Question
    $(document).on('click','.QuestionDelete',function () {
        var question_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getQuestion",
            method:"POST",
            data:{question_id:question_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#questionID').val(data.id);
            }
        });
    });


});

// Search Questions Ajax
$(document).ready(function(){
    $('.search-quiz').keyup(function () {
        var txt = $(this).val();
        var group_id = $(this).attr("id");
        $('#result').html('');
        $.ajax({
            url:'/elearning/class_group/searchQuiz',
            method:"POST",
            data:{search:txt,group_id:group_id},
            dataType:"text",
            success:function (data) {
                $('#result').html(data);
            }
        });
    });
});




// Search Project in Prelim Ajax
$(document).ready(function(){
    $('.search-prelim-project').keyup(function () {
        var txt = $(this).val();
        var group_id = $(this).attr("id");
        $('#project-result').html('');
        $.ajax({
            url:'/elearning/class_group/searchProjectPrelim',
            method:"POST",
            data:{search:txt,group_id:group_id},
            dataType:"text",
            success:function (data) {
                $('#project-prelim-result').html(data);
            }
        });
    });
});

// Search Project in Midterm Ajax
$(document).ready(function(){
    $('.search-midterm-project').keyup(function () {
        var txt = $(this).val();
        var group_id = $(this).attr("id");
        $('#project-midterm-result').html('');
        $.ajax({
            url:'/elearning/class_group/searchProjectMidterm',
            method:"POST",
            data:{search:txt,group_id:group_id},
            dataType:"text",
            success:function (data) {
                $('#project-midterm-result').html(data);
            }
        });
    });
});

// Search Project in Prefinal Ajax
$(document).ready(function(){
    $('.search-prefinal-project').keyup(function () {
        var txt = $(this).val();
        var group_id = $(this).attr("id");
        $('#project-prefinal-result').html('');
        $.ajax({
            url:'/elearning/class_group/searchProjectPrefinal',
            method:"POST",
            data:{search:txt,group_id:group_id},
            dataType:"text",
            success:function (data) {
                $('#project-prefinal-result').html(data);
            }
        });
    });
});

// Search Project in Finals Ajax
$(document).ready(function(){
    $('.search-finals-project').keyup(function () {
        var txt = $(this).val();
        var group_id = $(this).attr("id");
        $('#project-finals-result').html('');
        $.ajax({
            url:'/elearning/class_group/searchProjectFinals',
            method:"POST",
            data:{search:txt,group_id:group_id},
            dataType:"text",
            success:function (data) {
                $('#project-finals-result').html(data);
            }
        });
    });
});


// Grading Sheet JS
$(document).ready(function(){
    $(".grading-sheet").click(function(){
        $(".grade-container").load("grading_sheet/groupList", function(responseTxt, statusTxt, jqXHR){
            // if(statusTxt == "success"){
            //     alert("New content loaded successfully!");
            // }
            if(statusTxt == "error"){
                alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
            }
        });
    });
});
// Edit Delete Upload Class Group Ajax
$(document).ready(function(){
    $(document).on('click','.editGroup',function () {
        var group_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getGroups",
            method:"POST",
            data:{group_id:group_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#name').val(data.name);
                $('#group_id').val(data.id);
            }
        });
    });

    $('#edit-group-name').on('submit',function () {
        $.ajax({
            url:"/elearning/class_group/editGroup",
            method:"POST",
            data:$('#edit-group-name').serialize(),
            success:function (data) {
                $('#edit-name').modal('hide');
                $('.group-list-data').html(data);
            }
        });
    });

    $(document).on('click','.uploadPhotos',function () {
        var group_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getGroups",
            method:"POST",
            data:{group_id:group_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#id_group').val(data.id);
            }
        });
    });

    $(document).on('click','.deleteGroup',function () {
        var group_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getGroups",
            method:"POST",
            data:{group_id:group_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#gID').val(data.id);
            }
        });
    });

    $('#delete-group').on('submit',function () {
        $.ajax({
            url:"/elearning/class_group/deleteGroup",
            method:"POST",
            data:$('#delete-group').serialize(),
            success:function (data) {
                $('#delete_group').modal('hide');
                $('.group-list-data').html(data);
            }
        });
    });

});

// Disable the button in Quiz
$(document).ready(function(){

    if($('#present_time').val() > $('#check_start').val()){
        document.getElementById("start-btn-quiz").disabled = true;
        document.getElementById("add-btn-quiz").disabled = true;
        jQuery('.edit-delete-quiz').hide();
    }

});

// Quiz/Exam Ajax
$(document).ready(function(){

    $(document).on('click','.QuizDelete',function () {
        var quiz_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getQuiz",
            method:"POST",
            data:{quiz_id:quiz_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#id_quiz').val(data.id);
            }
        });
    });

    $('#delete_quiz').on('submit',function () {
        $.ajax({
            url:"/elearning/class_group/deleteQuiz",
            method:"POST",
            data:$('#delete_quiz').serialize(),
            success:function (data) {
                // $('#edit_quiz')[0].reset();
                $('#delete-modal').modal('hide');
                $('.quiz-list-content').html(data);
            }
        });
    });

    $(document).on('click','.QuizEdit',function () {
        var quiz_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getQuiz",
            method:"POST",
            data:{quiz_id:quiz_id},
            dataType:"json",
            success:function (data) {
                $('#edit-quiz_name').val(data.name);
                $('#edit-term').val(data.term);
                $('#edit-type').val(data.type);
                $('#edit-start_date').val(data.start);
                $('#edit-limit').val(data.end);
                $('#edit-post').val(data.post);
                $('#quiz_id').val(data.id);
            }
        });
    });

    $('#edit_quiz').on('submit',function () {
        if ( $('#edit-start_date').val() <= $('#present').val() ) {
            document.getElementById("edit-start_date").style.borderColor = "#E34234";
            document.getElementById('edit-start-error').innerHTML = "* The Start date must not be less than in Present date";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/class_group/editQuiz",
                method:"POST",
                data:$('#edit_quiz').serialize(),
                success:function (data) {
                    // $('#edit_quiz')[0].reset();
                    $('#edit-modal').modal('hide');
                    $('.quiz-list-content').html(data);
                }
            });
        }

    });
    //Automatic
    $('#insert_quiz').on('submit',function () {
        if ( $('#start_date').val() <= $('#present').val() ) {
            document.getElementById("start_date").style.borderColor = "#E34234";
            document.getElementById('start-error').innerHTML = "* The Start date must not be less than in Present date";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/class_group/createQuiz",
                method:"POST",
                data:$('#insert_quiz').serialize(),
                success:function (data) {
                    $('#insert_quiz')[0].reset();
                    $('#AddQuiz').modal('hide');
                    $('.quiz-list-content').html(data);
                }
            });
        }

    });
    //Manual
    $('#insert_quiz_manual').on('submit',function () {
        $.ajax({
            url:"/elearning/class_group/createQuizManual",
            method:"POST",
            data:$('#insert_quiz_manual').serialize(),
            success:function (data) {
                $('#insert_quiz')[0].reset();
                $('#manualQuiz').modal('hide');
                $('.quiz-list-content').html(data);
            }
        });
    });


});

// Start of Exam/Quiz
$(document).ready(function () {
    $(document).on('click','.startOfQuizExam',function () {
        var id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/manualStartOfQuiz",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.start);
                $('#msg').html(data.msg);
            }
        });
    });

});

// Project Deadline
$(document).ready(function(){
    //Prelim Deadline Project
    $(document).on('click','.prelimDeadline',function () {
        var group_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getSubjectInfo",
            method:"POST",
            data:{group_id:group_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#prelim_gid').val(data.id);
                $('#prelim_sid').val(data.subject_id);
            }
        });
    });

    $('#deadlinePrelim').on('submit',function () {
        if ( $('#prelimTime').val() < $('#presentPrelim').val() ) {
            document.getElementById("prelimTime").style.borderColor = "#E34234";
            document.getElementById("deadline-pre-error").innerHTML = "* The Deadline should be in the future.";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/class_group/setDeadlinePrelim",
                method:"POST",
                data:$('#deadlinePrelim').serialize(),
                success:function () {
                    $('#prelimDeadline').modal('hide');
                }
            });
        }

    });

    //Midterm Deadline Project
    $(document).on('click','.midtermDeadline',function () {
        var group_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getSubjectInfo",
            method:"POST",
            data:{group_id:group_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#midterm_gid').val(data.id);
                $('#midterm_sid').val(data.subject_id);
            }
        });
    });

    $('#deadlineMidterm').on('submit',function () {
        if ( $('#midtermTime').val() < $('#presentMidterm').val() ) {
            document.getElementById("midtermTime").style.borderColor = "#E34234";
            document.getElementById("deadline-mid-error").innerHTML = "* The Deadline should be in the future.";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/class_group/setDeadlineMidterm",
                method:"POST",
                data:$('#deadlineMidterm').serialize(),
                success:function () {
                    $('#midtermDeadline').modal('hide');
                }
            });
        }

    });
    //Prefinal Deadline Project

    $(document).on('click','.prefinalDeadline',function () {
        var group_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getSubjectInfo",
            method:"POST",
            data:{group_id:group_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#prefinal_gid').val(data.id);
                $('#prefinal_sid').val(data.subject_id);
            }
        });
    });

    $('#deadlinePrefinal').on('submit',function () {
        if ( $('#prefinalTime').val() < $('#presentPrefinal').val() ) {
            document.getElementById("prefinalTime").style.borderColor = "#E34234";
            document.getElementById("deadline-prefinal-error").innerHTML = "* The Deadline should be in the future.";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/class_group/setDeadlinePrefinal",
                method:"POST",
                data:$('#deadlinePrefinal').serialize(),
                success:function () {
                    $('#prefinalDeadline').modal('hide');
                }
            });
        }

    });
    //Finals Deadline Project

    $(document).on('click','.finalsDeadline',function () {
        var group_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getSubjectInfo",
            method:"POST",
            data:{group_id:group_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#finals_gid').val(data.id);
                $('#finals_sid').val(data.subject_id);
            }
        });
    });

    $('#deadlineFinals').on('submit',function () {
        if ( $('#finalsTime').val() < $('#presentFinals').val() ) {
            document.getElementById("finalsTime").style.borderColor = "#E34234";
            document.getElementById("deadline-finals-error").innerHTML = "* The Deadline should be in the future.";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/class_group/setDeadlineFinals",
                method:"POST",
                data:$('#deadlineFinals').serialize(),
                success:function () {
                    $('#finalsDeadline').modal('hide');
                }
            });
        }

    });

});
// Project Ajax
$(document).ready(function(){
// Prelim Project
    $(document).on('click','.prelimProject',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsPrelim",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#student_id').val(data.id);
                $('#prelim-remarks').val(data.remarks);
            }
        });
    });

    $('#remarks-prelim').on('submit',function () {
        if ( $('#prelim-remarks').val() <= 65 ) {
            document.getElementById("prelim-remarks").style.borderColor = "#E34234";
            document.getElementById("prelim-error").innerHTML = "* Remarks should be greater than 65";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/class_group/inputPrelimProject",
                method:"POST",
                data:$('#remarks-prelim').serialize(),
                success:function (data) {
                    $('#prelimRemarks').modal('hide');
                }
            });
        }

    });

    // Midterm Project
    $(document).on('click','.midtermProject',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsMidterm",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#studentID').val(data.id);
                $('#midterm-remarks').val(data.remarks);
            }
        });
    });

    $('#remarks-midterm').on('submit',function () {
        if ( $('#midterm-remarks').val() <= 65 ) {
            document.getElementById("midterm-remarks").style.borderColor = "#E34234";
            document.getElementById("midterm-error").innerHTML = "* Remarks should be greater than 65";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/class_group/insertMidtermProject",
                method:"POST",
                data:$('#remarks-midterm').serialize(),
                success:function (data) {
                    $('#midtermRemarks').modal('show');
                }
            });
        }

    });

    // Prefinal Project
    $(document).on('click','.prefinalProject',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsPrefinal",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#studentId').val(data.id);
                $('#prefinal-remarks').val(data.remarks);
            }
        });
    });

    $('#remarks-prefinal').on('submit',function () {
        if ( $('#prefinal-remarks').val() <= 65 ) {
            document.getElementById("prefinal-remarks").style.borderColor = "#E34234";
            document.getElementById("prefinal-error").innerHTML = "* Remarks should be greater than 65";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/class_group/insertPrefinalProject",
                method:"POST",
                data:$('#remarks-prefinal').serialize(),
                success:function () {
                    $('#prefinalRemarks').modal('show');
                }
            });
        }

    });

    // Finals Project
    $(document).on('click','.finalsProject',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsFinals",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#id_student').val(data.id);
                $('#finals-remarks').val(data.remarks);
            }
        });
    });

    $('#remarks-finals').on('submit',function () {
        if ( $('#finals-remarks').val() <= 65 ) {
            document.getElementById("finals-remarks").style.borderColor = "#E34234";
            document.getElementById("finals-error").innerHTML = "* Remarks should be greater than 65";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/class_group/insertFinalsProject",
                method:"POST",
                data:$('#remarks-finals').serialize(),
                success:function () {
                    $('#finalsRemarks').modal('show');
                }
            });
        }

    });
});

//Participation
$(document).ready(function () {
    // Prelim Participation
    $(document).on('click','.prelimPart',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsPrelim",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#std_ID').val(data.id);
                $('#participation-prelim').val(data.participation);
            }
        });
    });

    $('#part-prelim').on('submit',function () {
        if ( $('#participation-prelim').val() <= 65 ) {
            document.getElementById("participation-prelim").style.borderColor = "#E34234";
            document.getElementById("partPrelim-error").innerHTML = "* Remarks should be greater than 65";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/grading_sheet/prelimParticipation",
                method:"POST",
                data:$('#part-prelim').serialize(),
                success:function () {
                    $('#prelimParticipaition').modal('hide');
                }
            });
        }
    });
    // Midterm Participation
    $(document).on('click','.midtermPart',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsMidterm",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#std_Id').val(data.id);
                $('#participation-midterm').val(data.participation);
            }
        });
    });

    $('#part-midterm').on('submit',function () {
        if ( $('#participation-midterm').val() <= 65 ) {
            document.getElementById("participation-midterm").style.borderColor = "#E34234";
            document.getElementById("partMidterm-error").innerHTML = "* Remarks should be greater than 65";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/grading_sheet/midtermParticipation",
                method:"POST",
                data:$('#part-midterm').serialize(),
                success:function () {
                    $('#midtermParticipaition').modal('hide');
                }
            });
        }
    });
    // Prefinal Participation
    $(document).on('click','.prefinalPart',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsPrefinal",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#stdId').val(data.id);
                $('#participation-prefinal').val(data.participation);
            }
        });
    });

    $('#part-prefinal').on('submit',function () {
        if ( $('#participation-prefinal').val() <= 65 ) {
            document.getElementById("participation-prefinal").style.borderColor = "#E34234";
            document.getElementById("partPrefinal-error").innerHTML = "* Remarks should be greater than 65";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/grading_sheet/prefinalParticipation",
                method:"POST",
                data:$('#part-prefinal').serialize(),
                success:function () {
                    $('#prefinalParticipaition').modal('hide');
                }
            });
        }
    });
    // Finals Participation
    $(document).on('click','.finalsPart',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsFinals",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#stdID').val(data.id);
                $('#participation-finals').val(data.participation);
            }
        });
    });

    $('#part-finals').on('submit',function () {
        if ( $('#participation-finals').val() <= 65 ) {
            document.getElementById("participation-finals").style.borderColor = "#E34234";
            document.getElementById("partFinals-error").innerHTML = "* Remarks should be greater than 65";
            event.preventDefault();
        }else {
            $.ajax({
                url:"/elearning/grading_sheet/finalsParticipation",
                method:"POST",
                data:$('#part-finals').serialize(),
                success:function () {
                    $('#finalsParticipaition').modal('hide');
                }
            });
        }
    });
});

//Exam Score Manual
$(document).ready(function () {

    //Prelim
    $(document).on('click','.prelimExamScoreStudent',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsFinals",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#std-exam-prelim').val(data.id);
            }
        });
    });

    $('#prelim-exam-score').on('submit',function () {
        if ($('#exam_prelim-score').val() <= 0){
            document.getElementById("exam_prelim-score").style.borderColor = "#E34234";
            document.getElementById("exam-div-score").innerHTML = "* Score must be greater-than 0";
            event.preventDefault();
        }else if($('#prelim-totalitems').val() < $('#exam_prelim-score').val()){
            document.getElementById("exam_prelim-score").style.borderColor = "#E34234";
            document.getElementById("exam-div-score").innerHTML = "* Score must be less-than the Total items.";
            event.preventDefault();
        }else{
            $.ajax({
                url:"/elearning/grading_sheet/prelimExamScore",
                method:"POST",
                data:$('#prelim-exam-score').serialize(),
                success:function () {
                    $('#prelimExamScore').modal('hide');
                }
            });
        }
    });

    //Midterm
    $(document).on('click','.midtermExamScoreStudent',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsFinals",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#std-exam-midterm').val(data.id);
            }
        });
    });

    $('#midterm-exam-score').on('submit',function () {
        if ($('#exam_midterm-score').val() <= 0){
            document.getElementById("exam_midterm-score").style.borderColor = "#E34234";
            document.getElementById("exam-div-score-mid").innerHTML = "* Score must be greater-than 0.";
            event.preventDefault();
        }else if($('#midterm-totalitems').val() < $('#exam_midterm-score').val()){
            document.getElementById("exam_midterm-score").style.borderColor = "#E34234";
            document.getElementById("exam-div-score-mid").innerHTML = "* Score must be less-than the Total items.";
            event.preventDefault();
        }else{
            $.ajax({
                url:"/elearning/grading_sheet/midtermExamScore",
                method:"POST",
                data:$('#midterm-exam-score').serialize(),
                success:function () {
                    $('#midtermExamScore').modal('hide');
                }
            });
        }
    });

    //Prefinal
    $(document).on('click','.prefinalExamScoreStudent',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsFinals",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#std-exam-prefinal').val(data.id);
            }
        });
    });

    $('#prefinal-exam-score').on('submit',function () {
        if ($('#exam_prefinal-score').val() <= 0){
            document.getElementById("exam_prefinal-score").style.borderColor = "#E34234";
            document.getElementById("exam-div-score-pre").innerHTML = "* Score must be greater-than 0.";
            event.preventDefault();
        }else if($('#prefinal-totalitems').val() < $('#exam_prefinal-score').val()){
            document.getElementById("exam_prefinal-score").style.borderColor = "#E34234";
            document.getElementById("exam-div-score-pre").innerHTML = "* Score must be less-than the Total items.";
            event.preventDefault();
        }else{
            $.ajax({
                url:"/elearning/grading_sheet/prefinalExamScore",
                method:"POST",
                data:$('#prefinal-exam-score').serialize(),
                success:function () {
                    $('#prefinalExamScore').modal('hide');
                }
            });
        }
    });

    //Finals
    $(document).on('click','.finalsExamScoreStudent',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getStudentsFinals",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#std-exam-finals').val(data.id);
            }
        });
    });

    $('#finals-exam-score').on('submit',function () {
        if ($('#exam_finals-score').val() <= 0){
            document.getElementById("exam_finals-score").style.borderColor = "#E34234";
            document.getElementById("exam-div-score-finals").innerHTML = "* Score must be greater-than 0";
            event.preventDefault();
        }else if($('#finals-totalitems').val() < $('#exam_finals-score').val()){
            document.getElementById("exam_finals-score").style.borderColor = "#E34234";
            document.getElementById("exam-div-score-finals").innerHTML = "* Score must be less-than the Total items.";
            event.preventDefault();
        }else{
            $.ajax({
                url:"/elearning/grading_sheet/finalsExamScore",
                method:"POST",
                data:$('#finals-exam-score').serialize(),
                success:function () {
                    $('#finalsExamScore').modal('hide');
                }
            });
        }
    });


});

//Delete Library File
$(document).ready(function () {
    $(document).on('click','.deleteLibraryItems',function () {
        var file_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/class_group/getLibraryFiles",
            method:"POST",
            data:{file_id:file_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#file_id').val(data.id);
            }
        });
    });
});