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
            $_SESSION['eidset'] = $row["eid"];
        }
    }
}
 $sql = "SELECT * FROM alert_view WHERE eid >= '".$_SESSION['eid']."' order by eid desc limit 1";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
    echo "<table align=center border=0 width=100%  style='border-collapse: collapse;'>";
     while ($row = $result->fetch_assoc()) {
            if($row["sig_action"]=="alert"){
            echo("<tr  id='note'>");
            $_SESSION['eid'] = $row["eid"];
            echo("<td align=center width=90%>".($_SESSION['eid']-$_SESSION['eidset'])." Rules event logged</td><td align=center width=10%><span class='css-cancel' onclick='javascript:location.reload(true)'></span></td>");
            // echo("<td align=center style='border-bottom: 1px solid #666666;'>".$row["sig_msg"]."</td>");
            echo("</tr>");     
            }
         }
         echo "</table>";
     }
 else {
 }
?>