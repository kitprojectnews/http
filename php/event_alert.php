<?php
session_start();
$_SESSION['eid'] = -1;
?>
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
        window.scrollBy(0,999999);

    }, 1000);
</script>