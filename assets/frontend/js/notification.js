// Comment Ajax
$(document).ready(function(){
    $(".btn-notify").click(function(){
        notify_btn_click();

    });
});

function notify_btn_click() {

    var _userId = $( "#userID" ).val();

        $.post( "/elearning/home/removeBadgeNotification",{
            task: "remove_badge",
            userId: _userId,
        }).error(
            function(  ) {
                console.log("Error");
            }
        ).success(
            function( data ) {
                console.log("ResponseText: " + data);
                $( ".notify-badge" ).val("");
            }
        );
        // console.log(" Group: " + _group + " User ID: " + _userId );

}
