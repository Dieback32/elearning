// Comment Ajax
$(document).ready(function(){
    $("#post-btn").click(function(){
        comment_post_btn_click();

    });
});

function comment_post_btn_click() {

    var _comment = $( "#comment-textarea" ).val();
    var _userId = $( "#userId" ).val();
    var _userName = $( "#userName" ).val();
    var _avatar = $("#avatar").val();
    var _group = $("#group_id").val();
    var _groupImage = $("#group_image").val();
    var _uri = $("#uri").val();

    if ( _comment.length > 0 && _userId != null){
        $('#comment-textarea').css('border','1px solid #ccc');

        $.post( "/elearning/class_group/commentAjax",{
            task: "comment_insert",
            userId: _userId,
            comment: _comment,
            name: _userName,
            avatar: _avatar,
            groupId: _group,
            group_image:_groupImage,
            uri:_uri
        }).error(
            function(  ) {
                console.log("Error");
            }
        ).success(
            function( data ) {
                comment_insert(jQuery.parseJSON(data));
                console.log("ResponseText: " + data);
            }
        );

        console.log( _comment + " Username: " + _userName + " User ID: " + _userId );
    }else{
        $('#comment-textarea').css('border','1px solid red');
        console.log("The text area was empty");
    }
    $( "#comment-textarea" ).val("");

}

function comment_insert(data) {

    var t = '';
    t += '<div class="clearfix row"></div>';
    t += '<div id="_'+data.comment_id+'" class="comment">';
    t += '<div class="user-image">';
    t += '<img src="'+data.profile_img+'" alt="Avatar">';
    t += '<strong style="padding-left: 15px" >'+data.userName+'</strong>';
    t += '</div>';
    t += '<div class="user-comment">';
    t += '<span>'+ data.comment+ '</span>';
    t += '</div>';
    t += '</div>';

    $('.comment-holder').prepend(t);
}