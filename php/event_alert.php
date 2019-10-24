<?php
include 'ReSession.php';
session_start();
$_SESSION['eid'] = -1;
$_SESSION['eidset'] = -1;
?>
<link rel="stylesheet" type="text/css" href="../css/Observer_alert.css" />
<style type="text/css">
    a:link { color: black; text-decoration: none;}
    a:visited { color: black; text-decoration: none;}
    a:hover { color: black; text-decoration: none;}
</style>


<form id=div_alertcheckbox>
</form>
<script launguage='JAVASCRIPT'>
    var timer = setInterval(function ()
    {
        var xhttp; 
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("div_alertcheckbox").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "event_alert_server.php", true);
        xhttp.send();
    }, 1000);
</script>
<script launguage='JAVASCRIPT'>
    //sig_msg에 하이퍼링크 걸기, 패킷뷰에 탭넣어서 ipheader들 볼수있게 TODOTODO
    function detail(eid, sig_id) {
        var popupX = (window.screen.width / 2) - 500;
        var popupY= (window.screen.height / 2) - 400;
        window.open('event_detailView.php?eid=' + eid + '&sig_id=' + sig_id, 'detailViewer', 'width = 1000, height = 800, left ='+popupX+' , top ='+popupY+', menubar = no, status = no, toolbar = no ');
    }
</script>