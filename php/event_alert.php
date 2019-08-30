<?php
session_start();
if(!$_SESSION['u_active'])//활성 유저 여부 
{
 header('Location:../index.html');
}
$_SESSION['eid'] = -1;
$_SESSION['eidset'] = -1;
?>
<link rel="stylesheet" type="text/css" href="../css/Observer_alert.css" />

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
