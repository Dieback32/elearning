function submitChat() {
    var user = $('#user').val();
    var msg = $('#msg').val();
    var xmlhttp = new XMLHttpRequest();

    XMLHttpRequest.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
                document.getElementById('chatlogs').innerHTML == xmlhttp.responseText;
        }
        xmlhttp.open('GET','/elearning/messages/insertChat'+ 'user=' + user + '&msg=' + msg,true);
        xmlhttp.send();
    }

    $(document).ready(function () {
        $.ajaxSetup({caches:false});
        setInterval(function () {
            $('#chatlogs').load('/elearning/messages/chatLogs');
        },1000);
    });
}

