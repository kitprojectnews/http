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
            $_SESSION['eid'] = $row["eid"];
        }
    }
}
 $sql = "SELECT * FROM alert_view WHERE eid >= '".$_SESSION['eid']."'";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
    echo "<table border=0 width=100%  style='border-collapse: collapse;'>";
     while ($row = $result->fetch_assoc()) {
            if($row["sig_action"]=="alert"){
            echo("<tr>");
            echo("<td align=center width=300 style='border-bottom: 1px solid #666666;'>".$row["time"]."</td>");
            echo("<td align=center style='border-bottom: 1px solid #666666;'>".$row["sig_msg"]."</td>");
            echo("</tr>");     
            }
         }
         echo "</table>";
     }
 else {
     echo "0 r2sults<br>";
 }
?>