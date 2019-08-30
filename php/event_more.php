<?php
session_start();
if(!$_SESSION['u_active'])//활성 유저 여부 
{
 header('Location:../index.html');
}
    include 'dbconn.php';
    if( array_key_exists("select_ago", $_GET))
        $sql = 'SELECT * FROM event_view where  time>SUBDATE(NOW(), INTERVAL '.$_GET['select_ago'].' MINUTE) and eid<'.$_GET['lasteid'].' ORDER BY eid desc limit 30';
    else if( array_key_exists("select_from", $_GET)&&array_key_exists("select_to", $_GET))
        $sql = 'SELECT * FROM event_view where  date(time)>="'.$_GET['select_from'].'"and date(time)<="'.$_GET['select_to'].'" and eid<'.$_GET['lasteid'].' ORDER BY eid desc limit 30';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo ("<tr>");
            echo ("<th scope='row'>" . $row["eid"] . "</th>");
            echo ("<td>");
            switch($row["severity"]){
                case 1:
                    echo '<img src="../images/icons/circle-gray.png" >';
                    break;
                case 2:
                    echo '<img src="../images/icons/circle-yellow.png" >';
                    break;
                case 3:
                    echo '<img src="../images/icons/circle-orange.png" >';
                    break;
                case 4:
                    echo '<img src="../images/icons/circle-dorange.png" >';
                    break;
                case 5:
                    echo '<img src="../images/icons/circle-red.png" >';
                    break;
            }
            echo ("</td>");
            echo ("<td>" . $row["time"] . "</td>");
            echo ("<td align='left'>" . $row['sig_msg'] . "</td>");
            echo ("<td>" . long2ip($row["src_ip"]) . "</td>");
            echo ("<td>" . $row['src_port'] . "</td>");
            echo ("<td>" . long2ip($row["dst_ip"]) . "</td>");
            echo ("<td>" . $row['dst_port'] . "</td>");
            echo ("<td>" . $row["sig_protocol"] . "</td>");
            echo ("<td>" . $row["payload_size"] . "</td>");
            echo ("<td>" . $row["true_rate"] . "</td>");
            echo ("<td> <input type=button value=자세히 onClick='detail(" . $row["eid"] . "," . $row["sig_id"] . ")' /></td>");
            echo ("</tr>");
            $lasteid=$row["eid"];
        }
    }
    $result->close();
    echo '&&'.$lasteid;
?>
