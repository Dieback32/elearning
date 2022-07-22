// Enable and Disable Radio Button
$(document).ready(function () {
    $('#parent').click(function () {
        $('#selparent').prop('disabled',this.checked);
    });
    $('#child').click(function () {
        $('#selparent').removeProp('disabled');
    });
});

// Checkbox Select All
$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

// Active Menu Button
$('.list, .ml-menu').on('click','li',function () {
    $('.list li.active, .ml-menu li.active').removeClass('active');
    $(this).addClass('active');
});

// Alert Message
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 4000);


// School Year Sort Ajax
$(document).ready(function(){
    $('#school-year').change(function () {
        var sy = $(this).val();
        var semester = $('#sem-subjects').val();
        $.ajax({
            url:"/elearning/dashboard/getSubjectBySY",
            method:"POST",
            data:{sy:sy,semester:semester},
            success:function (data) {
                $('#show-subject').html(data);
            }
        });

    });
});

$(document).ready(function(){
    $('#sem-subjects').change(function () {
        var semester = $(this).val();
        var sy = $('#school-year').val();
        $.ajax({
            url:"/elearning/dashboard/getSubjectBySY",
            method:"POST",
            data:{sy:sy,semester:semester},
            success:function (data) {
                $('#show-subject').html(data);
            }
        });

    });
});

//List of Students Report
$(document).ready(function(){
    $('#sy_select_list').change(function () {
        var school_year = $(this).val();
        var semester =  $('#select_sem').val();
        $.ajax({
            url:"/elearning/dashboard/getSubjectByYear",
            method:"POST",
            data:{school_year:school_year,semester:semester},
            success:function (data) {
                $('#reports-container-list').html(data);
            }
        });

    });
});
$(document).ready(function(){
    $('#select_sem').change(function () {
        var semester = $(this).val();
        var school_year =  $('#sy_select_list').val();
        $.ajax({
            url:"/elearning/dashboard/getSubjectByYear",
            method:"POST",
            data:{school_year:school_year,semester:semester},
            success:function (data) {
                $('#reports-container-list').html(data);
            }
        });

    });
});

// Student Grades
$(document).ready(function(){
    $('#sy_select_grades').change(function () {
        var school_year = $(this).val();
        var semester =  $('#select_sem').val();
        $.ajax({
            url:"/elearning/dashboard/getSubjectByYearReports",
            method:"POST",
            data:{school_year:school_year,semester:semester},
            success:function (data) {
                $('#reports-container-list').html(data);
            }
        });

    });
});
$(document).ready(function(){
    $('#select_sem').change(function () {
        var semester = $(this).val();
        var school_year =  $('#sy_select_grades').val();
        $.ajax({
            url:"/elearning/dashboard/getSubjectByYearReports",
            method:"POST",
            data:{school_year:school_year,semester:semester},
            success:function (data) {
                $('#reports-container-list').html(data);
            }
        });

    });
});



// Edit Instructor Ajax
$(document).ready(function(){
    $(document).on('click','.EditInstructor',function () {
        var instructor_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/dashboard/getInstructorsID",
            method:"POST",
            data:{instructor_id:instructor_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#ins_id').val(data.id);
                $('#id_no').val(data.id_number);
                $('#fname').val(data.fname);
                $('#lname').val(data.lname);
                $('#email').val(data.email);
            }
        });
    });
});
// Deactivating Instructor
$(document).ready(function(){
    $(document).on('click','.deactivateInstructor',function () {
        var instructor_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/dashboard/getInstructorsID",
            method:"POST",
            data:{instructor_id:instructor_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#id_ins').val(data.id);
            }
        });
    });
});

// Activating Instructor
$(document).ready(function(){
    $(document).on('click','.activateInstructor',function () {
        var instructor_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/dashboard/getInstructorsID",
            method:"POST",
            data:{instructor_id:instructor_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#id_instructor').val(data.id);
            }
        });
    });
});


// Edit Student Data
$(document).ready(function(){
    $(document).on('click','.EditStudent',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/dashboard/getStudentID",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#stud_id').val(data.id);
                $('#id_number').val(data.id_number);
                $('#fname').val(data.fname);
                $('#lname').val(data.lname);
                $('#email').val(data.email);
                $('#course').val(data.course);
                $('#year').val(data.year);
            }
        });
    });
});

//  Student's Personal Info
$(document).ready(function(){
    $(document).on('click','.infoStudent',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/dashboard/getStudentByID",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#studID').val(data.id);
                $('#city').val(data.city);
                $('#hometown').val(data.hometown);
                $('#mobile').val(data.mobile);
                $('#address').val(data.address);
                $('#birth').val(data.birth);
                $('#gender').val(data.gender);
            }
        });
    });
});


// Deactivating Student
$(document).ready(function(){
    $(document).on('click','.deactivateStudent',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/dashboard/getStudentID",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#id_student').val(data.id);
            }
        });
    });
});

// Activating Student
$(document).ready(function(){
    $(document).on('click','.activateStudent',function () {
        var student_id = $(this).attr("id");
        $.ajax({
            url:"/elearning/dashboard/getStudentID",
            method:"POST",
            data:{student_id:student_id},
            dataType:"json",
            success:function (data) {
                console.log("ResponseText: " + data.id);
                $('#id_students').val(data.id);
            }
        });
    });
});