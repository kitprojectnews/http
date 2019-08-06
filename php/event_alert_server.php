<?php
include "dbconn.php";
if($_SESSION['eid']==-1)
{
    $sql = "SELECT eid FROM alert_view ORDER BY eid DESC limit 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $_SESSION['eid'] = $row["eid"];
            echo($_SESSION['eid']);
        }
    }
}
 $sql = "SELECT * FROM alert_view WHERE eid >= '".$_SESSION['eid']."'";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) {
    echo "<table border=1 width=100%>";
     while ($row = $result->fetch_assoc()) {
        $_SESSION['eid'] = $row["eid"];
            if($row["sig_action"]=="alert"){
            echo("<tr>");
            echo("<td align=center width=300>".$row["time"]."</td>");
            echo("<td align=center>".$row["sig_msg"]."</td>");
            echo("</tr>");     
            }
         }
         echo "</table>";
     }
 else {
     echo "0 r2esults<br>";
 }
?>