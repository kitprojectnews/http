<?php
include "dbconn.php";

session_start();
if($_SESSION['eid']==-1)
{
    $sql = "SELECT eid FROM alert_view ORDER BY eid DESC limit 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $_SESSION['eid'] = $row["eid"]+1;
        }
    }
}
 $sql = "SELECT *,event_view.sig_id FROM alert_view INNER JOIN event_view ON alert_view.eid = '".$_SESSION['eid']."' order by alert_view.eid desc limit 1";
 //$sql = "SELECT * FROM alert_view WHERE eid >= '".$_SESSION['eid']."' order by eid desc limit 1";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
    echo "<table align=center border=0 width=100%  style='border-collapse: collapse;'>";
     while ($row = $result->fetch_assoc()) {
        $_SESSION['eid'] = $row["eid"];
        if(strlen($row["sig_msg"])>24)
        {
            $msg=substr($row["sig_msg"] ,0 ,24);
            $msg.="...";
        }
        else {
            $msg=$row["sig_msg"];
        }
            if($row["sig_action"]=="alert"){
                switch($row["severity"]){
                    case 1:
                    echo("<tr  id='NA'>");
                    echo("<td align=center width=90%><a href=javascript:detail(".$row["eid"].",".$row["sig_id"].");>Rule [ ".$msg." ] is Matched.</a></td><td align=center width=10%><span class='css-cancel' onclick='javascript:location.reload(true)'></span></td></tr>");                        break;
                    case 2:
                    echo("<tr  id='Low'>");
                    echo("<td align=center width=90%><a href=javascript:detail(".$row["eid"].",".$row["sig_id"].");>Rule [ ".$msg." ] is Matched.</a></td><td align=center width=10%><span class='css-cancel' onclick='javascript:location.reload(true)'></span></td></tr>");                        break;
                        break;
                    case 3:
                    echo("<tr  id='Medium'>");
                    echo("<td align=center width=90%><a href=javascript:detail(".$row["eid"].",".$row["sig_id"].");>Rule [ ".$msg." ] is Matched.</a></td><td align=center width=10%><span class='css-cancel' onclick='javascript:location.reload(true)'></span></td></tr>");                        break;
                        break;
                    case 4:
                    echo("<tr  id='High'>");
                    echo("<td align=center width=90%><a href=javascript:detail(".$row["eid"].",".$row["sig_id"].");>Rule [ ".$msg." ] is Matched.</a></td><td align=center width=10%><span class='css-cancel' onclick='javascript:location.reload(true)'></span></td></tr>");                        break;
                        break;
                    case 5:
                    echo("<tr  id='Critical'>");
                    echo("<td align=center width=90%><a href=javascript:detail(".$row["eid"].",".$row["sig_id"].");>Rule [ ".$msg." ] is Matched.</a></td><td align=center width=10%><span class='css-cancel' onclick='javascript:location.reload(true)'></span></td></tr>");                        break;
                        break;
                }
            
            // echo("<td align=center style='border-bottom: 1px solid #666666;'>".$row["sig_msg"]."</td>");
            }
         }
         echo "</table>";
     }
 else {
 }
?>
<script launguage='JAVASCRIPT'>
    //sig_msg에 하이퍼링크 걸기, 패킷뷰에 탭넣어서 ipheader들 볼수있게 TODOTODO
    function detail(eid, sig_id) {
        var popupX = (window.screen.width / 2) - 500;
        var popupY= (window.screen.height / 2) - 400;
        window.open('event_detailView.php?eid=' + eid + '&sig_id=' + sig_id, 'detailViewer', 'width = 1000, height = 800, left ='+popupX+' , top ='+popupY+', menubar = no, status = no, toolbar = no ');
    }
</script>